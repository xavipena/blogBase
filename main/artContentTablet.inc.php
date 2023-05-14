<?php
	echo "<table width='100%' cellpadding='10px'>";
	echo "<tr><td colspan='2'><hr></td></tr>";

	echo "<tr><td class='normalText' valign='top'>".locale("strContent")."<ul>";

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
	echo "</ul></td></tr>";

	echo "<tr><td><hr></td></tr>";

	// -------------------
	// Start article
	// -------------------

	$sql = "select * from article_details where IDarticle =".$IDarticle." and status ='A' and lang = '".$lang."' order by position";
	$result2 = mysqli_query($db, $sql);
	while ($row2 = mysqli_fetch_array($result2)) 
	{
		$localURL = "sec".$row2['position'];
		echo "<tr><td class='boldText' valign='top' align='left' id='$localURL'>".$row2['section']."</td></tr>";
        echo "<tr><td class='normalText' valign='top'>".$row2['text']."</td></tr>";

		// -------------------
		// images
		// -------------------

		$sql = "select * from article_images where IDarticle =".$IDarticle." and section =".$row2['position']." and status ='A' and lang = '".$lang."' order by sequence";
		$result3 = mysqli_query($db, $sql);
		while ($row3 = mysqli_fetch_array($result3)) 
		{
			echo "<tr><td class='smallText' valign='top' align='left'>".$row3['caption'];
            if (!empty($row3['credit'])) echo "<br>(".$row3['credit'].")";
			echo "</td></tr>";
			echo "<tr><td valign='top'><a href='imatges.php?x=".$IDarticle."&y=".$row3['section']."&z=".$row3['sequence']."'>".
					"<img class='artImage' src='../images/".$row3['image']."'";
			if ($row3['alternate'] != "") 
			{
				echo " alt='".$row3['alternate']."'";
			}
			echo "></a></td></tr>";
			echo "<tr><td></td></tr>";
		}
		
		// show code

		$sql = "select * from article_code where IDarticle =".$IDarticle." and section =".$row2['position']." and status ='A' order by sequence";
		$result4 = mysqli_query($db, $sql);
		while ($row4 = mysqli_fetch_array($result4)) 
		{
			$txt = str_replace("ç", "$", $row4['code']);
			echo "<tr><td valign='top'><pre><code>".$txt."</code></pre></td></tr>";
		}

		// -------------------
		// show embed
		// -------------------

		$sql = "select * from article_quotes where IDarticle =".$IDarticle." and section =".$row2['position']." and status ='A' and lang = '$lang'";
		$result4 = mysqli_query($db, $sql);
		while ($row4 = mysqli_fetch_array($result4)) 
		{
			echo "<tr><td>".$row4['embed']."</td></tr>";
		}
	}
	echo "</table>";
?>