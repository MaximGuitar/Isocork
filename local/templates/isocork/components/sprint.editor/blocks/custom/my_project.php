<? /** @var $block array */?>
<?
$elements = Sprint\Editor\Blocks\IblockElements::getList(
	$block,
	[]
);
use \Placestart\Utils;

$titleSection = $block['title'];
$type = $block['type'];
?>

<section class="section-projects" id="section-projects">
	<div class="container">
		<? if ($titleSection): ?>
			<h2 class="section-projects__title section-title">
				<?= $titleSection; ?>
			</h2>
		<? endif; ?>
	</div>

	<? if ($type == 'type2'): ?>
		<div class="container">
			<div class="swiper projects__list">
				<div class="swiper-wrapper">
					<? $i = 0;
					foreach ($elements as $arItem): ?>
						<?
						$arFilter = array("IBLOCK_ID" => $arItem['IBLOCK_ID'], "ID" => $arItem['ID']);
						$res = CIBlockElement::GetList(array(), $arFilter);
						if ($ob = $res->GetNextElement()) {
							;
							$arFields = $ob->GetFields();
							$arProps = $ob->GetProperties();
						}
						$img = $arFields['PREVIEW_PICTURE'];
						$text = $arFields['PREVIEW_TEXT'];
						$title = $arItem["NAME"];

						if ($i > 2)
							break; ?>

						<div class="projects__item swiper-slide" data-id="<?= $arItem['ID']; ?>" data-project>
							<div class="swiper projects__slider-mini">
								<div class="swiper-wrapper">
									<?
									$arFilter = array("IBLOCK_ID" => $arItem["IBLOCK_ID"], "ID" => $arItem["ID"]);

									$res = CIBlockElement::GetList(array(), $arFilter);

									if ($ob = $res->GetNextElement()) {
										;
										$arProps = $ob->GetProperties();
										$arFiels = $ob->GetFields();
										$preview = $arFiels['PREVIEW_PICTURE'];
										$gallery = $arProps['PROJECT_GALLERY']['VALUE'];
									}
									?>
									<div class="swiper-slide">
										<? if ($preview): ?>
											<img data-src="<?= CFile::GetPath($preview) ?>" alt="<?= $arItem["NAME"] ?>"
												class="projects__slide-img" data-lazy>
										<? else: ?>
											<img data-src="<?= SITE_TEMPLATE_PATH ?>/static/images/pug.jpg"
												alt="<?= $arItem["NAME"] ?>" class="projects__slide-img" data-lazy>
										<? endif ?>
									</div>
									<? foreach ($gallery as $photo): ?>
										<div class="swiper-slide">
											<img data-src="<?= CFile::GetPath($photo) ?>" alt="<?= $arItem["NAME"] ?>"
												class="projects__slide-img" data-lazy>
										</div>
									<? endforeach; ?>
								</div>
								<div class="projects__dots">
									<div class="slider-dots"></div>
								</div>
							</div>

							<div class="projects__content">
								<div class="projects__text-content">
									<? if ($title): ?>
										<p class="projects__item-title">
											<?= $title; ?>
										</p>
									<? endif; ?>
									<? if ($arProps["PROJECT_CITY"]["VALUE"]): ?>
										<p class="projects__item-city inter">Город:
											<?= $arProps["PROJECT_CITY"]["VALUE"]; ?>
										</p>
									<? endif; ?>
									<? if ($text): ?>
										<div class="projects__item-text">
											<?= htmlspecialcharsBack($text); ?>
										</div>
									<? endif; ?>
								</div>
								<a href="javascript:void(0);" class="projects__item-btn btn btn--transparent-dark">
									<svg class='btn__arrow'>
										<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
									</svg>
									Подробнее
								</a>
							</div>
						</div>
						<? $i++; endforeach; ?>
				</div>
				<div class="projects__arrows">
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
			</div>
			<div class="projects__btn"><a href="/primery-rabot/" class="btn btn--main">В галерею</a></div>
		</div>
	<? else: ?>
		<div class="section-projects__slider-container" id="projects-slider">
			<div class="section-projects__slider-wrap container">
				<div class="swiper section-projects__swiper-main">
					<div class="swiper-wrapper">
						<?
						$title = '';
						$type = '';
						$desc = '';
						?>
						<? foreach ($elements as $arItem): ?>
							<?
							$arFilter = array("IBLOCK_ID" => $arItem['IBLOCK_ID'], "ID" => $arItem['ID']);
							$res = CIBlockElement::GetList(array(), $arFilter);
							if ($ob = $res->GetNextElement()) {
								;
								$arFields = $ob->GetFields();
								$arProps = $ob->GetProperties();
							}
							$title = $arItem["NAME"]; ?>
							<? if ($arProps["PROJECT_HOUSE"]["VALUE"])
								$type = $arProps["PROJECT_HOUSE"]["NAME"] . ':' . $arProps["PROJECT_HOUSE"]["VALUE"]; ?>
							<? if ($arProps["PROJECT_MATERIAL"]["VALUE"])
								$desc = $arProps["PROJECT_MATERIAL"]["VALUE"]; ?>
							<div class="swiper-slide section-projects__slide" data-title="<?= $title; ?>"
								data-link="/primery-rabot/" data-type="<?= $type; ?>" data-desc="<?= $desc; ?>"
								id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="swiper section-projects__swiper-mini">
									<div class="swiper-wrapper">
										<?
										$arFilter = array("IBLOCK_ID" => $arItem["IBLOCK_ID"], "ID" => $arItem["ID"]);

										$res = CIBlockElement::GetList(array(), $arFilter);

										if ($ob = $res->GetNextElement()) {
											;
											$arProps = $ob->GetProperties();
											$arFiels = $ob->GetFields();
											$preview = $arFiels['PREVIEW_PICTURE'];
											$gallery = $arProps['PROJECT_GALLERY']['VALUE'];
										}
										?>
										<div class="swiper-slide">
											<? if ($preview): ?>
												<?
												$arImg1 = Utils::resizeImage(($preview), 1090, 600, 'exact', 95);
												?>
												<img data-src="<?= $arImg1['src']; ?>" alt="<?= $arItem["NAME"] ?>"
													class="section-projects__slide-img" data-lazy>
											<? else: ?>
												<img data-src="<?= SITE_TEMPLATE_PATH ?>/static/images/pug.jpg"
													alt="<?= $arItem["NAME"] ?>" class="section-projects__slide-img" data-lazy>
											<? endif ?>
										</div>
										<? foreach ($gallery as $photo): ?>
											<?
											$arImg = Utils::resizeImage(($photo), 1090, 600, 'exact', 95);
											?>
											<div class="swiper-slide">
												<img data-src="<?= $arImg['src']; ?>" alt="<?= $arItem["NAME"] ?>"
													class="section-projects__slide-img" data-lazy>
											</div>
										<? endforeach; ?>
									</div>
									<div class="section-projects__dots">
										<div class="slider-dots"></div>
									</div>
								</div>
							</div>
						<? endforeach; ?>
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
					<? if ($title): ?>
						<p class="section-projects__info-title">
							<?= $title; ?>
						</p>
					<? endif; ?>
					<? if ($type): ?>
						<p class="section-projects__info-type inter">
							<?= $type; ?>
						</p>
					<? endif; ?>
					<? if ($desc): ?>
						<p class="section-projects__info-desc inter">использована: <span>
								<?= $desc; ?>
							</span></p>
					<? endif; ?>
					<a href="/primery-rabot/" class="section-projects__info-btn btn btn--transparent btn--inline">
						<svg class='btn__arrow'>
							<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
						</svg>
						В галерею
					</a>
				</div>
			</div>
		</div>
	<? endif; ?>
</section>