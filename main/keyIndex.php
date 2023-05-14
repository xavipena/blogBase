<?
	$isArticle = FALSE;
	$pageType = "";
	include "../includes/header.inc.php";
	
	$status = empty($clean['sts']) ? "A" : $clean['sts'];
	if (!empty($clean['lan'])) $lang = $clean['lan']; // requested

    echo "<article>";

    $keywords = array();
    $sql =  "select value from article_metadata ".
            "join articles on IDblog = 1 and ".
            "     articles.IDarticle = article_metadata.IDarticle and ".
            "     articles.lang = article_metadata.lang ".
            "where IDmeta = 17 and articles.lang = '$lang'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) 
    {
        $tokens = array_map('trim', explode(',', $row['value']));
        foreach ($tokens as $token) 
        {
            if (!in_array($token, $keywords))
            {
                $keywords[] = $token; 
            }
        }
    }
    sort($keywords);
    $c = 0;
    $numColumns = 7;
    
    echo "<h2>".locale("strSelectKey")."</h2>";

    echo "<div class='xTable keyTable-cols'>";

    foreach ($keywords as $keyw) 
    {
        echo "<div class='artCell'>";
        echo "<a href='search.php?key=".$keyw."'>".$keyw."</a>";
        echo "</div>";
    }
    echo "</div>";
    echo "</article>";

    $goBack = TRUE;
//	include "../includes/navigation.inc.php";
//	include "../includes/signature.inc.php";
	include "../includes/footer.inc.php";	  
?>
