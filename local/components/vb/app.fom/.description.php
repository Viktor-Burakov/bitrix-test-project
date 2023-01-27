<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arComponentDescription = array(
   "NAME" => GetMessage("Форма заявки"),
   "DESCRIPTION" => GetMessage("Отправка заявок по электронной почте"),
   "PATH" => array(
      "ID" => "vb_components",
      "CHILD" => array(
         "ID" => "app.fom",
         "NAME" => "Форма заявки"
      )
   ),
   "ICON" => "/images/feedback.gif",
);
