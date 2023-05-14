<?php
session_start();

//Definició de constants per la localització...
define ('LANG_PATH',                'includes/lang/');
define ('LANG_DEFAULT',             'es');

define ('WEBCODE',                  '1'); // blog ID
define ('WEBSITE',					"https://domain.com/");
define ('WEBSITE_NAME',             'Univers');
define ('WEBMASTER_EMAIL',          'xavipena@gmail.com');
define ('WEB_URL',                  'https://domain.com/folder');
define ('WEBSITE_DOMAIN',			"photoadict.com");
define ('AUTHOR_URL',				"https://www.instagram.com/xavipena/");
define ('COPYRIGHT',				"(C) Xavier Peña");

define ('PAGE_WIDTH',		    	'1000');
define ('CONTENT_WIDTH',		    '700');
define ('LEFT_WIDTH',		    	'300');

$page_SITEMAP = FALSE;
$page_LOCATION = FALSE;

$rowStart = "<tr><td>";
$rowStartSpan = "<tr><td colspan='2'>"; 
$rowEnd = "</td></tr>";
$newCol = "</td><td>";

// Globals to check the device
// ------------------------------------------
// Check if the "mobile" word exists in User-Agent 
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 

// Check if the "tablet" word exists in User-Agent 
$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet")); 

// Platform check  
$isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
$isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
$isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
$isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
$isIOS = $isIPhone || $isIPad; 
// ------------------------------------------

// Sanitize input
$clean = array();
foreach(array_keys($_REQUEST) as $key)
{
	$clean[$key] = mysqli_real_escape_string($db, $_REQUEST[$key]);
}

$lang = "";
if (isset($clean["lang"])) 
{
	if ($lang !='es' && $lang !='ca') $lang ='es';
	$lang = $clean["lang"];
} 
elseif (isset($_SESSION['idioma']))
{
	$lang = $_SESSION['idioma'];
	if ($lang !='es' && $lang !='ca') $lang ='es';
} 
else 
{
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if ($lang !='es' && $lang !='ca') $lang ='es';
	$_SESSION['idioma'] =$lang;
}
// Locale

$level = "..";
if ($pageType == "cover") $level = ".";

if (empty($lang)) 
{
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if ($lang !='es' && $lang !='ca') $lang ='es';
	$_SESSION['idioma'] =$lang;
}
$lang_file = $level."/includes/lang/".$lang.".inc.php";

require_once $lang_file;

function locale($key) 
{
	global $_LOCALE;
	$retorn = "#No trobat";
	if (isset($_LOCALE[$key])) $retorn = $_LOCALE[$key];
	return $retorn;
}

?>