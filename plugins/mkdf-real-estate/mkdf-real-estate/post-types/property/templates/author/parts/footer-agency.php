<?php
$query_args = array(
    'role' => 'agent',
    'meta_key' => 'mkdf_belonging_agency',
    'meta_value' => $author->ID
);

$user_query = get_users($query_args);
if (is_array($user_query) && count($user_query)) {
?>
<div class="mkdf-re-author-footer mkdf-author-agents">
    <h5>
        <?php esc_html_e("Agent List:", 'mkdf-real-estate') ?>
    </h5>
    <?php foreach ($user_query as $user) { ?>
        <a href="<?php echo get_author_posts_url($user->ID); ?>" target="_self">
            <?php echo get_avatar($user->ID, 37); ?>
        </a>
    <?php } ?>
</div>
<?php } ?>