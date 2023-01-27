<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
</main>

<footer class="footer">
   <div class="container">
      <div class="footer__wrap">
         <div class="footer__row">
            <div class="footer__col">
               <div class="footer__logo">
                  <a href="/">
                     <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                           "AREA_FILE_RECURSIVE" => "Y",
                           "AREA_FILE_SHOW" => "file",
                           "EDIT_TEMPLATE" => "",
                           "PATH" => SITE_TEMPLATE_PATH . "/include/logo.php",
                        )
                     ); ?>
                  </a>
               </div>
               <div class="footer__copyright">
                  <? $APPLICATION->IncludeComponent(
                     "bitrix:main.include",
                     "",
                     array(
                        "AREA_FILE_RECURSIVE" => "Y",
                        "AREA_FILE_SHOW" => "file",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/footer-copyright.php",
                     )
                  ); ?>
               </div>
            </div>
            <? $APPLICATION->IncludeComponent(
               "bitrix:menu",
               "bottom_menu",
               array(
                  "ALLOW_MULTI_SELECT" => "N",
                  "CHILD_MENU_TYPE" => "left",
                  "DELAY" => "N",
                  "MAX_LEVEL" => "1",
                  "MENU_CACHE_GET_VARS" => array(),
                  "MENU_CACHE_TIME" => "3600",
                  "MENU_CACHE_TYPE" => "A",
                  "MENU_CACHE_USE_GROUPS" => "N",
                  "ROOT_MENU_TYPE" => "bottom",
                  "USE_EXT" => "N",
                  "COMPONENT_TEMPLATE" => "bottom_menu"
               ),
               false
            ); ?>
            <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom-social-list", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "bottomSocialList",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "bottom-social-list"
	),
	false
); ?>
         </div>
      </div>
   </div>
</footer>

</div>
</body>

</html>