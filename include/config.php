<?php
session_start();

define("db_host","localhost");
define("db_username","cserms");
define("db_password","k*div*pwd*123");
define("db_name","soen487");
date_default_timezone_set('America/Toronto');

define('GOOGLE_CLIENT_ID', '837105274463-vhqjduqng3hviue2v17emvd3inobmjfl.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/drive');
define('REDIRECT_URI', 'http://localhost/487a3/googleDriveSync.php');

$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope='.urlencode(GOOGLE_OAUTH_SCOPE).'&redirect_uri='.REDIRECT_URI.'&response_type=code&client_id='.GOOGLE_CLIENT_ID.'&access_type=online';

?>
