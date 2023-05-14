<?
	$isArticle = FALSE;
	$pageType = "";
	include "../includes/header.inc.php";
	
	$IDarticle = 0;
	$sql = "select * from articles where IDarticle =".$IDarticle." and lang = '".$lang."'";
	$result = mysqli_query($db, $sql);
	if ($row = mysqli_fetch_array($result)) {

		echo "<article id=".$row['IDarticle'].$row['lang'].">";

		//echo "<div class='article'>".
		echo "<h1>".$row['title']."</h1>";
		echo "<p class='normalExcerpt'>".$row['excerpt']."</p>"; 
		echo "<table width='100%'cellpadding='10px'>";
		echo "<tr><td colspan='3'><hr></td></tr>";

		$sql = "select * from article_details where IDarticle =".$IDarticle." and status ='A' and lang = '".$lang."' order by position";
		$result2 = mysqli_query($db, $sql);
		while ($row2 = mysqli_fetch_array($result2)) {
			echo "<tr><td width='20%' class='boldText' valign='top' align='left'>".$row2['section']."</td>".
					"<td width='50%' class='normalText' valign='top'>".$row2['text']."</td>".
					"<td width='30%' valign='top' align='left'>";

			$sql = "select * from article_links where IDarticle =".$IDarticle." and section =".$row2['position']." and status ='A' and lang = '".$lang."' order by name";
			$result3 = mysqli_query($db, $sql);
			while ($row3 = mysqli_fetch_array($result3)) {
				echo "<a href='".$row3['url']."'>".$row3['name']."<br>";
			}
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>".
				"</article>";
	}

	include "../includes/footer.inc.php";	  
?>
