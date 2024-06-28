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
<div class="main-screen__slider-container">
	<div class="keen-slider main-screen__slider">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="keen-slider__slide main-screen__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<? if($arItem["DISPLAY_PROPERTIES"]["SLIDE_IMAGE"]["FILE_VALUE"]["SRC"]): ?>
				<img src="<?=$arItem["DISPLAY_PROPERTIES"]["SLIDE_IMAGE"]["FILE_VALUE"]["SRC"];?>" alt="" class="main-screen__slide-media">
			<?else:?>
				<video src="<?=$arItem["DISPLAY_PROPERTIES"]["SLIDE_VIDEO"]["FILE_VALUE"]["SRC"];?>" autoplay loop muted class="main-screen__slide-media"></video>
			<?endif;?>
		</div>
	<?endforeach;?>
	</div>
</div>
