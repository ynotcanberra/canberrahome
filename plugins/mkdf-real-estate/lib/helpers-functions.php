<?php
if ( ! function_exists( 'mkdf_re_get_module_template_part' ) ) {
    /**
     * Loads module template part.
     *
     * @param string $template name of the template to load
     * @param string $slug
     * @param array $params array of parameters to pass to template
     *
     * @return string
     */
    function mkdf_re_get_module_template_part( $template, $slug = '', $params = array() ) {
        //HTML Content from template
        $html          = '';
        $template_path = MIKADO_RE_MODULE_PATH;

        $temp = $template_path . '/' . $template;

        if ( is_array( $params ) && count( $params ) ) {
            extract( $params );
        }

        $template = '';

        if ( ! empty( $temp ) ) {
            if ( ! empty( $slug ) ) {
                $template = "{$temp}-{$slug}.php";

                if ( ! file_exists( $template ) ) {
                    $template = $temp . '.php';
                }
            } else {
                $template = $temp . '.php';
            }
        }

        if ( ! empty( $template ) ) {
            ob_start();
            include( $template );
            $html = ob_get_clean();
        }

        return $html;
    }
}

if(!function_exists('mkdf_re_get_cpt_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $post_type name of the post type
	 * @param string $shortcode name of the shortcode folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param array $additional_params array of additional parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_re_get_cpt_shortcode_module_template_part($post_type, $shortcode, $template, $slug = '', $params = array(), $additional_params = array()) {
		
		//HTML Content from template
		$html = '';
		$template_path = MIKADO_RE_CPT_PATH.'/'.$post_type.'/shortcodes/'.$shortcode.'/'.'templates';
		
		$temp = $template_path.'/'.$template;
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		if(is_array($additional_params) && count($additional_params)) {
			extract($additional_params);
		}
		
		$template = '';
		
		if (!empty($temp)) {
			if (!empty($slug)) {
				$template = "{$temp}-{$slug}.php";
				
				if(!file_exists($template)) {
					$template = $temp.'.php';
				}
			} else {
				$template = $temp.'.php';
			}
		}
		
		if ($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'mkdf_re_cpt_single_module_template_part' ) ) {
    /**
     * Loads module template part.
     *
     * @param string $cpt_name name of the cpt folder
     * @param string $template name of the template to load
     * @param string $slug
     * @param array $params array of parameters to pass to template
     *
     * @return html
     */
    function mkdf_re_cpt_single_module_template_part( $template, $cpt_name, $slug = '', $params = array() ) {
        //HTML Content from template
        $html          = '';
        $template_path = MIKADO_RE_CPT_PATH . '/' . $cpt_name;

        $temp = $template_path . '/' . $template;

        if ( is_array( $params ) && count( $params ) ) {
            extract( $params );
        }

        $template = '';

        if ( ! empty( $temp ) ) {
            if ( ! empty( $slug ) ) {
                $template = "{$temp}-{$slug}.php";

                if ( ! file_exists( $template ) ) {
                    $template = $temp . '.php';
                }
            } else {
                $template = $temp . '.php';
            }
        }

        if ( ! empty( $template ) ) {
            ob_start();
            include( $template );
            $html = ob_get_clean();
        }

        return $html;
    }
}

if(!function_exists('mkdf_re_get_cpt_single_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $cpt_name name of the cpt folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_re_get_cpt_single_module_template_part($template, $cpt_name, $slug = '', $params = array()) {
		
		//HTML Content from template
		$html = '';
		$template_path = MIKADO_RE_CPT_PATH.'/'.$cpt_name;
		
		$temp = $template_path.'/'.$template;
		
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		$template = '';
		
		if (!empty($temp)) {
			if (!empty($slug)) {
				$template = "{$temp}-{$slug}.php";
				
				if(!file_exists($template)) {
					$template = $temp.'.php';
				}
			} else {
				$template = $temp.'.php';
			}
		}
		
		if (!empty($template)) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}
		
		print $html;
	}
}

if(!function_exists('mkdf_re_get_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_re_get_shortcode_module_template_part($template, $shortcode, $slug = '', $params = array()) {
		
		//HTML Content from template
		$html          = '';
		$template_path = MIKADO_RE_SHORTCODES_PATH.'/'.$shortcode;
		
		$temp = $template_path.'/'.$template;
		
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		$template = '';
		
		if (!empty($temp)) {
			if (!empty($slug)) {
				$template = "{$temp}-{$slug}.php";
				
				if(!file_exists($template)) {
					$template = $temp.'.php';
				}
			} else {
				$template = $temp.'.php';
			}
		}
		
		if ($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if( ! function_exists( 'mkdf_re_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 */
	function mkdf_re_ajax_status($status, $message, $data = NULL, $redirect = '') {
		$response = array (
			'status' => $status,
			'message' => $message,
			'data' => $data,
			'redirect' => $redirect
		);

		$output = json_encode($response);

		exit($output);
	}
}

if ( ! function_exists( 'mkdf_re_get_countries_list' ) ) {
    function mkdf_re_get_countries_list() {
        
        $countries = array(
            'AF' => esc_html__( 'Afghanistan', 'mkdf-real-estate' ),
            'AX' => esc_html__( '&#197;land Islands', 'mkdf-real-estate' ),
            'AL' => esc_html__( 'Albania', 'mkdf-real-estate' ),
            'DZ' => esc_html__( 'Algeria', 'mkdf-real-estate' ),
            'AS' => esc_html__( 'American Samoa', 'mkdf-real-estate' ),
            'AD' => esc_html__( 'Andorra', 'mkdf-real-estate' ),
            'AO' => esc_html__( 'Angola', 'mkdf-real-estate' ),
            'AI' => esc_html__( 'Anguilla', 'mkdf-real-estate' ),
            'AQ' => esc_html__( 'Antarctica', 'mkdf-real-estate' ),
            'AG' => esc_html__( 'Antigua and Barbuda', 'mkdf-real-estate' ),
            'AR' => esc_html__( 'Argentina', 'mkdf-real-estate' ),
            'AM' => esc_html__( 'Armenia', 'mkdf-real-estate' ),
            'AW' => esc_html__( 'Aruba', 'mkdf-real-estate' ),
            'AU' => esc_html__( 'Australia', 'mkdf-real-estate' ),
            'AT' => esc_html__( 'Austria', 'mkdf-real-estate' ),
            'AZ' => esc_html__( 'Azerbaijan', 'mkdf-real-estate' ),
            'BS' => esc_html__( 'Bahamas', 'mkdf-real-estate' ),
            'BH' => esc_html__( 'Bahrain', 'mkdf-real-estate' ),
            'BD' => esc_html__( 'Bangladesh', 'mkdf-real-estate' ),
            'BB' => esc_html__( 'Barbados', 'mkdf-real-estate' ),
            'BY' => esc_html__( 'Belarus', 'mkdf-real-estate' ),
            'BE' => esc_html__( 'Belgium', 'mkdf-real-estate' ),
            'PW' => esc_html__( 'Belau', 'mkdf-real-estate' ),
            'BZ' => esc_html__( 'Belize', 'mkdf-real-estate' ),
            'BJ' => esc_html__( 'Benin', 'mkdf-real-estate' ),
            'BM' => esc_html__( 'Bermuda', 'mkdf-real-estate' ),
            'BT' => esc_html__( 'Bhutan', 'mkdf-real-estate' ),
            'BO' => esc_html__( 'Bolivia', 'mkdf-real-estate' ),
            'BQ' => esc_html__( 'Bonaire, Saint Eustatius and Saba', 'mkdf-real-estate' ),
            'BA' => esc_html__( 'Bosnia and Herzegovina', 'mkdf-real-estate' ),
            'BW' => esc_html__( 'Botswana', 'mkdf-real-estate' ),
            'BV' => esc_html__( 'Bouvet Island', 'mkdf-real-estate' ),
            'BR' => esc_html__( 'Brazil', 'mkdf-real-estate' ),
            'IO' => esc_html__( 'British Indian Ocean Territory', 'mkdf-real-estate' ),
            'VG' => esc_html__( 'British Virgin Islands', 'mkdf-real-estate' ),
            'BN' => esc_html__( 'Brunei', 'mkdf-real-estate' ),
            'BG' => esc_html__( 'Bulgaria', 'mkdf-real-estate' ),
            'BF' => esc_html__( 'Burkina Faso', 'mkdf-real-estate' ),
            'BI' => esc_html__( 'Burundi', 'mkdf-real-estate' ),
            'KH' => esc_html__( 'Cambodia', 'mkdf-real-estate' ),
            'CM' => esc_html__( 'Cameroon', 'mkdf-real-estate' ),
            'CA' => esc_html__( 'Canada', 'mkdf-real-estate' ),
            'CV' => esc_html__( 'Cape Verde', 'mkdf-real-estate' ),
            'KY' => esc_html__( 'Cayman Islands', 'mkdf-real-estate' ),
            'CF' => esc_html__( 'Central African Republic', 'mkdf-real-estate' ),
            'TD' => esc_html__( 'Chad', 'mkdf-real-estate' ),
            'CL' => esc_html__( 'Chile', 'mkdf-real-estate' ),
            'CN' => esc_html__( 'China', 'mkdf-real-estate' ),
            'CX' => esc_html__( 'Christmas Island', 'mkdf-real-estate' ),
            'CC' => esc_html__( 'Cocos (Keeling) Islands', 'mkdf-real-estate' ),
            'CO' => esc_html__( 'Colombia', 'mkdf-real-estate' ),
            'KM' => esc_html__( 'Comoros', 'mkdf-real-estate' ),
            'CG' => esc_html__( 'Congo (Brazzaville)', 'mkdf-real-estate' ),
            'CD' => esc_html__( 'Congo (Kinshasa)', 'mkdf-real-estate' ),
            'CK' => esc_html__( 'Cook Islands', 'mkdf-real-estate' ),
            'CR' => esc_html__( 'Costa Rica', 'mkdf-real-estate' ),
            'HR' => esc_html__( 'Croatia', 'mkdf-real-estate' ),
            'CU' => esc_html__( 'Cuba', 'mkdf-real-estate' ),
            'CW' => esc_html__( 'Cura&ccedil;ao', 'mkdf-real-estate' ),
            'CY' => esc_html__( 'Cyprus', 'mkdf-real-estate' ),
            'CZ' => esc_html__( 'Czech Republic', 'mkdf-real-estate' ),
            'DK' => esc_html__( 'Denmark', 'mkdf-real-estate' ),
            'DJ' => esc_html__( 'Djibouti', 'mkdf-real-estate' ),
            'DM' => esc_html__( 'Dominica', 'mkdf-real-estate' ),
            'DO' => esc_html__( 'Dominican Republic', 'mkdf-real-estate' ),
            'EC' => esc_html__( 'Ecuador', 'mkdf-real-estate' ),
            'EG' => esc_html__( 'Egypt', 'mkdf-real-estate' ),
            'SV' => esc_html__( 'El Salvador', 'mkdf-real-estate' ),
            'GQ' => esc_html__( 'Equatorial Guinea', 'mkdf-real-estate' ),
            'ER' => esc_html__( 'Eritrea', 'mkdf-real-estate' ),
            'EE' => esc_html__( 'Estonia', 'mkdf-real-estate' ),
            'ET' => esc_html__( 'Ethiopia', 'mkdf-real-estate' ),
            'FK' => esc_html__( 'Falkland Islands', 'mkdf-real-estate' ),
            'FO' => esc_html__( 'Faroe Islands', 'mkdf-real-estate' ),
            'FJ' => esc_html__( 'Fiji', 'mkdf-real-estate' ),
            'FI' => esc_html__( 'Finland', 'mkdf-real-estate' ),
            'FR' => esc_html__( 'France', 'mkdf-real-estate' ),
            'GF' => esc_html__( 'French Guiana', 'mkdf-real-estate' ),
            'PF' => esc_html__( 'French Polynesia', 'mkdf-real-estate' ),
            'TF' => esc_html__( 'French Southern Territories', 'mkdf-real-estate' ),
            'GA' => esc_html__( 'Gabon', 'mkdf-real-estate' ),
            'GM' => esc_html__( 'Gambia', 'mkdf-real-estate' ),
            'GE' => esc_html__( 'Georgia', 'mkdf-real-estate' ),
            'DE' => esc_html__( 'Germany', 'mkdf-real-estate' ),
            'GH' => esc_html__( 'Ghana', 'mkdf-real-estate' ),
            'GI' => esc_html__( 'Gibraltar', 'mkdf-real-estate' ),
            'GR' => esc_html__( 'Greece', 'mkdf-real-estate' ),
            'GL' => esc_html__( 'Greenland', 'mkdf-real-estate' ),
            'GD' => esc_html__( 'Grenada', 'mkdf-real-estate' ),
            'GP' => esc_html__( 'Guadeloupe', 'mkdf-real-estate' ),
            'GU' => esc_html__( 'Guam', 'mkdf-real-estate' ),
            'GT' => esc_html__( 'Guatemala', 'mkdf-real-estate' ),
            'GG' => esc_html__( 'Guernsey', 'mkdf-real-estate' ),
            'GN' => esc_html__( 'Guinea', 'mkdf-real-estate' ),
            'GW' => esc_html__( 'Guinea-Bissau', 'mkdf-real-estate' ),
            'GY' => esc_html__( 'Guyana', 'mkdf-real-estate' ),
            'HT' => esc_html__( 'Haiti', 'mkdf-real-estate' ),
            'HM' => esc_html__( 'Heard Island and McDonald Islands', 'mkdf-real-estate' ),
            'HN' => esc_html__( 'Honduras', 'mkdf-real-estate' ),
            'HK' => esc_html__( 'Hong Kong', 'mkdf-real-estate' ),
            'HU' => esc_html__( 'Hungary', 'mkdf-real-estate' ),
            'IS' => esc_html__( 'Iceland', 'mkdf-real-estate' ),
            'IN' => esc_html__( 'India', 'mkdf-real-estate' ),
            'ID' => esc_html__( 'Indonesia', 'mkdf-real-estate' ),
            'IR' => esc_html__( 'Iran', 'mkdf-real-estate' ),
            'IQ' => esc_html__( 'Iraq', 'mkdf-real-estate' ),
            'IE' => esc_html__( 'Ireland', 'mkdf-real-estate' ),
            'IM' => esc_html__( 'Isle of Man', 'mkdf-real-estate' ),
            'IL' => esc_html__( 'Israel', 'mkdf-real-estate' ),
            'IT' => esc_html__( 'Italy', 'mkdf-real-estate' ),
            'CI' => esc_html__( 'Ivory Coast', 'mkdf-real-estate' ),
            'JM' => esc_html__( 'Jamaica', 'mkdf-real-estate' ),
            'JP' => esc_html__( 'Japan', 'mkdf-real-estate' ),
            'JE' => esc_html__( 'Jersey', 'mkdf-real-estate' ),
            'JO' => esc_html__( 'Jordan', 'mkdf-real-estate' ),
            'KZ' => esc_html__( 'Kazakhstan', 'mkdf-real-estate' ),
            'KE' => esc_html__( 'Kenya', 'mkdf-real-estate' ),
            'KI' => esc_html__( 'Kiribati', 'mkdf-real-estate' ),
            'KW' => esc_html__( 'Kuwait', 'mkdf-real-estate' ),
            'KG' => esc_html__( 'Kyrgyzstan', 'mkdf-real-estate' ),
            'LA' => esc_html__( 'Laos', 'mkdf-real-estate' ),
            'LV' => esc_html__( 'Latvia', 'mkdf-real-estate' ),
            'LB' => esc_html__( 'Lebanon', 'mkdf-real-estate' ),
            'LS' => esc_html__( 'Lesotho', 'mkdf-real-estate' ),
            'LR' => esc_html__( 'Liberia', 'mkdf-real-estate' ),
            'LY' => esc_html__( 'Libya', 'mkdf-real-estate' ),
            'LI' => esc_html__( 'Liechtenstein', 'mkdf-real-estate' ),
            'LT' => esc_html__( 'Lithuania', 'mkdf-real-estate' ),
            'LU' => esc_html__( 'Luxembourg', 'mkdf-real-estate' ),
            'MO' => esc_html__( 'Macao S.A.R., China', 'mkdf-real-estate' ),
            'MK' => esc_html__( 'Macedonia', 'mkdf-real-estate' ),
            'MG' => esc_html__( 'Madagascar', 'mkdf-real-estate' ),
            'MW' => esc_html__( 'Malawi', 'mkdf-real-estate' ),
            'MY' => esc_html__( 'Malaysia', 'mkdf-real-estate' ),
            'MV' => esc_html__( 'Maldives', 'mkdf-real-estate' ),
            'ML' => esc_html__( 'Mali', 'mkdf-real-estate' ),
            'MT' => esc_html__( 'Malta', 'mkdf-real-estate' ),
            'MH' => esc_html__( 'Marshall Islands', 'mkdf-real-estate' ),
            'MQ' => esc_html__( 'Martinique', 'mkdf-real-estate' ),
            'MR' => esc_html__( 'Mauritania', 'mkdf-real-estate' ),
            'MU' => esc_html__( 'Mauritius', 'mkdf-real-estate' ),
            'YT' => esc_html__( 'Mayotte', 'mkdf-real-estate' ),
            'MX' => esc_html__( 'Mexico', 'mkdf-real-estate' ),
            'FM' => esc_html__( 'Micronesia', 'mkdf-real-estate' ),
            'MD' => esc_html__( 'Moldova', 'mkdf-real-estate' ),
            'MC' => esc_html__( 'Monaco', 'mkdf-real-estate' ),
            'MN' => esc_html__( 'Mongolia', 'mkdf-real-estate' ),
            'ME' => esc_html__( 'Montenegro', 'mkdf-real-estate' ),
            'MS' => esc_html__( 'Montserrat', 'mkdf-real-estate' ),
            'MA' => esc_html__( 'Morocco', 'mkdf-real-estate' ),
            'MZ' => esc_html__( 'Mozambique', 'mkdf-real-estate' ),
            'MM' => esc_html__( 'Myanmar', 'mkdf-real-estate' ),
            'NA' => esc_html__( 'Namibia', 'mkdf-real-estate' ),
            'NR' => esc_html__( 'Nauru', 'mkdf-real-estate' ),
            'NP' => esc_html__( 'Nepal', 'mkdf-real-estate' ),
            'NL' => esc_html__( 'Netherlands', 'mkdf-real-estate' ),
            'NC' => esc_html__( 'New Caledonia', 'mkdf-real-estate' ),
            'NZ' => esc_html__( 'New Zealand', 'mkdf-real-estate' ),
            'NI' => esc_html__( 'Nicaragua', 'mkdf-real-estate' ),
            'NE' => esc_html__( 'Niger', 'mkdf-real-estate' ),
            'NG' => esc_html__( 'Nigeria', 'mkdf-real-estate' ),
            'NU' => esc_html__( 'Niue', 'mkdf-real-estate' ),
            'NF' => esc_html__( 'Norfolk Island', 'mkdf-real-estate' ),
            'MP' => esc_html__( 'Northern Mariana Islands', 'mkdf-real-estate' ),
            'KP' => esc_html__( 'North Korea', 'mkdf-real-estate' ),
            'NO' => esc_html__( 'Norway', 'mkdf-real-estate' ),
            'OM' => esc_html__( 'Oman', 'mkdf-real-estate' ),
            'PK' => esc_html__( 'Pakistan', 'mkdf-real-estate' ),
            'PS' => esc_html__( 'Palestinian Territory', 'mkdf-real-estate' ),
            'PA' => esc_html__( 'Panama', 'mkdf-real-estate' ),
            'PG' => esc_html__( 'Papua New Guinea', 'mkdf-real-estate' ),
            'PY' => esc_html__( 'Paraguay', 'mkdf-real-estate' ),
            'PE' => esc_html__( 'Peru', 'mkdf-real-estate' ),
            'PH' => esc_html__( 'Philippines', 'mkdf-real-estate' ),
            'PN' => esc_html__( 'Pitcairn', 'mkdf-real-estate' ),
            'PL' => esc_html__( 'Poland', 'mkdf-real-estate' ),
            'PT' => esc_html__( 'Portugal', 'mkdf-real-estate' ),
            'PR' => esc_html__( 'Puerto Rico', 'mkdf-real-estate' ),
            'QA' => esc_html__( 'Qatar', 'mkdf-real-estate' ),
            'RE' => esc_html__( 'Reunion', 'mkdf-real-estate' ),
            'RO' => esc_html__( 'Romania', 'mkdf-real-estate' ),
            'RU' => esc_html__( 'Russia', 'mkdf-real-estate' ),
            'RW' => esc_html__( 'Rwanda', 'mkdf-real-estate' ),
            'BL' => esc_html__( 'Saint Barth&eacute;lemy', 'mkdf-real-estate' ),
            'SH' => esc_html__( 'Saint Helena', 'mkdf-real-estate' ),
            'KN' => esc_html__( 'Saint Kitts and Nevis', 'mkdf-real-estate' ),
            'LC' => esc_html__( 'Saint Lucia', 'mkdf-real-estate' ),
            'MF' => esc_html__( 'Saint Martin (French part)', 'mkdf-real-estate' ),
            'SX' => esc_html__( 'Saint Martin (Dutch part)', 'mkdf-real-estate' ),
            'PM' => esc_html__( 'Saint Pierre and Miquelon', 'mkdf-real-estate' ),
            'VC' => esc_html__( 'Saint Vincent and the Grenadines', 'mkdf-real-estate' ),
            'SM' => esc_html__( 'San Marino', 'mkdf-real-estate' ),
            'ST' => esc_html__( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'mkdf-real-estate' ),
            'SA' => esc_html__( 'Saudi Arabia', 'mkdf-real-estate' ),
            'SN' => esc_html__( 'Senegal', 'mkdf-real-estate' ),
            'RS' => esc_html__( 'Serbia', 'mkdf-real-estate' ),
            'SC' => esc_html__( 'Seychelles', 'mkdf-real-estate' ),
            'SL' => esc_html__( 'Sierra Leone', 'mkdf-real-estate' ),
            'SG' => esc_html__( 'Singapore', 'mkdf-real-estate' ),
            'SK' => esc_html__( 'Slovakia', 'mkdf-real-estate' ),
            'SI' => esc_html__( 'Slovenia', 'mkdf-real-estate' ),
            'SB' => esc_html__( 'Solomon Islands', 'mkdf-real-estate' ),
            'SO' => esc_html__( 'Somalia', 'mkdf-real-estate' ),
            'ZA' => esc_html__( 'South Africa', 'mkdf-real-estate' ),
            'GS' => esc_html__( 'South Georgia/Sandwich Islands', 'mkdf-real-estate' ),
            'KR' => esc_html__( 'South Korea', 'mkdf-real-estate' ),
            'SS' => esc_html__( 'South Sudan', 'mkdf-real-estate' ),
            'ES' => esc_html__( 'Spain', 'mkdf-real-estate' ),
            'LK' => esc_html__( 'Sri Lanka', 'mkdf-real-estate' ),
            'SD' => esc_html__( 'Sudan', 'mkdf-real-estate' ),
            'SR' => esc_html__( 'Suriname', 'mkdf-real-estate' ),
            'SJ' => esc_html__( 'Svalbard and Jan Mayen', 'mkdf-real-estate' ),
            'SZ' => esc_html__( 'Swaziland', 'mkdf-real-estate' ),
            'SE' => esc_html__( 'Sweden', 'mkdf-real-estate' ),
            'CH' => esc_html__( 'Switzerland', 'mkdf-real-estate' ),
            'SY' => esc_html__( 'Syria', 'mkdf-real-estate' ),
            'TW' => esc_html__( 'Taiwan', 'mkdf-real-estate' ),
            'TJ' => esc_html__( 'Tajikistan', 'mkdf-real-estate' ),
            'TZ' => esc_html__( 'Tanzania', 'mkdf-real-estate' ),
            'TH' => esc_html__( 'Thailand', 'mkdf-real-estate' ),
            'TL' => esc_html__( 'Timor-Leste', 'mkdf-real-estate' ),
            'TG' => esc_html__( 'Togo', 'mkdf-real-estate' ),
            'TK' => esc_html__( 'Tokelau', 'mkdf-real-estate' ),
            'TO' => esc_html__( 'Tonga', 'mkdf-real-estate' ),
            'TT' => esc_html__( 'Trinidad and Tobago', 'mkdf-real-estate' ),
            'TN' => esc_html__( 'Tunisia', 'mkdf-real-estate' ),
            'TR' => esc_html__( 'Turkey', 'mkdf-real-estate' ),
            'TM' => esc_html__( 'Turkmenistan', 'mkdf-real-estate' ),
            'TC' => esc_html__( 'Turks and Caicos Islands', 'mkdf-real-estate' ),
            'TV' => esc_html__( 'Tuvalu', 'mkdf-real-estate' ),
            'UG' => esc_html__( 'Uganda', 'mkdf-real-estate' ),
            'UA' => esc_html__( 'Ukraine', 'mkdf-real-estate' ),
            'AE' => esc_html__( 'United Arab Emirates', 'mkdf-real-estate' ),
            'GB' => esc_html__( 'United Kingdom (UK)', 'mkdf-real-estate' ),
            'US' => esc_html__( 'United States (US)', 'mkdf-real-estate' ),
            'UM' => esc_html__( 'United States (US) Minor Outlying Islands', 'mkdf-real-estate' ),
            'VI' => esc_html__( 'United States (US) Virgin Islands', 'mkdf-real-estate' ),
            'UY' => esc_html__( 'Uruguay', 'mkdf-real-estate' ),
            'UZ' => esc_html__( 'Uzbekistan', 'mkdf-real-estate' ),
            'VU' => esc_html__( 'Vanuatu', 'mkdf-real-estate' ),
            'VA' => esc_html__( 'Vatican', 'mkdf-real-estate' ),
            'VE' => esc_html__( 'Venezuela', 'mkdf-real-estate' ),
            'VN' => esc_html__( 'Vietnam', 'mkdf-real-estate' ),
            'WF' => esc_html__( 'Wallis and Futuna', 'mkdf-real-estate' ),
            'EH' => esc_html__( 'Western Sahara', 'mkdf-real-estate' ),
            'WS' => esc_html__( 'Samoa', 'mkdf-real-estate' ),
            'YE' => esc_html__( 'Yemen', 'mkdf-real-estate' ),
            'ZM' => esc_html__( 'Zambia', 'mkdf-real-estate' ),
            'ZW' => esc_html__( 'Zimbabwe', 'mkdf-real-estate' )
        );
        
        return $countries;
    }
}

/**
 * Get property county taxonomy values
 * return value is array in provided format.
 *
 * @param $taxonomy string - queried taxonomy
 * @param $first_empty boolean - if is true, first element in key_value return array will be empty
 * @param $return_type string - format of returned array (can be key_value, object)
 *
 * @return array
 */
if ( ! function_exists( 'mkdf_re_get_taxonomy_list' ) ) {
    function mkdf_re_get_taxonomy_list($taxonomy = '', $first_empty = false, $return_type = 'key_value') {
        $property_taxonomy_array = array();
        $property_taxonomy_array['key_value'] = array();
        $property_taxonomy_array['obj'] = array();

        if($taxonomy !== '') {

            $args = array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false
            );

            $property_taxonomies = get_terms($args);

            if (is_array($property_taxonomies) && count($property_taxonomies)) {
                if ($first_empty) {
                    $property_taxonomy_array['key_value'][''] = '';
                }
                foreach ($property_taxonomies as $property_taxonomy) {

                    $property_taxonomy_array['key_value'][$property_taxonomy->term_id] = $property_taxonomy->name;
                    $property_taxonomy_array['obj'][] = $property_taxonomy;

                }

            }
        }

        return $property_taxonomy_array[$return_type];
    }
}

if ( ! function_exists( 'mkdf_re_get_taxonomy_name_from_id' ) ) {
    function mkdf_re_get_taxonomy_name_from_id($term_id) {
        if(!empty ($term_id)) {
            $term = get_term($term_id);
            return $term->name;
        }
        return "";
    }
}

if ( ! function_exists( 'mkdf_re_get_taxonomy_icon' ) ) {
    function mkdf_re_get_taxonomy_icon($id, $image_field_name = '', $icon_field_name = '') {

        if($image_field_name !== '') {
            $taxonomy_image_id = get_term_meta($id, $image_field_name, true);

            $image_original = wp_get_attachment_image_src($taxonomy_image_id, 'full');
            $type_image = $image_original[0];

            if (!empty($type_image)) {
                $html = '<span class="mkdf-taxonomy-image">';
                $html .= '<img src="' . esc_url($type_image) . '" alt="' . esc_attr__('Taxonomy Custom Icon', 'mkdf-real-estate') . '">';
                $html .= '</span>';
                return $html;
            }
        }

        if (!mkdf_re_theme_installed()) {
            return false;
        }

        if($icon_field_name !== '') {
            $category_icon_pack = get_term_meta($id, $icon_field_name, true);
            $icon_param_name = zuhaus_mikado_icon_collections()->getIconCollectionParamNameByKey($category_icon_pack);
            $category_icon = get_term_meta($id, $icon_field_name . '_' . $icon_param_name, true);

            if (empty($category_icon)) {
                return '';
            }

            $html = '<span class="mkdf-taxonomy-icon">';
            $html .= zuhaus_mikado_icon_collections()->renderIcon($category_icon, $category_icon_pack);
            $html .= '</span>';
            return $html;
        }

        return '';
    }
}

if ( ! function_exists( 'mkdf_re_get_taxonomy_featured_image' ) ) {
    function mkdf_re_get_taxonomy_featured_image($id, $image_field_name = '', $thumb_size = 'full', $return_type = 'html') {

        if($image_field_name !== '') {
            $taxonomy_image_id = get_term_meta($id, $image_field_name, true);

            $image_original = wp_get_attachment_image_src($taxonomy_image_id, $thumb_size);
            $type_image = $image_original[0];

            if (!empty($type_image)) {
                if($return_type === 'html') {
                    $html = '<span class="mkdf-taxonomy-image">';
                    $html .= '<img src="' . esc_url($type_image) . '" alt="' . esc_attr__('Taxonomy Featured Image', 'mkdf-real-estate') . '">';
                    $html .= '</span>';
                    return $html;
                }
                else if($return_type === 'src') {
                    return $type_image;
                }
            }
        }

        return '';
    }
}

if ( ! function_exists( 'mkdf_re_get_assets_icon_src' ) ) {
    function mkdf_re_get_assets_icon_src($icon_name, $extension) {
        return MIKADO_RE_ASSETS_URL_PATH . '/img/' . $icon_name . '.' . $extension;
    }
}