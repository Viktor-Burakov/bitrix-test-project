<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();



if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "submit") {
   $arResult["ERROR_MESSAGE"] = array();
   if (check_bitrix_sessid()) {

      if (mb_strlen($_POST["name"]) <= 1) {
         $arResult["ERROR_MESSAGE"][] = "Заполните название!";
      }

      if ($arParams["EMAIL_TO"] == '')
         $arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");

      if (empty($arResult["ERROR_MESSAGE"])) {
         $files = array();

         foreach ($_FILES['files'] as $field => $fieldArr) {
            foreach ($fieldArr as $i => $value) {
               if (!empty($_FILES['files']['name'][$i])) {
                  $files[$i][$field] = $value;
               }
            }
         }

         foreach ($_POST["app_item"] as $app_item) {
            $app_items .= "Расходы: " . $app_item["expenses"] . ", Сумма: " . $app_item["price"] . " руб., Назначение: " . $app_item["purpose"] . ", Заметка: " . $app_item["note"] . ". \n";
         }

         $filesId = false;
         if ($files) {
            foreach ($files as $file) {
               $filesId[] = \CFile::SaveFile($file, "mailatt");
               $fieldFiles .= $file['name'] . ", ";
            }
            $fieldFiles = chop($fieldFiles, ', ');
         }

         $arFields = array(
            "EMAIL_TO" => $arParams["EMAIL_TO"],
            "NAME" => $_POST["name"],
            "CATEGORY" => $_POST["category"],
            "TYPE" => $_POST["appType"],
            "ITEMS" => $app_items,
            "COMMENT" => $_POST["comment"],
            "FILES" => $fieldFiles,
         );

         \Bitrix\Main\Mail\Event::send([
            "EVENT_NAME" => "APP_FORM",
            "LID" => "s1",
            "C_FIELDS" => $arFields,
            "FILE" => array($filesId),
         ]);

         if ($filesId) {
            foreach ($filesId as $file) {
               CFile::Delete($file);
            }
         }

         $arResult["OK_MESSAGE"] = "Заявка отправлена";
      }
   }
}


$this->IncludeComponentTemplate();
