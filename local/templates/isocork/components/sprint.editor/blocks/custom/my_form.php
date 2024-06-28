<? /** @var $block array */

$title = $block['title'];
$subtitle = $block['subtitle'];
$img = $block['file']['ORIGIN_SRC']; ?>

<section class="section-form__container" id="section-form">
	<div class="section-form">
		<?if($img): ?>
			<img src="<?=$img; ?>" alt="" class="section-form__img">
		<?else:?>
			<img src="<?=SITE_TEMPLATE_PATH ?>/static/images/form-img.jpg" alt="" class="section-form__img">
		<?endif;?>
		
		<div class="section-form__form-col">
			<?if($title): ?>
				<h2 class="section-form__title"><?=$title;?></h2>
			<?endif;?>
			
			<div class="section-form__form-wrap">
				<?if($subtitle): ?>
					<p class="section-form__text inter"><?=$subtitle;?></p>
				<?endif;?>
				<form action="" class="section-form__form" data-form>
					<input type="hidden" name="form-id" value="form-callback-email">  
					<input type="hidden" name="form-title" value="<?=$title;?>"> 
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
	</div>
</section>