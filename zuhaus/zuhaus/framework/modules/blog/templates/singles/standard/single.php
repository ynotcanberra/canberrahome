<?php

zuhaus_mikado_get_single_post_format_html($blog_single_type);

do_action('zuhaus_mikado_after_article_content');

zuhaus_mikado_get_module_template_part('templates/parts/single/single-navigation', 'blog');

zuhaus_mikado_get_module_template_part('templates/parts/single/author-info', 'blog');

zuhaus_mikado_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

zuhaus_mikado_get_module_template_part('templates/parts/single/comments', 'blog');