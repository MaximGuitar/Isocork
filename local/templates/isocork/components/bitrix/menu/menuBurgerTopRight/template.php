<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<?foreach($arResult as $arItem):?>
	<a href="<?=$arItem["LINK"]?>" class="menu-header lora"><?=$arItem["TEXT"]?></a>
<?endforeach?>

<div class="main-menu__right-menu-mob">
	<? $APPLICATION->IncludeComponent(
		"bitrix:menu",
		"menuBurgerTop",
		Array(
			"ALLOW_MULTI_SELECT" => "N",
			"CHILD_MENU_TYPE" => "",
			"DELAY" => "N",
			"MAX_LEVEL" => "1",
			"MENU_CACHE_GET_VARS" => array(""),
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_TYPE" => "N",
			"MENU_CACHE_USE_GROUPS" => "Y",
			"ROOT_MENU_TYPE" => "mainFooter",
			"USE_EXT" => "N"
		)
	); ?>
</div>

<?endif?>