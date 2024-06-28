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

<?php if (count($arResult["ITEMS"]) > 0 ): ?>
	<section class="section-projects">
		<div class="container">
			<h2 class="section-projects__title section-title"><?=$arParams["PAGER_TITLE"];?></h2>
		</div>
		<div class="section-projects__slider-container" id="projects-slider">
			<div class="section-projects__slider-wrap container">
				<div class="swiper section-projects__swiper-main">
					<div class="swiper-wrapper">
						<?
							$title = '';
							$type = '';
							$desc = '';
						?>
						<?foreach($arResult["ITEMS"] as $arItem):?>
							<? 
							$arFilter = Array("IBLOCK_ID"=>$arItem['IBLOCK_ID'], "ID"=>$arItem['ID']);
							$res = CIBlockElement::GetList([], $arFilter);
							if ($ob = $res->GetNextElement()){;
								$arFields = $ob->GetFields();
								$arProps = $ob->GetProperties();
								$gallery = $arProps['PROJECT_GALLERY']['VALUE'];
							}    
							$title=$arItem["NAME"]; ?>
							<?if($arProps["PROJECT_HOUSE"]["VALUE"]) 
								$type=$arProps["PROJECT_HOUSE"]["NAME"] . ':' . $arProps["PROJECT_HOUSE"]["VALUE"]; ?>
							<?if($arProps["PROJECT_MATERIAL"]["VALUE"]) 
								$desc='использована:'.$arProps["PROJECT_MATERIAL"]["VALUE"];?>
							<div
								class="swiper-slide section-projects__slide"
								data-title="<?=$title;?>"
								data-link="/primery-rabot/"
								data-type="<?=$type;?>"
								data-desc="<?=$desc;?>"
								id="<?=$this->GetEditAreaId($arItem['ID']);?>"
							>
								<div class="swiper section-projects__swiper-mini">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
												<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" class="section-projects__slide-img">
											<?else: ?>
												<img src="<?= SITE_TEMPLATE_PATH ?>/static/images/project1.jpg" alt="<?=$arItem["NAME"]?>" class="section-projects__slide-img">
											<?endif?>
										</div>
										<?foreach ($gallery as $photo):?>
											<div class="swiper-slide">
												<img src="<?=CFile::GetPath($photo)?>" alt="<?=$arItem["NAME"]?>" class="section-projects__slide-img">
											</div>
										<?endforeach;?>
									</div>
									<div class="section-projects__dots"><div class="slider-dots"></div></div>
								</div>
							</div>
						<?endforeach;?>
					</div>
				</div>
			</div>
			<div class="section-projects__wrap">
				<div class="section-projects__arrows">
					<div class="slider-arrow slider-arrow--left">
						<svg class="slider-arrow__icon">
							<use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#longest-arrow-to-right"></use>
						</svg>
					</div>
					<div class="slider-arrow slider-arrow--right">
						<svg class="slider-arrow__icon">
							<use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#longest-arrow-to-right"></use>
						</svg>
					</div>
				</div>
				<div class="section-projects__info" data-info-container>
					<?if($title): ?>
						<p class="section-projects__info-title"><?=$title;?></p>
					<?endif;?>
					<?if($type): ?>
						<p class="section-projects__info-type inter"><?=$type;?></p>
					<?endif;?>
					<?if($desc): ?>
						<p class="section-projects__info-desc inter"> <span><?=$desc;?></span></p>
					<?endif;?>
					<a href="/primery-rabot/" class="section-projects__info-btn btn btn--transparent btn--inline">
						<svg class='btn__arrow'>
							<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
						</svg>
						В галерею
					</a>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>