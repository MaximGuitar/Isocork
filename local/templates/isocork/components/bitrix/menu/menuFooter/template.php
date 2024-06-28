<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult as $arItem):?>
	<?if ($arItem["IS_PARENT"] || $arItem["PARAMS"]["class"] ===  "hidden"):?>
	<?else: ?>
		<?if($arItem["DEPTH_LEVEL"] !== 1 && $arItem["CHAIN"][0] === "Продукты"): ?>
			<a href="<?=$arItem["LINK"]?>" class="footer__products-link"><?=$arItem["TEXT"]?></a>
		<?else: ?>
			<a href="<?=$arItem["LINK"]?>" class="footer__general-link"><?=$arItem["TEXT"]?></a>
		<?endif?>
	<?endif?>
<?endforeach?>