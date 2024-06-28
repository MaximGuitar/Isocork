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
<div id="products-slider">
	<div class="section-products__grid keen-slider">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="keen-slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="product">
					<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" class="product__bg bg">
					<?endif;?>
					<div class="product__overlay">
						<p class="product__overlay-title product__title"><?=$arItem["NAME"]?></p>
						<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
							<p class="product__overlay-text inter"><?=$arItem["PREVIEW_TEXT"];?></p>
						<?endif;?>
						<?if($arItem["DISPLAY_PROPERTIES"]["PRODUCT_THUMBNAIL"]["FILE_VALUE"]["SRC"]): ?>
							<img src="<?=$arItem["DISPLAY_PROPERTIES"]["PRODUCT_THUMBNAIL"]["FILE_VALUE"]["SRC"];?>" class="product__pic" data-scale-img>
						<?endif;?>
					</div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="product__title product__main-title link-cover"><?=$arItem["NAME"]?></a>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="product__btn btn">
						<svg class='btn__arrow'>
							<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
						</svg>
						Подробнее
					</a>
				</div>
			</div>
		<?endforeach;?>
	</div>
	<div class="section-products__controls-container"></div>
</div>