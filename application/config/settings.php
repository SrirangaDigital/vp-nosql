<?php
//Collections
define('ARTEFACT_COLLECTION', 'articles');
define('USER_COLLECTION', 'userdetails');

//Default Values
define('DEFAULT_PARAM', 'volume');
define('DEFAULT_LETTER', 'A');
define('DEFAULT_LANGUAGE', 'kannada');
define('DEFAULT_STRING', 'zzzzzzzz');

// Lazy loading setting
define('PER_PAGE', 10);
define('NO_SKIP', 0);
define('NO_LIMIT', 1000000);

// user settings (login and registration)
define('REQUIRE_EMAIL_VALIDATION', False);//Set these values to True only
define('REQUIRE_RESET_PASSWORD', False);//if outbound mails can be sent from the server
define('REQUIRE_GIT_TRACKING', False);

// css variables
define('AUTHOR_PREFIX', '—');
define('AUTHOR_JOINER', 'ಮತ್ತು');

// archive variables
define('ARCHIVE_VOLUME', 'ಸಂಪುಟ');
define('ARCHIVE_ISSUE', 'ಸಂಚಿಕೆ');
define('ARTICLES', 'ಲೇಖನಗಳು');
define('ARCHIVE', 'ಸಂಗ್ರಹ');
define('AUTHORS', 'ಲೇಖಕರು');
define('AUTHOR', 'ಲೇಖಕ');
define('FEATURES', 'ಸ್ಥಿರ ಶೀರ್ಷಿಕೆ');
define('SERIES', 'ಸರಣಿ ಲೇಖನಗಳು');
define('TOC', 'ಪರಿವಿಡಿ');

?>
