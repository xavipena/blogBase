<?
	$isArticle = FALSE;
    $pageType = "cover";

    include "./includes/header.inc.php";
	include "./includes/dbConnect.php";
        
    function ShowCommon($b1, $b2) {

        $adate = date("d-m-Y", strtotime($b2['date']));
        $common = "<td width='500px' valign='top'>".
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
    $sql = "select * from intro where IDblog = ".WEBCODE." and status ='A' and lang = '".$lang."'";
    $r_intro = mysqli_query($db, $sql);
    while ($intro = mysqli_fetch_array($r_intro)) {
    
        $c += 1;

        switch ($intro['type']) {

            case 'articles':
                $sql = "select * from articles where IDblog = ".WEBCODE." and status ='A' and lang = '".$lang."' order by date desc limit 1";
                $result = mysqli_query($db, $sql);
                if ($row = mysqli_fetch_array($result)) 
                {
                    $urlImage = "./images/logo_articles.png";
                    echo "<td valign='top'><a href ='main/articleList.php'><div class='imgRounded' style='background-image: url($urlImage)'></div></a></td>".
                            ShowCommon($intro, $row).
                            "<a class='linkButton' href='main/articles.php?art= ".$row['IDarticle']."'>".locale("strReadArt")."</a>".
                            "<a class='linkButton' href='main/articleList.php'>".locale("strShowAllArt")."</a>".
                            "</td>";
                }
                break;

            case 'imatges':
                $sql = "select * from imatges where status ='A' and lang = '".$lang."' order by date desc limit 1";
                $result = mysqli_query($db, $sql);
                if ($row = mysqli_fetch_array($result)) 
                {
                    $urlImage = "./images/logo_fotos.png";
                    echo "<td valign='top'><a href ='main/fotoList.php'><div class='imgRounded' style='background-image: url($urlImage)'></div></a></td>".
                            ShowCommon($intro, $row).
                            "<a class='linkButton' href='main/fotos.php?img= ".$row['IDimatge']."'>".locale("strReadImg")."</a>".
                            "<a class='linkButton' href='main/fotoList.php'>".locale("strShowAllImg")."</a><br>".
                            "</td>";
                }
                break;

            case 'observa':
                $sql = "select * from observacions where status ='A' and lang = '".$lang."' order by date desc limit 1";
                $result = mysqli_query($db, $sql);
                if ($row = mysqli_fetch_array($result)) 
                {
                    $urlImage = "./images/logo_telescopi.png";
                    echo "<td valign='top'><a href ='main/watchList.php'><div class='imgRounded' style='background-image: url($urlImage)'></div></a></td>".
                            ShowCommon($intro, $row).
                            "<a class='linkButton' href='main/watches.php?obs= ".$row['IDwatch']."'>".locale("strReadObs")."</a>".
                            "<a class='linkButton' href='main/watchList.php'>".locale("strShowAllObs")."</a><br>".
                            "</td>";
                }
                break;
        }
        echo "</tr><tr>"; 
    }
    echo "</tr><tr></table>";
    echo "</div>"; 

    $footerNavigation = FALSE;
    include "./includes/footer.inc.php";	  
?>