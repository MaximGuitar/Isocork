<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
	use Bitrix\Main\Loader;
	Loader::includeModule('placestart.settings');
	use Placestart\WebpackAssets;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle()?></title>

	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">

	<script>
		window.tplURL =	'<?= SITE_TEMPLATE_PATH ?>'
		window.ajaxURL = '<?= SITE_TEMPLATE_PATH ?>/ajax/all-ajax.php'
		window.ajaxModalURL = '<?= SITE_TEMPLATE_PATH ?>/ajax/ajax-modal.php'
		window.ajaxContactURL = '<?= SITE_TEMPLATE_PATH ?>/ajax/ajax-contact.php'
		window.ajaxCalcURL = '<?= SITE_TEMPLATE_PATH ?>/ajax/ajax-calc.php'
	</script>

	<?php $assets = new WebpackAssets(ABS_TPL_PATH.'/dist/manifest.json', SITE_TEMPLATE_PATH.'/'); ?>

	<link rel="stylesheet" href="<?= $assets->get('main.css') ?>">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" defer></script>
	<script src="<?= $assets->get('main.js') ?>" defer></script>

</head>
<body>
	<div id="top"></div>
	<div id="panel"><?$APPLICATION->ShowPanel()?></div>
	<header class="header">
		<div class="container header__container">
			<div class="header__burger default-burger burger" id="header-burger">
				<div class="default-burger__line burger__line"></div>
				<div class="default-burger__line burger__line burger__line--cross"></div>
				<div class="default-burger__line burger__line burger__line--cross"></div>
				<div class="default-burger__line burger__line"></div>
			</div>
			<? $phone = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"].'/includes/companyInfo/inc_phone.php'); ?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"menuHeader",
				Array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(0=>"",),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "header",
					"USE_EXT" => "N"
				)
			);?>
			<a href="/" class="header__logo">
				<svg class='header__logo-icon'>
					<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#logo'></use>
				</svg>
			</a>
			<a href="/podderzhka/#sidebar-header-1" class="header__calclink">
				Расчёт стоимости
			</a>
			<a href="tel: <?=$phone;?>" class="header__tel">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/includes/companyInfo/inc_phone.php"
					)
				);?>
			</a>
			<button class="header__btn btn btn--transparent" data-modal data-type="feedback">Заказать звонок</button>
			<a href="tel: <?=$phone;?>" class="header__mob-tel">
				<svg class='header__mob-tel-icon'>
					<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#tel'></use>
				</svg>
			</a>
		</div>
	</header>