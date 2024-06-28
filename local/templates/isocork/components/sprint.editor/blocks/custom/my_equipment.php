<? /** @var $block array */

$title = $block["title"];
$subtitle = $block["subtitle"];
?>

<section class="section-equipment" id="section-equipment">
    <div class="section-equipment__wrap">
        <div class="container">
            <? if ($title): ?>
                <h2 class="section-title section-equipment__title">
                    <?= $title; ?>
                </h2>
            <? endif; ?>
            <? if ($subtitle): ?>
                <p class="section-subtitle section-equipment__subtitle inter">
                    <?= $subtitle; ?>
                </p>
            <? endif; ?>

            <? if (count($block["items"]) > 1): ?>
                <div class="section-equipment__grid slider-equipment">
                    <div class="keen-slider">
                        <? foreach ($block["items"] as $key =>$arItem):
                            $modalParam = '';
                            $modalText = strip_tags($arItem['text']);
                            if ($modalText)
                            $modalParam = 'data-modal data-type="just_text" data-block="' . $block["name"] . '" data-id="' . $key . '"'; ?>
                            <div class="section-equipment__item keen-slider__slide" <?= $modalParam; ?>>
                                <? if ($arItem["file"]["ORIGIN_SRC"]): ?>
                                    <img class="section-equipment__item-image" src="<?= $arItem["file"]["ORIGIN_SRC"]; ?>" alt="">
                                <? endif; ?>
                                <? if ($arItem["equipmentName"]): ?>
                                    <div class="section-equipment__item-text inter">
                                        <?= $arItem["equipmentName"]; ?>
                                    </div>
                                <? endif; ?>
                            </div>
                        <? endforeach; ?>
                    </div>
                    <div class="section-equipment__arrows"></div>
                </div>
            <? endif; ?>
        </div>
    </div>
</section>