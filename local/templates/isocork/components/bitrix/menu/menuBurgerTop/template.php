<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?
foreach($arResult as $arItem):?>
	<?if ($arItem["IS_PARENT"] || $arItem["PARAMS"]["class"] ===  "menu-header"):?>
		<a href="<?=$arItem["LINK"]?>" class="menu-header lora"><?=$arItem["TEXT"]?></a>
	<?else:?>
		<a href="<?=$arItem["LINK"]?>" class="menu-link lora"><?=$arItem["TEXT"]?></a>
	<?endif?>
<?endforeach?>

<?endif?>