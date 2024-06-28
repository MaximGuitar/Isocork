<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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
$APPLICATION->SetTitle($arResult["SECTION"]["PATH"][0]["NAME"]);
ob_start();
if (array_key_exists("IS_AJAX", $_REQUEST) && $_REQUEST["IS_AJAX"] == "Y") {
	$APPLICATION->RestartBuffer();
}
?>
<div class="page">
	<div class="container">

		<h1 class="page-title align-center m-90">
			<?= $arResult["SECTION"]["PATH"][0]["NAME"]; ?>
		</h1>
		<!-- <div id="breadcrumbs">#INNER_BLOCK#</div>-->

		<? $APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"template.php",
			array(
				"COMPONENT_TEMPLATE" => "template.php",
				"PATH" => "",
				"SITE_ID" => "s1",
				"START_FROM" => "0"
			)
		); ?>
		<div class="project-list__wrap">
			<div class="project-list loadmore_wrap">
				<? foreach ($arResult["ITEMS"] as $arItem): ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="project-list__item loadmore_item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
						data-id="<?= $arItem['ID']; ?>" data-project>
						<div class="project-item__image-wrap">
							<div class="project-item__image">
								<? $image = $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . "/static/images/pug.jpg"; ?>
								<img src="<?= $image; ?>" alt="<?= $arItem["NAME"] ?>">
							</div>
							<div class="project-item__link">
								<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="project-item__btn btn btn--transparent">
									<svg class='btn__arrow'>
										<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
									</svg>
									Подробнее
								</a>
							</div>
						</div>

						<p class="project-item__title inter">
							<?= $arItem["NAME"] ?>
						</p>
						<? if ($arItem["PROPERTIES"]["PROJECT_SQUARE"]["VALUE"]): ?>
							<p class="project-item__square inter">
								<?= $arItem["PROPERTIES"]["PROJECT_SQUARE"]["NAME"]; ?>:
								<?= $arItem["PROPERTIES"]["PROJECT_SQUARE"]["VALUE"] ?> м2
							</p>
						<? endif; ?>
						<? if ($arItem["PROPERTIES"]["PROJECT_MOULDINGS"]["VALUE"]): ?>
							<p class="project-item__square inter">
								<?= $arItem["PROPERTIES"]["PROJECT_MOULDINGS"]["NAME"]; ?>:
								<?= $arItem["PROPERTIES"]["PROJECT_MOULDINGS"]["VALUE"] ?> м.п
							</p>
						<? endif; ?>
						<? if ($arItem["PROPERTIES"]["PROJECT_PRICE"]["VALUE"]): ?>
							<p class="project-item__price inter">
								<?= $arItem["PROPERTIES"]["PROJECT_PRICE"]["NAME"]; ?>:
								<?= $arItem["PROPERTIES"]["PROJECT_PRICE"]["VALUE"] ?> ₽
							</p>
						<? endif; ?>
					</div>
				<? endforeach; ?>
			</div>
			<?= $arResult["NAV_STRING"] ?>
		</div>

	</div>
	<?

	$SectionData = CIBlockSection::GetList(
		false,
		array(
			"IBLOCK_ID" => $arResult["SECTION"]["PATH"][0]["IBLOCK_ID"],
			"CODE" => $arResult["SECTION"]["PATH"][0]["CODE"],
			"ACTIVE" => "Y",
			"GLOBAL_ACTIVE" => "Y",
			"SECTION_ACTIVE" => "Y"
		),
		false,
		array("UF_*"),
		false
	);
	$SectionData = $SectionData->Fetch(); ?>

	<div class="content">
		<? $APPLICATION->IncludeComponent(
			"sprint.editor:blocks",
			"custom",
			array(
				"IBLOCK_ID" => $arResult["SECTION"]["PATH"][0]["IBLOCK_ID"],
				"SECTION_ID" => $arResult["SECTION"]["PATH"][0]["ID"],
				"PROPERTY_CODE" => "UF_CONTENT",
			),
			false,
			array(
				"HIDE_ICONS" => "Y"
			)
		); ?>
	</div>
</div>

<? if (array_key_exists("IS_AJAX", $_REQUEST) && $_REQUEST["IS_AJAX"] == "Y") {
	die();
} ?>
<?
$this->__component->SetResultCacheKeys(array("CACHED_TPL"));
$this->__component->arResult["CACHED_TPL"] = @ob_get_contents();
ob_get_clean();
?>