<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addString('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">');
Asset::getInstance()->addString('<script src="https://kit.fontawesome.com/3cab86b5ee.js" crossorigin="anonymous"></script>');

CJSCore::Init(array("jquery"));
?>

<div class="container">

   <? if (!empty($arResult["ERROR_MESSAGE"])) {
      foreach ($arResult["ERROR_MESSAGE"] as $error) {
   ?>
         <div class="alert alert-warning text-center" role="alert">
            <?= $error ?>
         </div>
      <?
      }
   }
   if ($arResult["OK_MESSAGE"] <> '') {
      ?>
      <div class="alert alert-success text-center" role="alert">
         <?= $arResult["OK_MESSAGE"] ?>
      </div>
   <? } ?>


   <form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="g-3 needs-validation" enctype="multipart/form-data" novalidate>
      <?= bitrix_sessid_post() ?>

      <div class="row mb-3">
         <div class="col-2 d-flex align-items-center">
            <label for="name" class="form-label">Название<span class="text-danger">*</span></label>
         </div>
         <div class="col-4">
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback">
               Введите название.
            </div>
         </div>
      </div>

      <div class="row mb-3">
         <div class="col-2 d-flex align-items-center">
            <label for="category" class="form-label">Категория</label>
         </div>
         <div class="col-4">
            <select name="category" id="category" class="form-select">
               <option selected>Выберите из списка</option>
               <option value="1">Один</option>
               <option value="2">Два</option>
               <option value="3">Три</option>
            </select>
         </div>
      </div>

      <div class="row mb-3">
         <div class="col-2 d-flex align-items-center">
            <label for="appType" class="form-label">Вид заявки</label>
         </div>
         <div class="col-4">
            <div class="form-check">
               <input class="form-check-input" type="radio" name="appType" id="appType_1" value="forced" checked>
               <label class="form-check-label" for="appType_1">
                  Срочная командировка
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" name="appType" value="planned" id="appType_2">
               <label class="form-check-label" for="appType_2">
                  Командировка по графику
               </label>
            </div>
         </div>
      </div>

      <div class="row mb-3">
         <div class=" col-2 d-flex align-items-center">
            Состав заявки
         </div>
         <div class="col-10 app-rows">
            <div class="row app-item mb-3" id="app-item_0">
               <div class="col">
                  <label for="expenses_0" class="form-label">Расходы</label>
                  <select name="app_item[0][expenses]" id="expenses_0" class="form-select">
                     <option value="" selected>Выбрать...</option>
                     <option value="1">Один</option>
                     <option value="2">Два</option>
                     <option value="3">Три</option>
                  </select>
               </div>
               <div class="col">
                  <label for="price_0" class="form-label">Сумма</label>
                  <input type="text" class="form-control" id="price_0" name="app_item[0][price]">
               </div>
               <div class="col">
                  <label for="purpose_0" class="form-label">Назначение</label>
                  <input type="text" class="form-control" id="purpose_0" name="app_item[0][purpose]">
               </div>
               <div class="col">
                  <label for="note_0" class="form-label">Заметки</label>
                  <input type="text" class="form-control" id="note_0" name="app_item[0][note]">
               </div>
               <div class="col-auto d-flex align-items-end">
                  <div class="position-relative">
                     <button type="button" class="btn btn-dark btn-field btn-plus"></button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mb-3">
         <div class="col-2 d-flex align-items-center">
            <label for="files" class="form-label">Файлы</label>
         </div>
         <div class="col-4">
            <input class="form-control" type="file" id="files" name="files[]" multiple>
         </div>
      </div>

      <div class="row mb-3">
         <div class="col-2 d-flex align-items-center">
            <label for="comment" class="form-label">Комментарий</label>
         </div>
         <div class="col-4">
            <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
         </div>
      </div>

      <div class="col-12">
         <button class="btn btn-primary" type="submit" name="submit" value="submit">Отправить форму</button>
      </div>


   </form>
</div>