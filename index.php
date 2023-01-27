<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "bxtest: Marshall");
$APPLICATION->SetPageProperty("keywords", "keywords");
$APPLICATION->SetPageProperty("description", "description");
$APPLICATION->SetTitle("MAKING MUSIC <br> WITH MARSHALL");
?><section class="welcome">
   <div class="container">
      <h1><?= $APPLICATION->GetTitle() ?></h1>
      <div class="welcome__row">
         <div class="welcome__text">
            <? $APPLICATION->IncludeComponent(
               "bitrix:main.include",
               "",
               array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => "/main_page/inc_text.php"
               )
            ); ?> <? $APPLICATION->IncludeComponent(
                     "bitrix:main.include",
                     "",
                     array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/main_page/inc_link.php"
                     ),
                     false,
                     array(
                        'ACTIVE_COMPONENT' => 'Y'
                     )
                  ); ?>
         </div>
         <div class="welcome__img">
            <? $APPLICATION->IncludeComponent(
               "bitrix:main.include",
               "",
               array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => "/main_page/inc_img.php"
               )
            ); ?>
         </div>
      </div>
      <a href="#" class="arrow-down"><img alt="Down" src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-down.svg"></a>
   </div>
</section>
<? $APPLICATION->IncludeComponent(
   "marshall:main.feedback",
   "subscriptions",
   array(
      "COMPONENT_TEMPLATE" => "subscriptions",
      "EMAIL_TO" => "burakov.tmn@gmail.com",
      "EVENT_MESSAGE_ID" => array(),
      "OK_TEXT" => "Thank you. You subscribed!",
      "REQUIRED_FIELDS" => array(0 => "EMAIL",),
      "USE_CAPTCHA" => "N"
   )
); ?> <br>
<br>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>