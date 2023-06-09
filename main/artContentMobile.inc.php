<?php
	echo "<hr>".locale("strContent")."<ul>";

	// -------------------
	// Content
	// -------------------

	$sql = "select * from article_details where IDarticle =".$IDarticle." and status ='A' and lang = '".$lang."' and section <> '' order by position";
	$result3 = mysqli_query($db, $sql);
	while ($row3 = mysqli_fetch_array($result3)) 
	{
		$localURL = "#sec".$row3['position'];
		echo "<li><a href='".$localURL."'>".$row3['section']."</a></li>";
	}

	// -------------------
	// Check related links
	// -------------------

	$sql = "select count(*) as cnt from article_related where IDarticle =".$IDarticle." and status ='A'";
	$result3 = mysqli_query($db, $sql);
	$row3 = mysqli_fetch_array($result3); 

	if ($row3['cnt'] > 0) echo "<li><a href='#refs'>".locale("strReferences")."</a></li>";
	echo "</ul><hr>";

	// -------------------
	// Start article
	// -------------------

	$sql = "select * from article_details where IDarticle =".$IDarticle." and status ='A' and lang = '".$lang."' order by position";
	$result2 = mysqli_query($db, $sql);
	while ($row2 = mysqli_fetch_array($result2)) 
	{
		$localURL = "sec".$row2['position'];
		echo "<p><a id='$localURL'>".$row2['section']."</a></p>";
		echo "<p class='normalText'>".$row2['text']."</p>";

		// -------------------
		// images, a row
		// -------------------

		$sql = "select * from article_images where IDarticle =".$IDarticle." and section =".$row2['position']." and status ='A' and lang = '".$lang."' order by sequence";
		$result3 = mysqli_query($db, $sql);
		while ($row3 = mysqli_fetch_array($result3)) {
			
			echo "<a href='imatges.php?x=".$IDarticle."&y=".$row3['section']."&z=".$row3['sequence']."'>".
					"<img class='artImage' src='../images/".$row3['image']."'";
			if ($row3['alternate'] != "") 
			{
				echo " alt='".$row3['alternate']."'";
			}
			echo "></a>";
			
			echo "<span class='smallText'>".$row3['caption'];
			if (!empty($row3['credit'])) echo " (".$row3['credit'].")"; 
			echo "</span>";
		}
		
		// -------------------
		// show code
		// -------------------

		$sql = "select * from article_code where IDarticle =".$IDarticle." and section =".$row2['position']." and status ='A' order by sequence";
		$result4 = mysqli_query($db, $sql);
		while ($row4 = mysqli_fetch_array($result4)) 
		{
			$txt = str_replace("�", "$", $row4['code']);
			echo "<pre><code>".$txt."</code></pre>";
		}

		// -------------------
		// show embed
		// -------------------

		$sql = "select * from article_quotes where IDarticle =".$IDarticle." and section =".$row2['position']." and status ='A' and lang = '$lang'";
		$result4 = mysqli_query($db, $sql);
		while ($row4 = mysqli_fetch_array($result4)) 
		{
			echo "".$row4['embed']."";
		}
	}
?>