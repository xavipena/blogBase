<?php
$jsonLD =   '<script type="application/ld+json">'.PHP_EOL.
            '{'.PHP_EOL.
            '"@context": "http://schema.org",'.PHP_EOL.
            '"@type": "'.$jsonType.'",'.PHP_EOL;

switch ($jsonType)
{
    case "WebSite":

        $jsonLD .=  '"name": "'.WEBSITE_NAME.'",'.PHP_EOL.
                    '"url": "'.WEB_URL.'",'.PHP_EOL.
                    '"potentialAction": {'.PHP_EOL.
                    '    "@type": "SearchAction",'.PHP_EOL.
                    '    "target": "'.WEB_URL.'/main/searchResults.php?q={search_term}",'.PHP_EOL.
                    '    "query-input": "required name=search_term"'.PHP_EOL.
                    ' }'.PHP_EOL;
        break;

    case "WebPage":

        $jsonLD .=  '"name": "'.WEBSITE_NAME.'",'.PHP_EOL.
                    '"description": "'.$arDescription.'",'.PHP_EOL.
                    '"publisher": {'.PHP_EOL.
                    '    "@type": "ProfilePage",'.PHP_EOL.
                    '    "name": "'.$arAuthor.'",'.PHP_EOL.
                    '    "url": "'.$arInstagram.'"'.PHP_EOL.
                    ' }'.PHP_EOL;
        break;

    case "Article":

        $jsonLD .=  '"headline": "'.$arTitle.'",'.PHP_EOL.
                    '"image": "'.$arImage.'",'.PHP_EOL.
                    '"author": {'.PHP_EOL.
                    '   "@type": "Person",'.PHP_EOL.
                    '   "name": "'.$arPerson.'",'.PHP_EOL.
                    '   "url": "'.$arInstagram.'"'.PHP_EOL.
                    ' },'.PHP_EOL.
                    '"genre": "'.$arCat.'",'.PHP_EOL.
                    '"inLanguage": "'.$arLang.'",'.PHP_EOL.
                    '"keywords": "'.$arKeywords.'",'.PHP_EOL.
                    '"wordcount": "'.$arWords.'",'.PHP_EOL.
                    '"publisher": {'.PHP_EOL.
                    '   "@type": "Person",'.PHP_EOL.
                    '   "name": "'.$arPerson.'",'.PHP_EOL.
                    '   "logo": {'.PHP_EOL.
                    '     "@type": "ImageObject",'.PHP_EOL.
                    '     "url": "'.WEB_URL.'/images/logo_articles.png"'.PHP_EOL.
                    '   }'.PHP_EOL.
                    ' },'.PHP_EOL.
                    '"url": "'.WEB_URL.'",'.PHP_EOL.
                    '"mainEntityOfPage": {'.PHP_EOL.
                    '   "@type": "WebPage",'.PHP_EOL.
                    '   "@id": "'.WEB_URL.'/main/articles.php"'.PHP_EOL.
                    ' },'.PHP_EOL.
                    '"datePublished": "'.$arPubDate.'",'.PHP_EOL.
                    '"dateCreated": "'.$arCreDate.'",'.PHP_EOL.
                    '"dateModified": "'.$arModDate.'",'.PHP_EOL.
                    '"description": "'.$arDescription.'"'.PHP_EOL;
        break;
}

$jsonLD .= "} ".PHP_EOL."</script>".PHP_EOL;
echo $jsonLD;
?>