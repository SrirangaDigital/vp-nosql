<?php

define('BASE_URL', 'http://192.168.1.69/vp-nosql/');
define('PUBLIC_URL', BASE_URL . 'public/');
define('DATA_URL', PUBLIC_URL . 'data/');
define('DOWNLOAD_URL', PUBLIC_URL . 'downloads/');
define('METADATA_URL', PUBLIC_URL . 'metaData/');
define('FOREIGN_KEYS_URL', PUBLIC_URL . 'foreignKeys/');
define('JSON_PRECAST_URL', BASE_URL . 'json-precast/');
define('FLAT_URL', BASE_URL . 'application/views/flat/');
define('IMAGE_URL', PUBLIC_URL . 'images/');

// Physical location of resources
define('PHY_BASE_URL', '/var/www/html/vp-nosql/');
define('PHY_PUBLIC_URL', PHY_BASE_URL . 'public/');
define('PHY_DATA_URL', PHY_PUBLIC_URL . 'data/');
define('PHY_DOWNLOAD_URL', PHY_PUBLIC_URL . 'downloads/');
define('PHY_METADATA_URL', PHY_PUBLIC_URL . 'metaData/');
define('PHY_FOREIGN_KEYS_URL', PHY_PUBLIC_URL . 'foreignKeys/');
define('PHY_JSON_PRECAST_URL', PHY_BASE_URL . 'json-precast/');
define('PHY_FLAT_URL', PHY_BASE_URL . 'application/views/flat/');
define('PHY_IMAGE_URL', PHY_PUBLIC_URL . 'images/');

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '27017');
define('DB_NAME', 'vpARCHIVES');
define('DB_USER', 'vpUSER');
define('DB_PASSWORD', 'vp123');

//~ // Git config
//~ define('GIT_USER_NAME', 'shruthisdst');
//~ define('GIT_PASSWORD', 'shruthitr14');
//~ define('GIT_REPO', 'github.com/SrirangaDigital/vp-nosql.git');
//~ define('GIT_REMOTE', 'https://' . GIT_USER_NAME . ':' . GIT_PASSWORD . '@' . GIT_REPO);
//~ define('GIT_EMAIL', 'shruthitr.nayak@gmail.com');

?>
