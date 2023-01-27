<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("test");

?><? $APPLICATION->IncludeComponent(
      "vb:app.fom",
      "",
      array(
         "EMAIL_TO" => "burakov.tmn@gmail.com",
      )
   ); ?> <?











      echo '<br><br>';



















      // require($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/source.php");

      $addDataArr = array(
         [
            'NAME' => 'apple',
            'UF_ACTIVE' => 'Y',
            'UF_PRICE' => '64',
            'UF_CITY' => '1',
            'UF_FILE' => null,
         ],
         [
            'NAME' => 'orange',
            'UF_ACTIVE' => 'Y',
            'UF_PRICE' => '76',
            'UF_CITY' => '2',
            'UF_FILE' => null,
         ],
         [
            'NAME' => 'tomato',
            'UF_ACTIVE' => 'Y',
            'UF_PRICE' => '141',
            'UF_CITY' => '3',
            'UF_FILE' => null,
         ],
         [
            'NAME' => 'cucumber',
            'UF_ACTIVE' => 'Y',
            'UF_PRICE' => '112',
            'UF_CITY' => '2',
            'UF_FILE' => null,
         ],
         [
            'NAME' => 'pineapple',
            'UF_ACTIVE' => 'Y',
            'UF_PRICE' => '32',
            'UF_CITY' => '4',
            'UF_FILE' => null,
         ],
         [
            'NAME' => 'banana',
            'UF_ACTIVE' => 'N',
            'UF_PRICE' => '21',
            'UF_CITY' => '1',
            'UF_FILE' => null,
         ],
         [
            'NAME' => 'grape',
            'UF_ACTIVE' => 'Y',
            'UF_PRICE' => '99',
            'UF_CITY' => '4',
            'UF_FILE' => null,
         ],
      );


      /* foreach ($addDataArr as $value) {
   echo Source::addElementIB($value);
} */









      ?><br>
<br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>