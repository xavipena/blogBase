<!DOCTYPE HTML>
<html>
<head>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<KEY>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	
	  gtag('config', '<KEY>');
	</script>

<?php
	$level = "..";
	$jsonType = "WebPage";
	if ($pageType == "cover") 
	{	
		$level = ".";
		$jsonType = "WebSite";
	}
	else if ($isArticle)
	{
		$jsonType = "Article";
	}
	
	require "dbConnect.php";
	require_once "config.php";
	require_once "funcions.php";
	$footerNavigation = TRUE;
	$footerGoBack = FALSE;
	
	include "metadata.inc.php";
	include "json-ld.inc.php";
	$cssFile_1 = "page.css";
	$cssFile_2 = "sidebar.css";
	$cssFile_3 = "articles.css";
?>
	<link href="<?php echo $level?>/css/<?php echo $cssFile_1?>" rel="stylesheet" />
	<link href="<?php echo $level?>/css/<?php echo $cssFile_2?>" rel="stylesheet" />
	<link href="<?php echo $level?>/css/<?php echo $cssFile_3?>" rel="stylesheet" />
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	
	<script src="<?php echo $level?>/includes/astro.js"></script>
</head>
<body>
<?php 
	include "sidebarMenu.inc.php";
?>
<section class="home-section">
	<div class="rtitle"><a href="<?php echo WEB_URL?>"><?php echo WEBSITE_NAME?></a></div>
  	<div class="home-content">
      	<i class='bx bx-menu' ></i>
	</div>
	<div class="home-pageContent">
<!--div class="content"-->