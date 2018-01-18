<?php
//Collections
define('ARTEFACT_COLLECTION', 'articles');
define('ALPHABET_COLLECTION', 'alphabet');
define('USER_COLLECTION', 'userdetails');

//Default Values
define('DEFAULT_TYPE', 'Journal');
define('DEFAULT_PARAM', 'volume');
define('DEFAULT_LETTER', 'ಅ');
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
define('ARCHIVE_BASE_FONT_SIZE', '18px'); //for Nudi = 18px, English = 16px, Devanagari = 18px
define('AUTHOR_PREFIX', '—');
define('AUTHOR_JOINER', 'ಮತ್ತು');


// archive variables
define('NAV_ARCHIVE_VOLUME', 'ಸಂಪುಟಗಳು');
define('NAV_ARCHIVE_ARTICLES', 'ಲೇಖನಗಳು');
define('NAV_ARCHIVE_AUTHORS', 'ಲೇಖಕರು');
define('NAV_ARCHIVE_FEATURES', 'ಸ್ಥಿರ ಶೀರ್ಷಿಕೆಗಳು');
define('NAV_ARCHIVE_SEARCH', 'ಹುಡುಕಿ');
define('SEARCH_ARTICLE', 'ಲೇಖನ');
define('SEARCH_AUTHOR', 'ಲೇಖಕರು');
define('SEARCH_FEATURE', 'ಸ್ಥಿರ ಶೀರ್ಷಿಕೆ');
define('SEARCH_WORD', 'ಪದ');
define('SEARCH_SEARCH', 'ಹುಡುಕಿ');
define('SEARCH_RESET', 'ಅಳಿಸಿ');
define('SEARCH_RESULTS', 'ಫಲಿತಾಂಶಗಳು');
define('ARCHIVE_STRUCTURE_TYPE', 'pictorial'); //can take either pictorial or textual
define('ARCHIVE_VOLUME', 'ಸಂಪುಟ');
define('ARCHIVE_ISSUE', 'ಸಂಚಿಕೆ');
define('ARTICLES', 'ಲೇಖನ(ಗಳು)');
define('ARCHIVE', 'ಸಂಗ್ರಹ');
define('AUTHORS', 'ಲೇಖಕರು');
define('FEATURE', 'ಸ್ಥಿರ ಶೀರ್ಷಿಕೆ');
define('SEARCH', 'ಹುಡುಕಿ');
define('SERIES', 'ಸರಣಿ ಲೇಖನಗಳು');
define('TOC', 'ಪರಿವಿಡಿ');

?>
