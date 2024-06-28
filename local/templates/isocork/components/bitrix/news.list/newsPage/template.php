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

if(array_key_exists("IS_AJAX", $_REQUEST) && $_REQUEST["IS_AJAX"] == "Y")
{
    	$APPLICATION->RestartBuffer();
}
?>
<div class="page page-news">
	<section class="section-news">
		<div class="container">
			<div id="breadcrumbs">
				<?
					$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"template.php",  
						Array(
							"COMPONENT_TEMPLATE" => "template.php",
							"PATH" => "",
							"SITE_ID" => "s1",
							"START_FROM" => "0"
						)
					  );
				?>
			</div>
			<h1 class="page-product__title page-title"><?=$arParams["PAGER_TITLE"];?></h1>
			<div class="section-news__grid loadmore_wrap">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<div class="keen-slider__slide loadmore_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="post-card">
							<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
								<div class="post-card__img-wrap">
									<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="post-card__img">
								</div>
							<?else: ?>
								<div class="post-card__img-wrap">
									<img src="<?= SITE_TEMPLATE_PATH ?>/static/images/pug.jpg" alt="" class="post-card__img">
								</div>
							<?endif;?>
							<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
								<p class="post-card__date inter"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></p>
							<?endif?>
							<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
								<p class="post-card__title">
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="link-cover"><?=$arItem["NAME"]?></a>
								</p>
							<?endif;?>
							<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
								<p class="post-card__desc inter"><?=htmlspecialcharsBack($arItem["PREVIEW_TEXT"]);?></p>
							<?endif;?>
						</div>
					</div>
				<?endforeach;?>
			</div>
			<?=$arResult["NAV_STRING"]?>
		</div>
	</section>
</div>
<?if(array_key_exists("IS_AJAX", $_REQUEST) && $_REQUEST["IS_AJAX"] == "Y")
{
    die();
}?>