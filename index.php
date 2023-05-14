<?
	$isArticle = FALSE;
    $pageType = "cover";

    include "./includes/header.inc.php";
	include "./includes/dbConnect.php";
        
    function ShowCommon($b1, $b2) {

        $adate = date("d-m-Y", strtotime($b2['date']));
        $common = "<h1>".$b1['title']."</h1>".
                  $b1['counts']." ".locale("strCountArt").
                  "<h2>".$b2['title']."</h2>".
                  $adate."<br><br>".
                  $b2['excerpt']."<br><br>";
        return $common;
    }    

    // latest entry

    //echo "<div class='mainBox' style='left:100px'>";
    echo "<div class='mainBox'>";

    $sql = "select * from articles where IDblog = ".WEBCODE." and status ='A' and lang = '".$lang."' order by date desc limit 1";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);

    $adate = date("d-m-Y", strtotime($row['date']));
    echo "<h2>".$row['title']."</h2>".
         $adate."<br><br>".
         $row['excerpt']."<br><br>";

    $sql = "select * from article_details where IDarticle = ".$row['IDarticle']." and lang = '".$lang."' limit 1";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);

    echo "<p>".substr($row['text'], 0, 300)."...</p>";
    
    $sql = "select * from articles where IDblog = ".WEBCODE." and status ='A' and lang = '".$lang."' order by date desc limit 1";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    
    echo "<a class='linkButton' href='./main/articles.php?typ=".$row['type']."&art=".$row['IDarticle']."'>".locale("strReadArt")."</a>".
         "<a class='linkButton' href='./main/articleList.php?typ=".$row['type']."'>".locale("strShowAllArt")."</a>";
    
    echo "<h2>".locale("strMoreCats").":</h2>";
    echo "</div>"; 
    
    // categories
    
    echo "<div class='artTable artTable-cols'>";

    $c = 0;        
    $sql = "select * from intro where IDblog = ".WEBCODE." and type <> 'cover' and status ='A' and lang = '".$lang."'";
    $r_intro = mysqli_query($db, $sql);
    while ($intro = mysqli_fetch_array($r_intro)) 
    {    
        $c += 1;

        echo "<div class='artCell'>";
        echo "<div class='card'>";

        switch ($intro['type']) {

            case 'articles':
                $sql = "select * from articles where IDblog = ".WEBCODE." and status ='A' and lang = '".$lang."' order by date desc limit 1";
                $result = mysqli_query($db, $sql);
                if ($row = mysqli_fetch_array($result)) 
                {
                    $urlImage = "./images/logo_articles.png";
                    echo "<a href ='main/articleList.php'><div class='imgRounded' style='background-image: url($urlImage)'></div></a>";

                    echo "<div class='cardText'>";

                    echo ShowCommon($intro, $row).
                         "<a class='linkButton' href='main/articles.php?art=".$row['IDarticle']."'>".locale("strReadArt")."</a>".
                         "<a class='linkButton' href='main/articleList.php'>".locale("strShowAllArt")."</a>";
                    echo "</div>"; 
                }
                break;

        }
        echo "</div>"; 
        echo "</div>"; 
    }
    echo "</div>"; 

    $footerNavigation = FALSE;
    include "./includes/footer.inc.php";	  
?>