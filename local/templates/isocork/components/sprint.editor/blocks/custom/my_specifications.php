<? /** @var $block array */

$title = $block['title'];
$file = $block['file']['SRC'];?>

<section class="section-specification" id="specification">
	<div class="container">
		<div class="section-title__header">
			<?if($title):?>
				<h2 class="section-title"><?=$title;?></h2>
			<?else:?>
				<h2 class="section-title">Технические характеристики</h2>
			<?endif;?>
			<a href="/podderzhka/#sidebar-header-1/" class="section-specification__button btn btn--filled">Рассчитать количество материала</a>
			<?if($file):?>
				<a href="<?=$file;?>" class="section-specification__button btn btn--transparent-dark section-specification__button--download" download='<?=$block['file']['ORIGINAL_NAME'];?>'>Скачать PDF</a>
			<?endif;?>
		</div>
		<div class="section-specification__table">
			<? $countVisible = 0;
			foreach($block["items"] as $arItem):?>
				<? $classVisible = '';
				if($countVisible > 6) $classVisible = 'hidden'; ?> 
					<div class="section-specification__table-row <?=$classVisible;?>">
						<?if($arItem['specificationKey']):?>
							<div class="section-specification__table-column"><?=$arItem['specificationKey'];?></div>
						<?endif;?>
						<?if($arItem['specificationValue']):?>
							<div class="section-specification__table-column"><?=$arItem['specificationValue'];?></div>
						<?endif;?>
					</div>
				<?$countVisible++;?>
			<?endforeach;?>
			<div class="note_text">
				*Значения могут меняться в зависимости от параметров окружающей среды(температура, влажность) и типа субъекта
			</div>	
			
			<?if($countVisible > 6):?>
				<button class="btn section-specification__btn-more btn--transparent-dark">
					<svg class='btn__arrow'>
						<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
					</svg>	
					Показать еще
				</button>
			<?endif;?>
		</div>
	</div>
</section>