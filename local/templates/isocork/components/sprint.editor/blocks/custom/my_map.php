<? /** @var $block array */
global $APPLICATION;

$title = $block['title'];
$text = $block['text'];
?>

<section class="section-map" id="section-map">
	<div class="container">
		<?if($title):?>
			<h2 class="section-title section-map__title"><?=$title;?></h2>	
		<?endif;?>
	</div>
	<div class="section-map__map" id="map-container">
		<?php include FULL_TPL_PATH.'/parts/map.php' ?>
	</div>
	<div class="section-map__content">
		<?if($text):?>
			<p class="section-map__text inter"><?=$text;?></p>	
		<?else:?>
			<p class="section-map__text inter">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR . "/includes/inc_main_map.php"
					)
				);?>
			</p>
		<?endif;?>
		
		<a href="/gde-kupit#gdecupittab" class="section-map__link btn btn--transparent-dark btn--inline">
			<svg class='btn__arrow'>
				<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
			</svg>
			Найти адрес рядом с собой
		</a>
	</div>
</section>