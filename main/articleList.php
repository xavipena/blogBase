<?
	$isArticle = FALSE;
        $pageType = "articles";

        include "../includes/header.inc.php";
        include "../includes/dbConnect.php";

        $sql = "select * from intro where IDblog = ".WEBCODE." and type='".$pageType."' and lang = '".$lang."'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result);

        $urlImage = "../images/logo_articles.png";

        echo "<div class='xTable'>";
        echo "<div class='xCell'>";

        echo "<div class='imgRounded' style='background-image: url($urlImage)'></div>";
        echo "<div class='Centered'>".
                "<h2>".$row['title']."</h2>".
                $row['description']."</div>";
        
        echo "</div>";
        echo "</div>";

        echo "<div class='xTable xTable-cols'>";
        
        $c =0;            
        $sql = "select * from articles where IDblog = ".WEBCODE." and status ='A' and lang = '".$lang."' order by date desc";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result)) 
        {
                $thmImg ="../images/thm_un_".$row['IDarticle'].".webp";
                if (!file_exists($thmImg)) 
                {
                        $thmImg ="../images/thm_un_".$row['IDarticle'].".png";
                        if (!file_exists($thmImg)) 
                        {
                                $thmImg ="../images/thm_none.png";
                        }
                }
                $adate = date("d-m-Y", strtotime($row['date']));

                echo "<div class='xCell-left'>";
                echo "<a href='articles.php?art=".$row['IDarticle']."'>".
                        "<div class='thumbnail' style='background-image: url($thmImg)'></div>".
                        "</a></div>";
                echo "<div class='xCell-right'>";

                echo "<h3>".$row['title']."</h3>".
                        $adate."<br><span class='smallText'>".locale("strReadTime").": ".number_format($row['readTime'], 0)." ".locale("strMinutes")."</span><br>".
                        "<p class='mediumText'>".$row['excerpt']."</p>".
                        "<a class='linkButton' href='articles.php?art=".$row['IDarticle']."'>".locale("strReadArt")."</a><br>".
                        "</div>";

                $c++;
        }
        echo "</div>";

        include "../includes/signature.inc.php";
        include "../includes/footer.inc.php";	  
?>
