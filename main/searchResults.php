<?
    $isArticle = FALSE;
    $pageType = "";
    
    include "../includes/header.inc.php";
    include "../includes/dbConnect.php";

    $keyword = empty($clean['srchKey']) ? "" : $clean['srchKey'];
    if ($keyword == "") 
    {
        $keyword = empty($clean['q']) ? "" : $clean['q'];
        if ($keyword == "")
        {
            Header("location: ../index.php");
        }
    }
    
    echo "<div class='xTable xTable-cols'>";

    $aux = "";
    $c = 0;
    $sql = "select article_details.IDarticle, text from article_details ".
            "join articles ".
            "  on articles.IDarticle = article_details.IDarticle and articles.IDblog = ".WEBCODE." and articles.status ='A' ".
            "where article_details.lang = '".$lang."' ".
            "  and text like '%".$clean['srchKey']."%' ".
            "order by articles.date desc";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result))  
    {
        if ($aux != $row['IDarticle']) 
        {
            $aux = $row['IDarticle'];

            $sql2 = "select * from articles where IDarticle = ".$row['IDarticle'];
            $res2 = mysqli_query($db, $sql2);
            $row2 = mysqli_fetch_array($res2); 

            //if ($c >0 && $c %2 ==0) echo "</tr><tr>";

            $thmImg ="../images/thm_un_".$row['IDarticle'].".png";
            if (!file_exists($thmImg)) 
            {
                $thmImg ="../images/thm_un_".$row['IDarticle'].".webp";
                if (!file_exists($thmImg)) 
                {
                    $thmImg ="../images/thm_none.png";
                }
            }

            echo "<div class='xCell-left'>";
            echo "<a href='articles.php?art=".$row['IDarticle']."'>".
                    "<div class='thumbnail' style='background-image: url($thmImg)'></div>".
                    "</a></div>";
            echo "<div class='xCell-right'>".
                    "<h3>".$row2['title']."</h3>".
                    $row2['date']."<br>".
                    "<p class='smallText'>".$row2['excerpt']."</p>".
                    "<a class='linkButton' href='articles.php?art=".$row['IDarticle']."'>".locale("strReadArt")."</a><br>".
                        "</div>";

            $c++;
        }
    }
    if ($c == 0) 
    {
        echo "<div class='Centered'>".locale("strNoResultsFound")."</div>";
    }
    echo "</div>";

    include "../includes/signature.inc.php";
	include "../includes/footer.inc.php";	  
?>
