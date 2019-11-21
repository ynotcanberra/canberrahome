<?php

if ( ! function_exists( 'mkdf_re_get_rating_form' ) ) {
    function mkdf_re_get_rating_form() {
        return mkdf_re_get_module_template_part( 'reviews/templates/reviews-list');
    }
}

if ( ! function_exists( 'mkdf_re_rating_posts_types' ) ) {
	function mkdf_re_rating_posts_types() {
		$post_types = apply_filters( 'mkdf_re_rating_post_types', array() );
		
		return $post_types;
	}
}

if ( ! function_exists( 'mkdf_re_comment_additional_title_field' ) ) {
	function mkdf_re_comment_additional_title_field( $textarea ) {
		$post_types = mkdf_re_rating_posts_types();
		
		if ( is_array( $post_types ) && count( $post_types ) > 0 ) {
			foreach ( $post_types as $post_type ) {
				if ( is_singular( $post_type ) ) {
                    $textarea = mkdf_re_get_module_template_part( 'reviews/templates/stars-field' );
                    $textarea .= mkdf_re_get_module_template_part( 'reviews/templates/text-field' );
				}
			}
		}
		
		return $textarea;
	}
	
	add_filter( 'zuhaus_mikado_comment_form_textarea_field', 'mkdf_re_comment_additional_title_field', 10, 1 );
}

if ( ! function_exists( 'mkdf_re_extend_comment_edit_metafields' ) ) {
	function mkdf_re_extend_comment_edit_metafields( $comment_id ) {
		if ( ( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) ) {
			return;
		}
		
		if ( ( isset( $_POST['mkdf_rating'] ) ) && ( $_POST['mkdf_rating'] != '' ) ):
			$rating = wp_filter_nohtml_kses( $_POST['mkdf_rating'] );
			update_comment_meta( $comment_id, 'mkdf_rating', $rating );
		else :
			delete_comment_meta( $comment_id, 'mkdf_rating' );
		endif;
	}
	
	add_action( 'edit_comment', 'mkdf_re_extend_comment_edit_metafields' );
}

if ( ! function_exists( 'mkdf_re_extend_comment_add_meta_box' ) ) {
	function mkdf_re_extend_comment_add_meta_box() {
		add_meta_box( 'title', esc_html__( 'Comment - Reviews', 'mkdf-real-estate' ), 'mkdf_re_extend_comment_meta_box', 'comment', 'normal', 'high' );
	}
	
	add_action( 'add_meta_boxes_comment', 'mkdf_re_extend_comment_add_meta_box' );
}

if ( ! function_exists( 'mkdf_re_extend_comment_meta_box' ) ) {
	function mkdf_re_extend_comment_meta_box( $comment ) {
		$post_types = mkdf_re_rating_posts_types();
		
		if ( is_array( $post_types ) && count( $post_types ) > 0 ) {
			foreach ( $post_types as $post_type ) {
				if ( $comment->post_type == $post_type ) {
					$rating = get_comment_meta( $comment->comment_ID, 'mkdf_rating', true );
					wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
					?>
					<p>
						<label for="rating"><?php esc_html_e( 'Rating', 'mkdf-real-estate' ); ?>: </label>
						<span class="commentratingbox">
							<?php
							for ( $i = 1; $i <= 5; $i ++ ) {
								echo '<span class="commentrating"><input type="radio" name="mkdf_rating" id="rating" value="' . $i . '"';
								if ( $rating == $i ) { echo ' checked="checked"'; }
								echo ' />' . $i . ' </span>';
							}
							?>
						</span>
					</p>
					<?php
				}
			}
		}
	}
}

if ( ! function_exists( 'mkdf_re_save_comment_meta_data' ) ) {
	function mkdf_re_save_comment_meta_data( $comment_id ) {
		
		if ( ( isset( $_POST['mkdf_rating'] ) ) && ( $_POST['mkdf_rating'] != '' ) ) {
			$rating = wp_filter_nohtml_kses( $_POST['mkdf_rating'] );
			add_comment_meta( $comment_id, 'mkdf_rating', $rating );
		}
	}
	
	add_action( 'comment_post', 'mkdf_re_save_comment_meta_data' );
}

if ( ! function_exists( 'mkdf_re_verify_comment_meta_data' ) ) {
	function mkdf_re_verify_comment_meta_data( $commentdata ) {
		$post_types = mkdf_re_rating_posts_types();
		
		if ( is_array( $post_types ) && count( $post_types ) > 0 ) {
			foreach ( $post_types as $post_type ) {
				if ( is_singular( $post_type ) ) {
					if ( ! isset( $_POST['mkdf_rating'] ) ) {
						wp_die( esc_html__( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.', 'mkdf-real-estate' ) );
					}
				}
			}
		}
		
		return $commentdata;
	}
	
	add_filter( 'preprocess_comment', 'mkdf_re_verify_comment_meta_data' );
}

if ( ! function_exists( 'mkdf_re_override_comments_callback' ) ) {
	function mkdf_re_override_comments_callback( $args ) {
		$post_types = mkdf_re_rating_posts_types();
		
		if ( is_array( $post_types ) && count( $post_types ) > 0 ) {
			foreach ( $post_types as $post_type ) {
				if ( is_singular( $post_type ) ) {
					$args['callback'] = 'mkdf_re_reviews';
				}
			}
		}
		
		return $args;
	}
	
	add_filter( 'zuhaus_mikado_comments_callback', 'mkdf_re_override_comments_callback' );
}

if ( ! function_exists( 'mkdf_re_reviews' ) ) {
	function mkdf_re_reviews( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		global $post;
		
		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment   = $post->post_author == $comment->user_id;
		
		$comment_class = 'mkdf-comment clearfix';
		
		if ( $is_author_comment ) {
			$comment_class .= ' mkdf-post-author-comment';
		}
		$review_rating = get_comment_meta( $comment->comment_ID, 'mkdf_rating', true );
		?>
		<li>
		<div class="<?php echo esc_attr( $comment_class ); ?>">
			<?php if ( ! $is_pingback_comment ) { ?>
				<div class="mkdf-comment-image"> <?php echo zuhaus_mikado_kses_img( get_avatar( $comment, 'thumbnail' ) ); ?> </div>
			<?php } ?>
			<div class="mkdf-comment-text">
				<div class="mkdf-comment-arrow"></div>
				<div class="mkdf-comment-info">
					<h5 class="mkdf-comment-name vcard">
						<?php echo wp_kses_post( get_comment_author_link() ); ?>
					</h5>
					<span class="mkdf-review-rating">
						<span class="mkdf-rating-inner">
							<?php for ( $i = 1; $i <= $review_rating; $i ++ ) { ?>
								<i class="fa fa-star" aria-hidden="true"></i>
							<?php } ?>
						</span>
					</span>
				</div>
				<?php if ( ! $is_pingback_comment ) { ?>
					<div class="mkdf-text-holder" id="comment-<?php comment_ID(); ?>">
						<?php comment_text(); ?>
                        <span class="mkdf-comment-date">
                            <?php echo get_comment_date(); ?>
                        </span>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

if ( ! function_exists( 'mkdf_re_show_reviews_form' ) ) {
    function mkdf_re_show_reviews_form( $show_form ) {

        if ( is_singular( 'property' ) && !is_user_logged_in() ) {
            $show_form = false;
        }

        return $show_form;
    }

    add_filter( 'zuhaus_mikado_show_comment_form_filter', 'mkdf_re_show_reviews_form' );
}

if ( ! function_exists( 'mkdf_re_property_ratings' ) ) {
    function mkdf_re_property_ratings($id = '') {
        $id = isset($id) && !empty($id) ? $id : get_the_ID();
        $comment_array = get_approved_comments( $id );
        $marks         = array(
            '5' => 0,
            '4' => 0,
            '3' => 0,
            '2' => 0,
            '1' => 0
        );

        foreach ( $comment_array as $comment ) {
            $rating = get_comment_meta( $comment->comment_ID, 'mkdf_rating', true );

            if ( $rating != '' && $rating != 0 ) {
                $marks[ $rating ] = $marks[ $rating ] + 1;
            }
        }

        return $marks;
    }
}

if ( ! function_exists( 'mkdf_re_property_number_of_ratings' ) ) {
    function mkdf_re_property_number_of_ratings() {
        $ratings = mkdf_re_property_ratings();

        $count = 0;
        foreach ( $ratings as $rating => $value ) {
            $count = $count + $value;
        }

        return $count;
    }
}

if ( ! function_exists( 'mkdf_re_property_average_rating' ) ) {
    function mkdf_re_property_average_rating() {
        $ratings = mkdf_re_property_ratings();
        $sum     = 0;
        $count   = 0;

        foreach ( $ratings as $rating => $value ) {
            $sum   = $sum + $rating * $value;
            $count = $count + $value;
        }

        $average = $count == 0 ? 0 : round( $sum / $count );

        return $average;
    }
}