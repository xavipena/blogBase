<?
	$isArticle = TRUE;
	$pageType = "";

	include "../includes/header.inc.php";
	
	$IDarticle = $clean['art'];
	$status = empty($clean['sts']) ? "A" : $clean['sts'];
	if (!empty($clean['lan'])) $lang = $clean['lan']; // requested

	$sql = "select * from articles where IDarticle =".$IDarticle." and lang = '".$lang."' and status ='".$status."'";
	$result = mysqli_query($db, $sql);
	if ($row = mysqli_fetch_array($result)) {

		echo "<article id=".$row['IDarticle'].$row['lang'].">";

		echo "<div class='artTable'>";
        echo "<div class='artCell'>";

		$adate = date("d-m-Y", strtotime($row['date']));
		$urlImage = "../images/logo_articles.png";
		echo "<div class='imgRounded' style='background-image: url($urlImage)'></div>".
				"<h1>".$row['title']."</h1>";
		echo "<p class='normalExcerpt'>".$row['excerpt']."</p>"; 
		echo "<time datetime='".$row['date']."'>".$adate."</time>";
		if ($row['updated'] != "2001-01-01" && $row['updated'] != $row['date']) 
		{
			$adate = date("d-m-Y", strtotime($row['updated']));
			echo "<p>".locale("strUpdated").$adate."</p>";
		}
		echo "<br><span class='smallText'>".locale("strReadTime").": ".number_format($row['readTime'], 0)." ".locale("strMinutes")."</span>";

// content start

		if ($isMob)
		{ 
			if ($isTab) 
			{ 
				include "artContentTablet.inc.php";
			} 
			else
			{ 
				include "artContentMobile.inc.php";
			} 
		}
		else
		{
			if ($isAndroid)
			{
				include "artContentTablet.inc.php";
			}
			else
			{
				include "artContentDesktop.inc.php";
			}
		} 

	// -------------------
	// related links
	// -------------------

	include "../includes/relatedLinks.inc.php";

// content end

		echo "</div>";
		echo "</div>";

		echo "</article>";
	}

	$goBack = TRUE;
	$table = 1;
	include "../includes/navigation.inc.php";
	include "../includes/signature.inc.php";
	include "../includes/footer.inc.php";	  
?>
