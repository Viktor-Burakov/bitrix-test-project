<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<?
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.min.css");
	Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">');
	$APPLICATION->ShowHead();
	?>
	<title><? $APPLICATION->ShowTitle() ?></title>
</head>

<body>
	<? $APPLICATION->ShowPanel() ?>
	<div class="wrapper">
		<header class="header">
			<div class="container">
				<div class="header__row">
					<div class="header__logo">
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
					<? $APPLICATION->IncludeComponent(
						"bitrix:menu",
						"top_menu",
						array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_USE_GROUPS" => "N",
							"ROOT_MENU_TYPE" => "top",
							"USE_EXT" => "N",
							"COMPONENT_TEMPLATE" => "top_menu"
						),
						false
					); ?>

				</div>
			</div>
		</header>
		<main class="main">
			<? $APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"breadcrumb",
				array(
					"PATH" => "",
					"SITE_ID" => "s1",
					"START_FROM" => "0"
				)
			); ?>