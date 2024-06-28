<? /** @var $block array */
global $APPLICATION;

$title = $block['title'];
$text = $block['text'];?>

<section class="section-callback" id="section-callback">
	<h2 class="section-callback__title section-title">
		<?if($title):
			echo $title; ?>
		<?else:?>
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
		<?endif;?>
	</h2>
	<div class="section-callback__content">
		<?if($text):?>
			<p class="section-callback__text inter"><?=$text;?></p>
		<?else:?>
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
		<?endif;?>
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