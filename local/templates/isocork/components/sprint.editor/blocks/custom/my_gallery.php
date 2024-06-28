<? /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?><?
 $images = Sprint\Editor\Blocks\Gallery::getImages(
    $block, [
    'width'  => 300,
    'height' => 300,
    'exact'  => 0,
], [
    'width'  => 1024,
    'height' => 768,
    'exact'  => 0,
]
);
?>
<? if (!empty($images)): ?>
    <section class="section-gallery" id="section-gallery">
        <div class="container">
            <div class="gallery__grid">
                <? foreach ($images as $image): ?>
                    <a class="gallery__item" rel="media-gallery" href="<?= $image['DETAIL_SRC'] ?>" data-fancybox="gallery">
                        <img alt="<?= $image['DESCRIPTION'] ?>" src="<?= $image['DETAIL_SRC'] ?>">
                    </a>
                <? endforeach; ?>
            </div>
        </div>
    </section>
<? endif; ?>
