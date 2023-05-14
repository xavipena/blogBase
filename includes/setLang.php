<?php
	require "../includes/dbConnect.php";
	require "../includes/config.php";
    $_SESSION['idioma'] = $clean['ln'];
    $uri = str_replace("/astro", "..", $clean['pg']);
    //echo $uri;
    header("location: ".$uri);
?>
