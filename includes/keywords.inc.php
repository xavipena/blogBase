<?php
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
echo "<div class='aKeywords'>";
echo "<h2>".locale("strKeys")."</h2>";
foreach ($keywords as $keyw) 
{
    echo "<a href='search.php?key=".$keyw."'>".$keyw."</a><br>";
}
echo "</div>";
?>