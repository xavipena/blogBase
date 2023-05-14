<?php 
    // HTML menu
?>

<div class="sidebar close">
    <div class="logo-details">
      <img src="<?php echo $level?>/images/profile.png" alt="profileImg">
      <span class="logo_name"><?php echo WEBSITE_NAME?></span>
      <span class="link_name"></span>  
    </div>
    <ul class="nav-links">
    <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-home' ></i>
            <span class="link_name"><?php echo WEBSITE_NAME?></span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#"><?php echo WEBSITE_NAME?></a></li>
          <li><a href="<?php echo WEB_URL?>"><?php echo locale("strHome")?></a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-grid-alt' ></i>
            <span class="link_name"><?php echo locale("strLanguage")?></span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#"><?php echo locale("strLanguage")?></a></li>
<?php
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
            $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  			
            $CurPageURL = $_SERVER['REQUEST_URI'];  			
            // there are two languages: ca, es
            echo "<li><a href='".$level."/includes/setLang.php?pg=".$CurPageURL."&ln=es'>".locale("strCastilian")."</a></li>";
            echo "<li><a href='".$level."/includes/setLang.php?pg=".$CurPageURL."&ln=ca'>".locale("strCatalan")."</a></li>";
?>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-search' ></i>
            <span class="link_name"><?php echo locale("strSearch")?></span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#"><?php echo locale("strSearch")?></a></li>
          <li><a href='<?php echo $level ?>/main/sitemap.php'><?php echo locale("strArticles")?></a></li>
          <li><a href='<?php echo $level ?>/main/keyIndex.php'><?php echo locale("strKeySearch")?></a></li>
          <li>
            <br>
            <form id="srchForm" method="post" action="<?php echo $level?>/main/searchResults.php">
              <input type="text" value="" id="srchKey" name="srchKey" size="15">
              <input type="submit" value="<?php echo locale("strSearch")?>">
            </form>
          </li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-heart' ></i>
            <span class="link_name"><?php echo locale("strBlogs")?></span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#"><?php echo locale("strBlogs")?></a></li>
<?php
          $sql = "select * from intro_blogs where IDblog <> ".WEBCODE." and status ='A'";
          $r_intro = mysqli_query($db, $sql);
          while ($intro = mysqli_fetch_array($r_intro)) 
          {
              echo "<li><a href=".$intro['url'].">".$intro['name']."</a></li>";
          }
?>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book' ></i>
            <span class="link_name"><?php echo locale("strLegal")?></span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#"><?php echo locale("strLegal")?></a></li>
          <li><a href="#" id="open_preferences_center"><?php echo locale("strLegalCookies")?></a></li>
          <li><a href="<?php echo $level ?>/includes/privacidad.php"><?php echo locale("strLegalPolicy")?></a></li>
        </ul>
      </li>

      <div class="profile-details">
        <div class="profile-content">
          <img src="<?php echo $level ?>/images/profile.png" alt="profileImg">
        </div>
        <div class="name-job">
          <div class="profile_name">Xavi Peña</div>
          <div class="job"><?php echo WEBSITE_NAME?> (C) Xavier Peña, <?php echo date("Y")?></div>
        </div>
      </div>
    </ul>
</div>
