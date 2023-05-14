<?php
// prepare the title for <title> tag
$saveTitle = "";
$sql = "";
if (!empty($clean['art'])) 
{
    $sql  = "select title from articles where IDblog = ".WEBCODE." and IDarticle = ".$clean['art']." and lang = '".$lang."'";
}
else if (!empty($clean['img'])) 
{
    $sql = "select * from imatges where IDimatge =".$clean['img']." and lang = '".$lang."'";
} 
else if (!empty($clean['obs']))
{
    $sql = "select * from observacions where IDwatch =".$clean['obs']." and lang = '".$lang."'";
}
if ($sql != "") 
{
    $result = mysqli_query($db, $sql);
    if ($row = mysqli_fetch_array($result)) 
    {
        $saveTitle = str_replace("'",".",$row['title']);
        echo "<title>$saveTitle</title>".PHP_EOL;
    }
}
else
{
    $sql = "select title from intro where IDblog = ".WEBCODE." and type = '".$pageType."' and lang = '".$lang."'";
    $result = mysqli_query($db, $sql);
    if ($row = mysqli_fetch_array($result)) 
    {
        $titleTxt = str_replace("'",".",$row['title']);
        echo "<title>".$titleTxt."</title>".PHP_EOL;
    }
    else echo "<title>".WEBSITE_NAME."</title>".PHP_EOL;
}

// ----------------------------------------------------------
// Variables to load for JSON-LD
// ----------------------------------------------------------
$arTitle = "";
$arDescription = "";
$arPubDate = "";
$arCreDate = "";
$arModDate = "";
$arAuthor = "";
$arPerson = "";
$arWords = "";
$arKeywords = "";
$arCat = "";
$arImage = "";
$arLang = $lang;
$arInstagram = AUTHOR_URL;

// ----------------------------------------------------------
// prepare metadata for <meta> tags
// for each article type
// ----------------------------------------------------------
$sql  = "select * from intro_metadata where IDblog = ".WEBCODE." and lang = '".$lang."'";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) 
{
    $content = $row['content'];
    if ($row['name'] == "description") 
    {
        $content = $row['content'].". ".$saveTitle;
        $arCat = $row['content'];
    }
    if ($row['name'] == "keywords") 
    {
        $arKeywords = $content;
    }

    if ($row['type'] == "rel") 
    {
        if ($row['name'] == "canonical")
        {
            if ($isArticle)
            {
                $content = WEB_URL."/main/articles.php";
            }
            else
            {
                $content = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $parts = explode("?",$content);
                $content = $parts[0];
            }
        }
        echo "<link ".$row['type']."='".$row['name']."' content='".$content."'/>".PHP_EOL;
    }
    else 
    {
        echo "<meta ".$row['type']."='".$row['name']."' content='".$content."'/>".PHP_EOL;
    }
}
include "open-graph-protocol.php";

$articleID = empty($clean['art']) ? "" : $clean['art'];
//if (empty($articleID))
//{
//    $articleID = empty($clean['img']) ? "" : $clean['img'];
//}
if (!empty($articleID))
{
    // ----------------------------------------------------------
    // prepare metadata for <meta> tags  -  articles
    // ----------------------------------------------------------
    // General tags
    $ogp = new OpenGraphProtocol();

    $sql  = "select article_metadata.value, metadata.section, metadata.property from article_metadata ".
            "join metadata on article_metadata.IDmeta = metadata.IDmeta ".
            "where protocol = 'og' and IDarticle = $articleID and section = '' and lang = '$lang' ";

    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) 
    {
        if ($row['value'] == "") continue;
        
        switch ($row['property']) 
        {
            case "locale":
                $ogp->setLocale($row['value']);
                break;
            case "site_name":
                $ogp->setSiteName($row['value']);
                break;
            case "title":
                $ogp->setTitle($row['value']);
                $arTitle = $row['value'];
                break;
            case "description":
                $ogp->setDescription($row['value']);
                $arDescription = $row['value'];
                break;
            case "type":
                $ogp->setType($row['value']);
                break;
            case "url":
                $ogp->setURL($row['value']);
                break;
            case "determiner":
                $ogp->setDeterminer($row['value']);
                break;
        }
    }

    // image tags
    $image = new OpenGraphProtocolImage();

    $sql  = "select article_metadata.value, metadata.section, metadata.property from article_metadata ".
            "join metadata on article_metadata.IDmeta = metadata.IDmeta ".
            "where protocol = 'og' and IDarticle = $articleID and section = 'image' and lang = '$lang' ";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) 
    {
        if ($row['value'] == "") continue;

        switch ($row['property']) 
        {
            case "url":
                $image->setURL($row['value']);
                break;
            case "secure_url":
                $image->setSecureURL($row['value']);
                break;
            case "type":
                $image->setType($row['value']);
                break;
            case "width":
                $image->setWidth($row['value']);
                break;
            case "height":
                $image->setHeight($row['value']);
                break;
        }
    }

    $ogp->addImage($image);

    // article tags
    $article = new OpenGraphProtocolArticle();

    $sql  = "select article_metadata.value, metadata.section, metadata.property from article_metadata ".
            "join metadata on article_metadata.IDmeta = metadata.IDmeta ".
            "where protocol = 'og' and IDarticle = $articleID and section = 'article' and lang = '$lang' ";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) 
    {
        switch ($row['property']) 
        {
            case "published_time":
                $date = new DateTimeImmutable($row['value']);
                $article->setPublishedTime($date->format('Y-m-d'));
                $arPubDate = $date->format('Y-m-d');
                $arCreDate = $date->format('Y-m-d');
                break;
            case "modified_time":
                $date = new DateTimeImmutable($row['value']);
                $article->setModifiedTime($date->format('Y-m-d'));
                $arModDate = $date->format('Y-m-d');
                break;
            case "section":
                $article->setSection($row['value']);
                break;
            case "tag":
                $article->addTag($row['value']);
                break;
        }
    }

    // profile tags
    $author = new OpenGraphProtocolProfile();
    $fname = "";
    $lname = "";

    $sql  = "select article_metadata.value, metadata.section, metadata.property from article_metadata ".
            "join metadata on article_metadata.IDmeta = metadata.IDmeta ".
            "where protocol = 'og' and IDarticle = $articleID and section = 'profile'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) 
    {
        switch ($row['property']) 
        {
            case "first_name":
                $author->setFirstName($row['value']);
                $fname = $row['value'];
                break;
            case "last_name":
                $author->setLastName($row['value']);
                $lname = $row['value'];
                break;
            case "username":
                $author->setUsername($row['value']);
                break;
            case "gender":
                $author->setGender($row['value']);
                break;
        }
        //$article->addAuthor($author);
    }

    $arPerson = $fname." ".$lname;
    $arAuthor = $arPerson;

    echo $ogp->toHTML();
    echo PHP_EOL;
    echo $author->toHTML();
    echo PHP_EOL;
    echo $article->toHTML();
    echo PHP_EOL;

    // Twitter
    $sql  = "select article_metadata.value, metadata.section, metadata.property, article_metadata.IDmeta as Meta from article_metadata ".
            "join metadata on article_metadata.IDmeta = metadata.IDmeta ".
            "where protocol = 'tw' and IDarticle = $articleID and section = '' and lang = '$lang'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) 
    {
        // Model: <meta name="twitter:card" content="summary" />
        $value = $row['value'];
        if ($row['Meta'] == 35) 
        {
            $mins =  number_format($row['value'], 0);
            $value = $mins." minutos";
            $arWords = $mins * 220; // adjusted
        }
        if ($row['Meta'] == 33)
        {
            $arImage = $value;
        }
        echo "<link name='twitter:".$row['property']."' content='$value'/>".PHP_EOL;
    }
}
?>