<?php
$allOfThem = "";
$prevTitle = "";
$nextTitle = "";

function ArticleTitle($db, $id) 
{
    $linkTitle = "";
    $allOfThem = locale("strShowAllArt");
    if ($id == 0) $linkTitle = "<a href='articleList.php'>$allOfThem</a>";
    else 
    {
        $sql = "select title from articles where IDarticle =".$id." and lang = '".$GLOBALS['lang']."' and status ='".$GLOBALS['status']."'";
        $result4 = mysqli_query($db, $sql);
        if ($row4 = mysqli_fetch_array($result4)) 
        {
            $linkTitle = "<a href='articles.php?art=".$id."'>".$row4['title']."</a>";
        }
    }
    return $linkTitle;
}

function FotoTitle($db, $id) 
{
    $linkTitle = "";
    $allOfThem = "Todas las imágenes";
    if ($id == 0) $linkTitle = "<a href='fotoList.php'>$allOfThem</a>";
    else 
    {
        $sql = "select title from imatges where IDimatge =".$id." and lang = '".$GLOBALS['lang']."' and status ='A'";
        $result4 = mysqli_query($db, $sql);
        if ($row4 = mysqli_fetch_array($result4)) 
        {
            $linkTitle = "<a href='fotos.php?img=".$id."'>".$row4['title']."</a>";
        }
    }
    return $linkTitle;
}

function ObservaTitle($db, $id) 
{
    $linkTitle = "";
    $allOfThem = "Todas las observaciones";
    if ($id == 0) $linkTitle = "<a href='watchList.php'>$allOfThem</a>";
    else 
    {
        $sql = "select title from observacions where IDwatch =".$id." and lang = '".$GLOBALS['lang']."' and status ='A'";
        $result4 = mysqli_query($db, $sql);
        if ($row4 = mysqli_fetch_array($result4)) 
        {
            $linkTitle = "<a href='watches.php?obs=".$id."'>".$row4['title']."</a>";
        }
    }
    return $linkTitle;
}

switch ($table) {

    case 1:

        $prevTitle = ArticleTitle($db, $row['prev']);
        $nextTitle = ArticleTitle($db, $row['next']);
        break;

    case 2:

        $prevTitle = FotoTitle($db, $row['prev']);
        $nextTitle = FotoTitle($db, $row['next']);
        break;

    case 3:

        $prevTitle = ObservaTitle($db, $row['prev']);
        $nextTitle = ObservaTitle($db, $row['next']);
        break;
}
$imgHeight = "height='10px'";
$imgPrev = "<img src='../images/arrow-prev.png' $imgHeight>";
$imgNext = "<img src='../images/arrow-next.png' $imgHeight>";
echo "<div class='footerDiv'><div class='toLeft'>".$imgPrev." ".$prevTitle." ".$imgPrev."</div><br><hr>".
     "<div class='toRight'>".$imgNext." ".$nextTitle." ".$imgNext."</div><br><br></div>";

?>