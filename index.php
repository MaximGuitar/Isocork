<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?>

<section class="main-screen" id="first-screen">
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"slider", 
		array(
			"ACTIVE_DATE_FORMAT" => "",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "N",
			"DISPLAY_PICTURE" => "N",
			"DISPLAY_PREVIEW_TEXT" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "3",
			"IBLOCK_TYPE" => "-",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "20",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "",
				1 => "SLIDE_IMAGE",
				2 => "SLIDE_VIDEO",
				3 => "",
			),
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "ID",
			"SORT_BY2" => "ID",
			"SORT_ORDER1" => "ASC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"COMPONENT_TEMPLATE" => "slider"
		),
		false
	);?>
	<div class="container main-screen__container main-screen__container--slider">
		<h1 class="main-screen__title ">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/includes/inc_main_title.php"
				)
			);?> 
		</h1>
		<p class="main-screen__text inter">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/includes/inc_main_subtitle.php"
				)
			);?>
		</p>
	</div>
	<div class="main-screen__dots-container"></div>
	<div class="main-screen__next inter">
		листай вниз
		<svg class='main-screen__next-arr'>
			<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-bottom'></use>
		</svg>
	</div>
</section>

<section class="logo-section">
	<svg class='logo-section__logo'>
		<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#logo'></use>
	</svg>
	<h2 class="logo-section__title inter">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/includes/inc_logo_text.php"
			)
		);?> </h2>
</section>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"presentation", 
	array(
		"ACTIVE_DATE_FORMAT" => "",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => "5",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "settings_main",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "PRESENT_WORD",
			1 => "PRESENT_TITLE",
			2 => "PRESENT_TEXT",
			3 => "PRESENT_LINK",
			4 => "PRESENT_IMAGE",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "presentation"
	),
	false
);?>

<section class="section-products">
	<div class="container">
		<h2 class="section-products__title section-title">Продукты</h2>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list", 
			"products", 
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "products/#ELEMENT_CODE#/",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "1",
				"IBLOCK_TYPE" => "products",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"COMPONENT_TEMPLATE" => "products"
			),
			false
		);?>
	</div>
</section>

<?$GLOBALS['arrFilter'] = array("PROPERTY_26_VALUE"=>"Да");?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"projects", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "project",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "15",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "РЕФЕРЕНТНЫЕ ПРОЕКТЫ",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "PROJECT_HOUSE",
			1 => "PROJECT_MATERIAL",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "projects"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"presentation_2", 
	array(
		"ACTIVE_DATE_FORMAT" => "",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => "12",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "settings_main",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "PRESENT_WORD",
			1 => "PRESENT_TITLE",
			2 => "PRESENT_TEXT",
			3 => "PRESENT_LINK",
			4 => "PRESENT_IMAGE",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "presentation_2"
	),
	false
);?>
	
<section class="section-callback section-callback--main">
	<h2 class="section-callback__title section-title">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/includes/inc_main_form_title.php"
			)
		);?>
	</h2>
	<div class="section-callback__content">
		<p class="section-callback__text inter">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/includes/inc_main_form_subtitle.php"
				)
			);?>
		</p>
		<div class="section-callback__form-wrap">
			<form action="" class="section-callback__form" data-form>
				<input type="hidden" name="form-id" value="form-callback">
				<div class="form-elem section-callback__form-elem">
					<input type="tel" name="tel" class="form-input" placeholder="Телефон*">
					<p class="form-placeholder">Телефон*</p>
				</div>
				<button data-submit-btn class="section-callback__btn btn btn--filled btn--inline">
					<svg class='btn__arrow'>
						<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
					</svg>
					Отправить запрос
				</button>
			</form>
			<p class="personal section-callback__personal">
				Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/" class="personal__link">на&nbsp;обработку персональных данных</a>
			</p>
		</div>
	</div>
</section>


<?$APPLICATION->IncludeComponent("bitrix:news.list", "news", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",	
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",	
		"CACHE_FILTER" => "N",	
		"CACHE_GROUPS" => "Y",	
		"CACHE_TIME" => "36000000",	
		"CACHE_TYPE" => "A",	
		"CHECK_DATES" => "Y",	
		"DETAIL_URL" => "",	
		"DISPLAY_BOTTOM_PAGER" => "N",	
		"DISPLAY_DATE" => "Y",	
		"DISPLAY_NAME" => "Y",	
		"DISPLAY_PICTURE" => "Y",	
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",	
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	
		"IBLOCK_ID" => "7",	
		"IBLOCK_TYPE" => "content",	
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	
		"INCLUDE_SUBSECTIONS" => "N",	
		"MESSAGE_404" => "",	
		"NEWS_COUNT" => "6",	
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",	
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	
		"PAGER_SHOW_ALL" => "N",	
		"PAGER_SHOW_ALWAYS" => "N",	
		"PAGER_TEMPLATE" => ".default",	
		"PAGER_TITLE" => "Новости",	
		"PARENT_SECTION" => "",	
		"PARENT_SECTION_CODE" => "",	
		"PREVIEW_TRUNCATE_LEN" => "",	
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	
		"SET_LAST_MODIFIED" => "N",	
		"SET_META_DESCRIPTION" => "N",	
		"SET_META_KEYWORDS" => "N",	
		"SET_STATUS_404" => "N",	
		"SET_TITLE" => "N",	
		"SHOW_404" => "N",	
		"SORT_BY1" => "ACTIVE_FROM",	
		"SORT_BY2" => "SORT",	
		"SORT_ORDER1" => "DESC",	
		"SORT_ORDER2" => "ASC",	
		"STRICT_SECTION_CHECK" => "N",	
	),
	false
);?>



<section class="section-map">
	<div class="container">
		<h2 class="section-title section-map__title">Широкая география поставок</h2>
	</div>
	<div class="section-map__map" id="map-container">
		<?php include FULL_TPL_PATH.'/parts/map.php' ?>
	</div>
	<div class="section-map__content">
		<p class="section-map__text inter">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/includes/inc_main_map.php"
				)
			);?>
		</p>
		<a href="/gde-kupit/#gdecupittab" class="section-map__link btn btn--transparent-dark btn--inline">
			<svg class='btn__arrow'>
				<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
			</svg>
			Найти адрес рядом с собой
		</a>
	</div>
</section>



<section class="section-form">
	<img src="<?= SITE_TEMPLATE_PATH ?>/static/images/calc.jpg" alt="" class="section-form__img">
	<div class="section-form__form-col">
		<h2 class="section-form__title">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/includes/inc_footer_form_title.php"
				)
			);?>
		</h2>
		<div class="section-form__form-wrap">
			<p class="section-form__text inter">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/includes/inc_footer_form_subtitle.php"
					)
				);?>
			</p>
			<form action="" class="section-form__form" data-form>
				<input type="hidden" name="form-id" value="form-callback-email">   
				<input type="hidden" name="recaptcha-value" value="">
				<div class="form-elem section-form__form-elem">
					<input type="email" name="email" class="form-input" placeholder="Email*">
					<p class="form-placeholder">Email*</p>
				</div>
				<div class="form-elem section-form__form-elem">
					<input type="tel" name="tel" class="form-input" placeholder="Телефон*">
					<p class="form-placeholder">Телефон*</p>
				</div>
				<button data-submit-btn class="section-form__btn btn btn--orange btn--inline">
					<svg class='btn__arrow'>
						<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
					</svg>
					Отправить запрос
				</button>
				<div class="form-recaptcha">
					<div class="g-recaptcha" data-sitekey="6LdyPysjAAAAAOIVNzcbxZiG6jOm06jzWhhlpoGH"></div>
				</div>
				<p class="personal section-form__personal">
					Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/" class="personal__link">на обработку персональных данных</a>
				</p>
			</form>
		</div>
	</div>
</section>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>