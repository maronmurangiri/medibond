<?php
// Are we live?
//define('LIVE', false);
if (!defined('LIVE')) DEFINE('LIVE', true);

// Errors are emailed here:
DEFINE('CONTACT_EMAIL', 'murangirimaron@gmail.com');

// ************ SETTINGS ************ //
// ********************************** //

// ********************************** //
// ************ CONSTANTS *********** //
///Wamp64/www/    $location = 'https://' . BASE_URI . 'billing.php';
// Determine location of files and the URL of the site:
define('BASE_URI', '/Wamp64/www/medibond/');
define('BASE_URL', 'medicine/');
define('MYSQL', BASE_URI . 'mysqli.inc.php');

// For the complex HTML:
define('BOX_BEGIN', '<!-- box begin --><div class="box alt"><div class="left-top-corner"><div class="right-top-corner"><div class="border-top"></div></div></div><div class="border-left"><div class="border-right"><div class="inner">');
define('BOX_END', '</div></div></div><div class="left-bot-corner"><div class="right-bot-corner"><div class="border-bot"></div></div></div></div><!-- box end -->');

// For Authorize.net:55nLqQ5L2', '2Lazr67xX97AL9Hj'
define('API_LOGIN_ID', '55nLqQ5L2');
define('TRANSACTION_KEY', '2Lazr67xX97AL9Hj');

// *****?>