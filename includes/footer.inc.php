<?php
	$level = "..";
	if ($pageType == "cover") $level = ".";
	if ($isArticle) {
?>
		<div class="Centered_200">
			<?php echo locale("strShare")?>
		</div>
		<div class="Centered_150">
			<div class="addthis_inline_share_toolbox"></div> 
		</div>
<?php 
	}
	if ($footerNavigation) {
	
		echo "<hr><div class='footerDiv'><div class='Row'>";
		if (!empty($goBack)) {
		
			if ($goBack)
			{
				echo "<div class='Column'>"; 
				echo "	<div class='CellCentered'><a class='linkButton' href='javascript:history.back()'>  ".locale("strBack")."  </a></div>"; 
				echo "</div>";
			}
		}
		if (!empty($isArticle)) {
		
			if ($isArticle)
			{
				$target = "";
				switch ($table) {

					case 1:
						$target = "articleList.php";
						break;

					case 2:
						$target = "fotoList.php";
						break;

					case 3: 
						$target = "watchList.php";
						break;							
				}
				echo "<div class='Column'>"; 
				echo "	<div class='CellCentered'><a class='linkButton' href='".$level."/main/".$target."'>  ".locale("strArticles")."  </a></div>"; 
				echo "</div>"; 
			}
		}
		echo "<div class='Column'>";
		echo "	<div class='CellCentered'><a class='linkButton' href='".$level."/index.php'>  ".locale("strHome")."  </a></div>"; 
		echo "</div>"; 
		echo "</div></div>";
	}
	include $level."/includes/avisolegal.inc.php";
?>
<script type="text/javascript" src="//www.freeprivacypolicy.com/public/cookie-consent/4.0.0/cookie-consent.js" charset="UTF-8"></script>
<script type="text/javascript" charset="UTF-8">
document.addEventListener('DOMContentLoaded', function () {
	cookieconsent.run({"notice_banner_type":"simple","consent_type":"express","palette":"light","language":"<?php echo $lang ?>_es","page_load_consent_levels":["strictly-necessary"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false,"website_name":"domain.com","website_privacy_policy_url":"https://domain.com"});
});
</script>

</div>
</section>
<?php
	// Go to www.addthis.com/dashboard to customize your tools 
	if ($isArticle) {
?>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<ID>"></script>
<?php 
	}
?>
	<script type="text/javascript" src="<?php echo $level?>/includes/sidebar.js"></script>
</body>
</html>