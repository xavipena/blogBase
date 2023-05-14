<?
	$isArticle = FALSE;
    $pageType = "categories";

    include "../includes/header.inc.php";
	include "../includes/dbConnect.php";
        
    function ShowCommon($b1, $b2) {

        $adate = date("d-m-Y", strtotime($b2['date']));
        $common = "<td class='mainArticle'>".
                    "<h1>".$b1['title']."</h1>".
                    $b1['counts']." ".locale("strCountArt").
                    "<h2>".$b2['title']."</h2>".
                    $adate."<br>".
                    "<p class='normalText'>".$b2['excerpt']."</p>";
        return $common;
    }    

    echo "<div class='mainBox' style='left:100px'>".
            "<table cellpadding='10'><tr>";

    $c = 0;        
    $sql = "select * from intro where IDblog = ".WEBCODE." and type <> 'cover' and status ='A' and lang = '".$lang."'";
    $r_intro = mysqli_query($db, $sql);
    while ($intro = mysqli_fetch_array($r_intro)) {
    
        $c += 1;

        switch ($intro['type']) {

            case 'articles':
                $sql = "select * from articles where IDblog = ".WEBCODE." and status ='A' and lang = '".$lang."' order by date desc limit 1";
                $result = mysqli_query($db, $sql);
                if ($row = mysqli_fetch_array($result)) 
                {
                    $urlImage = "../images/logo_articles.png";
                    echo "<td valign='top'><a href ='articleList.php'><div class='imgRounded' style='background-image: url($urlImage)'></div></a></td>".
                            ShowCommon($intro, $row).
                            "<a class='linkButton' href='articles.php?art=".$row['IDarticle']."'>".locale("strReadArt")."</a>".
                            "<a class='linkButton' href='articleList.php'>".locale("strShowAllArt")."</a>".
                            "</td>";
                }
                break;
        }
        echo "</tr><tr>"; 
    }
    echo "</tr><tr></table>";
    echo "</div>"; 

    $footerNavigation = FALSE;
    include "../includes/footer.inc.php";	  
?>