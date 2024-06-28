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
<div class="section-about__goals container">
	<h2 class="section-about__goals-title"><?=$arParams["PAGER_TITLE"];?></h2>
	<div class="section-about__goals-grid">
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<div class="section-about__goal"  data-modal="" data-idiblock="<?=$arItem["IBLOCK_ID"]?>" data-idelement="<?=$arItem["ID"]?>" data-type="infoblock">
				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
					<p class="section-about__goal-title"><?echo $arItem["NAME"]?></p>
				<?endif;?>
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<p class="section-about__goal-text inter"><?=htmlspecialcharsBack($arItem["PREVIEW_TEXT"]);?></p>
				<?endif;?>
			</div>
		<?endforeach;?>
	</div>
</div>