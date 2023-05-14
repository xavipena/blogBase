<?
        $isArticle = FALSE;
        $pageType = "";
        
        include "../includes/header.inc.php";
        include "../includes/dbConnect.php";
    
        $keyword = empty($clean['key']) ? "" : $clean['key'];
        if ($keyword == "") Header("location: ../index.php");
        
        echo "<article>".
                "<table cellspacing='10px'><tr>";

        $c =0;
        $sql = "select * from articles ".
                "join article_metadata ".
                "  on articles.IDarticle = article_metadata.IDarticle and articles.lang = article_metadata.lang and IDmeta = 17 ".
                "where IDblog = ".WEBCODE." and status ='A' and articles.lang = '".$lang."' ".
                "  and value like '%$keyword%' ".
                "order by date desc";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result))  
        {
                if ($c >0 && $c %2 ==0) echo "</tr><tr>";

                $thmImg ="../images/thm_un_".$row['IDarticle'].".png";
                if (!file_exists($thmImg)) {

                        /*
                        $sql2 = "select * from article_images where IDarticle =".$row['IDarticle']." and status ='A' and lang = '".$lang."' limit 1";
                        $result2 = mysqli_query($db, $sql2);
                        if ($row2 = mysqli_fetch_array($result2)) {
                                $thmImg ="../images/thm_".$row2['image'];
                                if (!file_exists($thmImg)) {
                                        createThumb("../images/".$row2['image'],$thmImg);
                                }
                        }
                        */
                        $thmImg ="../images/thm_un_".$row['IDarticle'].".webp";
                        if (!file_exists($thmImg)) 
                        {
                                $thmImg ="../images/thm_none.png";
                        }
               }

                echo "<td valign='top'><a href='articles.php?art=".$row['IDarticle']."'>".
                        "<div class='thumbnail' style='background-image: url($thmImg)'></div>".
                        "</td><td width='300px' valign='top'>".
                        "<h3>".$row['title']."</h3>".
                        $row['date']."<br>".
                        "<p class='smallText'>".$row['excerpt']."</p>".
                        "<a class='linkButton' href='articles.php?art=".$row['IDarticle']."'>".locale("strReadArt")."</a><br>".
                        "</td>";
                $c++;
        }
        echo "</tr></table>".
                "</article>"; 

	include "../includes/footer.inc.php";	  
?>
