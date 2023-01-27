<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/concerts/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/concerts/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/artists/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/artists/index.php',
    'SORT' => 100,
  ),
);
