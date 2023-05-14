<a id='refs'></a>
<?php
if ($isMob && !$isTab)
{
    $c = 0;
    $sql = "select * from article_related where IDarticle =".$IDarticle." and status ='A' order by sequence";
    $result3 = mysqli_query($db, $sql);
        while ($row3 = mysqli_fetch_array($result3)) 
        {
            if ($c == 0) echo "<span class='boldText'>".locale("strReferences")."</span><ul>";
            $tkns = explode("/",$row3['url']);
            $source = $tkns[0]."//".$tkns[2];
            echo "<li><a target='_blank' href='".$row3['url']."'>".$row3['name']."</a>".
            "<br><span class='smallText'>".$source."</span></li>";
            
            $c += 1;
        }
        if ($c) echo "</ul>";
}
else
{
    echo "<table width='100%'>";
    $c = 0;
    $sql = "select * from article_related where IDarticle =".$IDarticle." and status ='A' order by sequence";
    $result3 = mysqli_query($db, $sql);
    while ($row3 = mysqli_fetch_array($result3)) 
    {
        echo "<tr>";
        $title = $c == 0 ? "<td class='boldText' width='20%'>".locale("strReferences")."</td>" : "<td></td>";
        $tkns = explode("/",$row3['url']);
        $source = $tkns[0]."//".$tkns[2];
        echo "<tr>".$title."<td colspan='2'><a target='_blank' rel='nofollow' href='".$row3['url']."'>".$row3['name']."</a>".
             "<br><span class='smallText'>".$source."</span></td></tr>";
        $c += 1;
    }	
    echo "</table>";
}
?>