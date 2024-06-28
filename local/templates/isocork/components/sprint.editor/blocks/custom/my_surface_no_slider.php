<? /** @var $block array */

$title = $block["title"];
?>
<section class="section-surface-no-slider" id="section-surface-no-slider">
    <div class="container">
        <? if ($title): ?>
            <h2 class="section-title align-right section-surface-no-slider__title">
                <?= $title; ?>
            </h2>
        <? endif; ?>
        <div class="section-surface-no-slider-flex">
            <? foreach ($block["items"] as $key => $arItem):
                $modalParam = '';
                $modalText = strip_tags($arItem['modalText']);
                if ($arItem['modalImage'] || $modalText)
                    $modalParam = 'data-modal data-type="seo" data-block="' . $block["name"] . '" data-id="' . $key . '"';
                ?>
                <div class="section-surface-no-slider-flex__item" <?= $modalParam; ?>>
                    <div class="section-surface-no-slider-flex__item-image-wrap">
                        <? if ($arItem["file"]["ORIGIN_SRC"]): ?>
                            <img src="<?= $arItem["file"]["ORIGIN_SRC"]; ?>" alt="<?= $arItem["surfaceName"]; ?>">
                        <? endif; ?>
                    </div>
                    <? if ($arItem["surfaceName"]): ?>
                        <p class="section-surface-no-slider-flex__item-text inter">
                            <?= $arItem["surfaceName"]; ?>
                        </p>
                    <? endif; ?>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>