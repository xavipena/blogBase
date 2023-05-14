<?php
    $isArticle = FALSE;
    $pageType = "";

	include "../includes/header.inc.php";
?>
</head>
<body>
<?php 
    function GetTitle($db, $ty) 
    {
        $ln = $GLOBALS['lang'];
        $sql = "select title from intro where IDblog = ".WEBCODE." and type = '$ty' and lang ='$ln'";
        $res = mysqli_query($db, $sql);
        $int = mysqli_fetch_array($res);
        return $int['title'];
    }

    function ListArticlesForBlog($blog, $db)
    {
        $break = "";
        $c = 0;
        $ln = $GLOBALS['lang'];
            
        echo "<ul>";
        $sql = "select IDarticle, title, type from articles where IDblog = $blog and status ='A' and lang = '$ln' order by type, date desc";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result)) 
        {
            if ($break != $row['type']) 
            {
                echo "<h2>".GetTitle($db,$row['type'])."</h2>";
                $break = $row['type'];
            }
            echo "<li><a href='articles.php?art=".$row['IDarticle']."'>".$row['title']."</a></li>";
            $c += 1;
        }
        echo "</ul>";
    }

    function ListAdditionalArticles($db)
    {
        $ln = $GLOBALS['lang'];

        echo "<ul>";
        echo "<h2>".GetTitle($db, 'imatges')."</h2>";
        $c = 0;
        $sql = "select IDimatge, title from imatges where status ='A' and lang = '$ln' order by date desc";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result)) 
        {
            echo "<li><a href='fotos.php?img=".$row['IDimatge']."'>".$row['title']."</a></li>";
            $c += 1;
        }
        echo "<h2>".GetTitle($db, 'observa')."</h2>";
        $c = 0;
        $sql = "select IDwatch, title from observacions where status ='A' and lang = '$ln' order by date desc";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result)) 
        {
            echo "<li><a href='watches.php?art=".$row['IDwatch']."'>".$row['title']."</a></li>";
            $c += 1;
        }
        echo "</ul>";
    }

    //--- new content -------------------- 

    echo "<div style='width:90%; margin:auto; font-size:10pt;'>";

    echo "<table cellpadding='10' align='center'>";
    echo "<tr><td>";
    ListArticlesForBlog(WEBCODE, $db);
    ListAdditionalArticles($db);
    echo "</td></tr></table>";

    // --- end content -------------------

	include "../includes/footer.inc.php";	  
?>