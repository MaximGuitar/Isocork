<? /** @var $block array */

$title = $block['title'];
$subtitle = $block['subtitle'];
$textbtn = $block['textbtn'];
$calclink = $block['calclink'];
$img = $block['file']['ORIGIN_SRC']; ?>

<section class="section-triangle__container" id="section-triangle">
	<div class="section-triangle">


	<div class="calc_content">
		<div class="section-triangle__form-wrap">
			<?if($title): ?>
				<h2 class="section-triangle__title"><?=$title;?></h2>
			<?endif;?>
			<?if($img): ?>
			<img src="<?=$img; ?>" alt="" class="mobile-img section-triangle__img">
		<?else:?>
			<img src="<?=SITE_TEMPLATE_PATH ?>/static/images/form-img.jpg" alt="" class="section-triangle__img">
		<?endif;?>
				<?if($subtitle): ?>
					<p class="section-triangle__text inter"><?=$subtitle;?></p>
				<?endif;?>
				
			</div>
		</div>


		<?if($img): ?>
			<img src="<?=$img; ?>" alt="" class="section-triangle__img">
		<?else:?>
			<img src="<?=SITE_TEMPLATE_PATH ?>/static/images/form-img.jpg" alt="" class="section-triangle__img">
		<?endif;?>
		
		
	</div>
</section>