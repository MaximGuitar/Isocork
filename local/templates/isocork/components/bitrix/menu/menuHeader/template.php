<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="left-menu">



</ul>

<nav class="header__nav">
	<? foreach($arResult as $arItem):
		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
			continue; ?>
		<a href="<?=$arItem["LINK"]?>" class="header__nav-link "><?=$arItem["TEXT"]?></a>
	<?endforeach?>
</nav>

<?endif?>