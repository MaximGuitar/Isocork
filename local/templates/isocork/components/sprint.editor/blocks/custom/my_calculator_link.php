<? /** @var $block array */

$title = $block['title'];
$title1 = $block['title1'];
$subtitle1 = $block['value1'];
$subtitle2 = $block['value2'];
$textbtn = $block['textbtn'];
$calclink = $block['calclink'];
$questlink = $block['questionlink'];
$img = $block['file']['ORIGIN_SRC']; 
?>

<section class="section-calc__container" id="section-calc">
	<div class="section-calc">
		<? if ($img): ?>
			<img src="<?= $img; ?>" alt="" class="section-calc__img">
		<? else: ?>
			<img src="<?= SITE_TEMPLATE_PATH ?>/static/images/form-img.jpg" alt="" class="section-calc__img">
		<? endif; ?>

		<div class="calc_content">
			<div class="section-calc__form-wrap">
				<div class="calcBlock">
					<? if ($title): ?>
						<h2 class="section-calc__title">
							<?= $title; ?>
						</h2>
					<? endif; ?>
					<? if ($img): ?>
						<img src="<?= $img; ?>" alt="" class="mobile-img section-calc__img">
					<? else: ?>
						<img src="<?= SITE_TEMPLATE_PATH ?>/static/images/form-img.jpg" alt="" class="section-calc__img">
					<? endif; ?>
					<? if ($subtitle1): ?>
						<div class="section-calc__text inter">
							<?=$subtitle1;?>
						</div>
					<? endif; ?>
					<a href="<?= $calclink; ?>" class="enter-btn btn btn--transparent btn--inline">
						<svg class='btn__arrow'>
							<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
						</svg>
						<?= $textbtn; ?>
					</a>
				</div>
				<div class="questblock">	
					<? if ($title): ?>
						<h2 class="section-calc__title">
							<?= $title1; ?>
						</h2>
					<? endif; ?>
				
					<? if ($subtitle2): ?>
						<div class="section-calc__text inter">
							<?= $subtitle2; ?>
						</div>
					<? endif; ?>
					<? if ($subtitle2): ?>
					<a href="<?= $questlink; ?>" class="enter-btn btn btn--transparent btn--inline">
						<svg class='btn__arrow'>
							<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
						</svg>
						<?= $textbtn; ?>
					</a>
					<? endif; ?>
				</div>	
			</div>
		</div>
	</div>
</section>