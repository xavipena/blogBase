<?php
    $sections = array();
    $sql = "select section from article_details where IDarticle =".$IDarticle." and status ='A' and lang = '".$lang."' order by position";
    $result2 = mysqli_query($db, $sql);
    while ($row2 = mysqli_fetch_array($result2)) 
    {
        if ($row['section'] != "")
        {
            $sections[] = $row['section']; 
        }
    }
    echo "<div class='aKeywords'>";
    echo "<h2>".locale("strKeys")."</h2>";
    foreach ($sections as $sectiom) 
    {
        echo "<a href=''>".$section."</a><br>";
    }
    echo "</div>";
?>