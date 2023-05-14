<?php
/*
 * Created on 01/04/2008
 */
$level = "..";
if ($pageType == "cover") $level = ".";
?>
<hr>
<div class='Centered'>
    <div class="Row">
        <div class="Column">
            <?php echo WEBSITE_NAME ?>
            <p class="smallText">
                <a href="<?php echo $level?>/main/sitemap.php"><?php echo locale("strFooter6")?></a><br>
                <a href="<?php echo $level?>/main/keyIndex.php"><?php echo locale("strKeySearch")?></a>
            </p>
        </div>
        <div class="Column">
            <?php echo locale("strFooter7")?>
            <p class="smallText">
<?php
                $sql = "select * from project_blogs where status ='A' order by name";
                $r_intro = mysqli_query($db, $sql);
                while ($intro = mysqli_fetch_array($r_intro)) 
                {
                    echo "<a href=".$intro['url'].">".$intro['name']."</a><br>";
                }
?>
            </p>
        </div>
        <div class="Column">
            Legal
            <p class="smallText">
                <a href="#" id="open_preferences_center"><?php echo locale("strFooter4")?></a><br>
                <a href="<?php echo $level?>/includes/privacidad.php"><?php echo locale("strFooter5")?></a>
            </p>
        </div>
    </div>
    <p class="smallText">
        <?php echo WEBSITE_NAME ?> COPYRIGHT, <? echo date("Y") ?>
    </p>
</div>
