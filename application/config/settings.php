<?php
//Collections
define('ARTEFACT_COLLECTION', 'artefacts');
define('USER_COLLECTION', 'userdetails');

//Default Values
define('SHOW_ONLY_IF_DATA_EXISTS', True);

// Lazy loading setting
define('PER_PAGE', 10);

// user settings (login and registration)
define('REQUIRE_EMAIL_VALIDATION', False);//Set these values to True only
define('REQUIRE_RESET_PASSWORD', False);//if outbound mails can be sent from the server
define('REQUIRE_GIT_TRACKING', False);

?>
