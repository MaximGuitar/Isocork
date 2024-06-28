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
?>

<div class="page">
	<div class="container">
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
		<h1 class="page-title align-center page-title--project">Примеры работ</h1>

		<?
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"projects",
			array(
				"ADD_SECTIONS_CHAIN" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COUNT_ELEMENTS" => "N",
				"FILTER_NAME" => "sectionsFilter",
				"IBLOCK_ID" => "8",
				"IBLOCK_TYPE" => "project",
				"SECTION_CODE" => "",
				"SECTION_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SECTION_ID" => "",
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array(
					0 => "UF_CONTENT",
					1 => "",
				),
				"SHOW_PARENT_NAME" => "Y",
				"TOP_DEPTH" => "2",
				"VIEW_MODE" => "LINE",
				"COMPONENT_TEMPLATE" => "projects",
				"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
				"CUSTOM_SECTION_SORT" => array(
					"UF_SORT_F" => "ASC",
				)
			),
			false
		);
		?>
	</div>
	<div class="content">
		<? $content = $APPLICATION->IncludeComponent(
			"sprint.editor:blocks",
			"custom",
			array(
				"ELEMENT_ID" => 26,
				"IBLOCK_ID" => 2,
				"PROPERTY_CODE" => "CONTENT",
			),
			$component,
			array(
				"HIDE_ICONS" => "Y"
			)
		); ?>
	</div>
</div>