<? /** @var $block array */ 

use \Placestart\Utils;
?><?
$elements = Sprint\Editor\Blocks\IblockElements::getList(
    $block, []
);

$titleSection = $block['title'];
$type = $block['type'];
?>

<section class="section-projects" id="section-projects">
	<div class="container">
        <?if($titleSection):?>
            <h2 class="section-projects__title section-title"><?=$titleSection;?></h2>
        <?endif;?>
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
						<?foreach($elements as $arItem):?>
							<? 
							$arFilter = Array("IBLOCK_ID"=>$arItem['IBLOCK_ID'], "ID"=>$arItem['ID']);
							$res = CIBlockElement::GetList(Array(), $arFilter);
							if ($ob = $res->GetNextElement()){;
								$arFields = $ob->GetFields();
								$arProps = $ob->GetProperties();
							}    
							$title=$arItem["NAME"]; ?>
							<?if($arProps["PROJECT_HOUSE"]["VALUE"]) 
								$type=$arProps["PROJECT_HOUSE"]["NAME"] . ':' . $arProps["PROJECT_HOUSE"]["VALUE"]; ?>
							<?if($arProps["PROJECT_MATERIAL"]["VALUE"]) 
								$desc=$arProps["PROJECT_MATERIAL"]["VALUE"];?>
							<div
								class="swiper-slide section-projects__slide"
								data-title="<?=$title;?>"
								data-link="/primery-rabot/"
								data-type="<?=$type;?>"
								data-desc="<?=$desc;?>"
								id="<?=$this->GetEditAreaId($arItem['ID']);?>"
							>
							<?
											$arFilter = Array("IBLOCK_ID"=>$arItem["IBLOCK_ID"], "ID"=>$arItem["ID"]);
											
											$res = CIBlockElement::GetList(Array(), $arFilter);
											
											if ($ob = $res->GetNextElement()){;
												$arProps = $ob->GetProperties();
												$arFiels = $ob->GetFields();
												$preview = $arFiels['PREVIEW_PICTURE'];
												$gallery = $arProps['PROJECT_GALLERY']['VALUE'];
											}
										?>
								<div class="section-do-posle__grid" >
									<div class="section-do-posle__item ">
										<div class="section-do-posle__item-wrap">
											<?  
												$arImg1 = Utils::resizeImage($gallery[0], 600, 1090,'proportional',90);
											?>
											<?  
												$arImg2= Utils::resizeImage($gallery[1], 600, 1090,'proportional',90);
											?>    
											<?if($gallery[0]):?>
												<div class="section-do-posle__item-before">
													<img class="section-do-posle__item-image" data-lazy data-src="	<?=$arImg1['src'];?>" alt="">
												</div>
											<?endif;?>
											<?if($gallery[1]):?>
												<div class="section-do-posle__item-after">
													<img class="section-do-posle__item-image" data-lazy data-src="<?=$arImg2['src'];?>" alt="">
												</div>
											<?endif;?>
										
											<div class="section-do-posle__item-change">
												<div class="section-do-posle__item-change-btn">
													<svg class='change-arr change-arr--left'>
														<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arr-right'></use>
													</svg>
													<svg class='change-arr change-arr--right'>
														<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arr-right'></use>
													</svg>
												</div>
											</div>
										</div>
										<?if($arItem['desc']):?>
											<p class="section-do-posle__item-title inter"><?=$arItem['desc'];?></p>
										<?endif;?>
									</div>
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
						<p class="section-projects__info-desc inter">использована: <span><?=$desc;?></span></p>
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