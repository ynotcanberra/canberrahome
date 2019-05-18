<?php

require_once 'const.php';

//load options
require_once 'admin/options-map/map.php';

//load lib
require_once 'lib/helpers-functions.php';

//load shortcodes
require_once 'lib/shortcode-interface.php';
require_once 'lib/shortcode-functions.php';

//load modules
require_once 'modules/roles/load.php';
require_once 'modules/reviews/load.php';
require_once 'modules/maps/load.php';
require_once 'modules/statistics/load.php';

//load post-post-types
require_once 'lib/post-type-interface.php';
require_once 'post-types/post-types-functions.php';
require_once 'post-types/post-types-register.php'; //this has to be loaded last