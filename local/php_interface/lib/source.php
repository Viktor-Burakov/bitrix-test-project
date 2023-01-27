<?

/* 
Создать скрипт переноса / обновления элементов из hiload блока в инфоблок.


1) hiload-block - Source с полями:
- код - строка
- активность - строка (Y/N)
- цена - число
- файл - свойство типа файл
- город - свойство типа Список.

2) Инфоблок с аналогичными свойствами перечисленными в п.1.
- дополнительно еще одно свойство (Коды) - типа Список.
3) Написать скрипт (запускаемый из php-строки в админке Битрикс) со следующим
функционалом:
-Из hiload блока получаем ВСЕ записи у которых Активность установлена в Y
-Перебираем элементы полученные из hiload и сверяем с элементами инфоблока по
свойству Код.
Если свойство Код одинаково - обновляем элемент всеми значениями. Если свойство
Код не найдено - добавляем новый элемент.
- В свойство (Коды) - записываем код элемента (добавляя его в список или устанавливая
если такое значение там присутствует).
- Предусмотреть и выводить возможные ошибки при выборе элементов, обновлении
элементов, записи значений.
- Предусмотреть вывод информационных сообщений при обработке каждой строки


Скрипт для запуска из коммандной строки:

echo '<pre>';
$elementsHL = new Source();
print_r($elementsHL->exportElements());
echo '</pre>';

 */

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;

Loader::includeModule('iblock');

class Source
{
   protected array $elementsHL = [];
   protected static int $idHL = 1;
   protected static int $idIB = 4;
   protected static int $idPropCode = 10;
   protected static array $elementsIB = [];
   protected static array $propCodes = [];
   protected static array $messages = [];

   public function __construct()
   {
      Loader::includeModule('highloadblock');
      $sourceHL = HL\HighloadBlockTable::getById(self::$idHL)->fetch();

      $entity = HL\HighloadBlockTable::compileEntity($sourceHL);
      $entityDataClass = $entity->getDataClass();

      $rsData = $entityDataClass::getList(array(
         'select' => array('*'),
         'order' => array('ID' => 'ASC'),
         'filter' => array('UF_ACTIVE' => 'Y')
      ));

      while ($arData = $rsData->Fetch()) {
         $this->elementsHL[] = $arData;
      }
   }

   public static function getElementsIB()
   {
      $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'DATE_ACTIVE_FROM');
      $arFilter = array('IBLOCK_ID' => self::$idIB);
      $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
      $i = 0;
      while ($ob = $res->GetNextElement()) {
         $i++;
         $arFields = $ob->GetFields();
         $arProps = $ob->GetProperties();

         if (!empty($arProps['CODE']['VALUE'])) {
            self::$elementsIB[$arProps['CODE']['VALUE']]['ID'] = $arFields['ID'];
            self::$elementsIB[$arProps['CODE']['VALUE']]['NAME'] = $arFields['NAME'];

            foreach ($arProps as $propName => $props) {
               self::$elementsIB[$arProps['CODE']['VALUE']][$propName] = $props['VALUE'];
            }
         }
      }
      return 'Найдено: ' . count(self::$elementsIB) . ' элементов инфоблока с заполненым свойством CODE из ' . $i . ' <br>';
   }


   public static function getCodeListIB()
   {
      $propertyEnums = CIBlockPropertyEnum::GetList(array('ID' => 'ASC'), array('IBLOCK_ID' => self::$idIB, 'PROPERTY_ID' => self::$idPropCode));

      while ($enumFields = $propertyEnums->GetNext()) {
         self::$propCodes[$enumFields['VALUE']] = $enumFields['ID'];
      }
      return 'Найдено: ' . count(self::$propCodes) . ' полей свойства CODE инфоблока<br>';
   }

   public static function addCodeProperty($code)
   {
      $propertyEnum = new CIBlockPropertyEnum;
      if ($PropID = $propertyEnum->Add(array('PROPERTY_ID' => self::$idPropCode, 'VALUE' => $code))) {
         self::$propCodes[$code] = $PropID;
         return 'Добавлено свойство CODE: ' . $code . ' - ID: ' . $PropID . '<br>';
      } else {
         return 'Ошибка свойство CODE "' . $code . '" не добавлено<br>';
      }
   }

   public static function addElementIB($addData)
   {

      $el = new CIBlockElement();
      $props = array();
      $props[self::$idPropCode] =  self::$propCodes[$addData['UF_CODE']];
      $props[11] = $addData['UF_ACTIVE'];
      $props[12] = $addData['UF_PRICE'];
      $props[13] = $addData['UF_FILE'];
      $props[14] = $addData['UF_CITY'];

      if (!empty($addData['UF_CODE'])) {
         $name = $addData['UF_CODE'];
      } else {
         $name = $addData['NAME'];
      }

      $arLoadProductArray = array(
         'IBLOCK_ID'      => self::$idIB,
         'ACTIVE' => 'Y',
         'NAME'           => $name,
         'PROPERTY_VALUES' => $props,
      );

      if ($element = $el->Add($arLoadProductArray)) {
         return 'Добавлен элемент "' . $name . '": ' .  $element . '<br>';
      } else {
         return 'Ошибка при добавлении элемента "' . $name . '": ' . $element . ' ->' . $el->LAST_ERROR . '<br>';
      }
   }

   public static function updateElementIB($id, $addData)
   {
      $el = new CIBlockElement;

      $props = array();
      $props[self::$idPropCode] =  self::$propCodes[$addData['UF_CODE']];
      $props[11] = $addData['UF_ACTIVE'];
      $props[12] = $addData['UF_PRICE'];
      $props[13] = $addData['UF_FILE'];
      $props[14] = $addData['UF_CITY'];

      $arLoadProductArray = array(
         'NAME'           => $addData['UF_CODE'],
         'ACTIVE'         => 'Y',
         'PROPERTY_VALUES' => $props,
      );
      if ($el->Update($id, $arLoadProductArray)) {
         return 'Обновлен элемент "' . $addData['UF_CODE'] . '": ' .  $id . '<br>';
      } else {
         return 'Ошибка при обновлении элемента "' . $addData['UF_CODE'] . '": ' . $id . ' ->' . $el->LAST_ERROR . '<br>';
      }
   }

   public function exportElements()
   {
      self::$messages['search'][] = 'Найдено: ' . count($this->elementsHL) . ' активных элементов HL блока<br>';
      self::$messages['search'][] =  self::getCodeListIB();
      self::$messages['search'][] =  self::getElementsIB();

      foreach ($this->elementsHL as $elemHL) {
         if (array_key_exists($elemHL['UF_CODE'], self::$elementsIB)) {
            self::$messages['update'][] =  self::updateElementIB(self::$elementsIB[$elemHL['UF_CODE']]['ID'], $elemHL);
         } else {
            if (!array_key_exists($elemHL['UF_CODE'], self::$propCodes)) {
               self::$messages['add']['prop'][] =  self::addCodeProperty($elemHL['UF_CODE']);
            }
            self::$messages['add']['elem'][] =  self::addElementIB($elemHL);
         }
      }
      return self::$messages;
   }
}
