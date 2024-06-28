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
<?
if (0 < $arResult["SECTIONS_COUNT"])
{
	?>
	<div class="project-category__grid">
		<?
			foreach ($arResult['SECTIONS'] as &$arSection)
			{?>
				<div class="project-category__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
					
					<?
						$countItems = 3;
						$moreResult = CIBlockElement::GetList (
							Array("ACTIVE_FROM" => "DESC"),
							Array("SECTION_ID" => $arSection['ID']),
							false,
							Array ("nTopCount" => 3)
						);

						while($resultItems = $moreResult->GetNext()){
							$image = ($resultItems["PREVIEW_PICTURE"]) ? $resultItems["PREVIEW_PICTURE"] : '';?>
								<div class="project-category__subitem category-item" style="background-image: url(<?=CFile::GetPath($image)?>);"></div>
							<? $countItems--;
						}

						while($countItems > 0){ ?>
							<div class="project-category__subitem category-item" style="background-image: url();"></div>
							<? $countItems--;
						}
					?>

						<a class="project-category__item-wrap category-item" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
							<h3 class="project-category__item-title"><? echo $arSection['NAME']; ?></h3>
							<div class="project-category__link btn btn--hover-white btn--p-25-54">
								<svg class='btn__arrow'>
									<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
								</svg>
								Подробнее
							</div>
						</a>
				</div>
				<?
			}
			unset($arSection);
		?>
	</div>
	<?
}
?>