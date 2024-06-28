<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="left-menu">



</ul>

<nav class="main-menu__footer-nav">
	<? foreach($arResult as $arItem):
		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
			continue; ?>
		<a href="<?=$arItem["LINK"]?>" class="menu-link lora "><?=$arItem["TEXT"]?></a>
	<?endforeach?>
</nav>
<?endif?>