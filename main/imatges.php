<?
	$isArticle = FALSE;
    $isImage = TRUE;
    $pageType = "zoom";

    include "../includes/header.inc.php";
	include "../includes/dbConnect.php";

    function ShowImage($row3, $t)
    {
        if ($t == "f")
        {
            echo "<img class='fullImage' src='../images/".$row3['img']."'>";
        }
        else
        {
            echo "<img class='fullImage' src='../images/".$row3['image']."'>";
        }
        echo "<div class='Centered'>";
        echo "<p class='smallText'>".$row3['caption']."</p>";
        echo "<p class='smallText'>Credit: ".$row3['credit']."</p>";
        echo "</div>";
}

    echo "<div class='fullBox'>";
    $t = empty($clean['t']) ? "" : $clean['t'];
    if ($t == "" || $t =='a')
    {
        $sql = "select * from article_images where IDarticle =".$clean['x']." and section =".$clean['y']." and sequence=".$clean['z']." and lang = '".$lang."'";
        $result3 = mysqli_query($db, $sql);
        while ($row3 = mysqli_fetch_array($result3)) {
            ShowImage($row3, $t);
        }
    }
    if ($t =='f')
    {
        $sql = "select * from imatges_photos where IDimatge =".$clean['img']." and sequence = ".$clean['s']." and lang = '".$lang."'";
        $result3 = mysqli_query($db, $sql);
        if ($row3 = mysqli_fetch_array($result3)) {
            ShowImage($row3, $t);
        }
    }
    if ($t =='w')
    {
        $sql = "select * from observacio_images where IDwatch =".$clean['obs']." and section =".$clean['y']." and sequence=".$clean['z']." and lang = '".$lang."'";
        $result3 = mysqli_query($db, $sql);
        while ($row3 = mysqli_fetch_array($result3)) {
            ShowImage($row3, $t);
            if (!empty($row3['isource'])) echo "<a target='_blank' href='".$row3['isource']."'>Imatge original</a> de ".$row3['credit'];
        }
    }
    echo "</div>";

    $goBack = TRUE;
	include "../includes/footer.inc.php";	  
?>
