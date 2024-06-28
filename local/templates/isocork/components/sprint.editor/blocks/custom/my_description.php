<? /** @var $block array */

$title = $block['title'];
$text = $block['text']['value'];?>

<section class="section-about" id="section-about">
	<div class="section-about__text-container">
		<h2 class="section-about__title"><?=$title;?></h2>
			<div class="section-about__text">
				<div class="content-text"><?=$text;?></div>
			</div>
	</div>
</section>