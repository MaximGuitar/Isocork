<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<section class="section-presentation">
	<div class="section-presentation__container">
		<?if($arResult["DISPLAY_PROPERTIES"]["PRESENT_TITLE"]["VALUE"])?>
			<h2 class="section-presentation__title "><?=$arResult["DISPLAY_PROPERTIES"]["PRESENT_TITLE"]["VALUE"];?></h2>
		<?if($arResult["DISPLAY_PROPERTIES"]["PRESENT_TEXT"]["VALUE"]["TEXT"])?>
			<p class="section-presentation__text"><?=$arResult["DISPLAY_PROPERTIES"]["PRESENT_TEXT"]["VALUE"]["TEXT"];?></p>
		<?if($arResult["DISPLAY_PROPERTIES"]["PRESENT_LINK"]["VALUE"]):?>
			<div class="section-presentation__link-container">
				<a href="<?=$arResult["DISPLAY_PROPERTIES"]["PRESENT_LINK"]["VALUE"];?>" class="section-presentation__link">УЗНАТЬ БОЛЬШЕ</a>
			</div>
		<?endif;?>
		<?if($arResult["DISPLAY_PROPERTIES"]["PRESENT_IMAGE"]["FILE_VALUE"]["SRC"]) ?>
			<img src="<?=$arResult["DISPLAY_PROPERTIES"]["PRESENT_IMAGE"]["FILE_VALUE"]["SRC"];?>" alt="" class="section-presentation__img">
	</div>
	<?if($arResult["DISPLAY_PROPERTIES"]["PRESENT_WORD"]["VALUE"])?>
		<p class="section-presentation__large-title "><?=$arResult["DISPLAY_PROPERTIES"]["PRESENT_WORD"]["VALUE"];?></p> 
</section>