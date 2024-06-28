<? /** @var $block array */
use \Placestart\Utils;

$title = $block["title"];
$file = $block["file"];
$filepdf = $block["filepdf"]["SRC"];

?>
<section class="section-color" id="section-color">
    <div class="container">
        <div class="section-title__header">
            <? if ($title): ?>
                <h2 class="section-title">
                    <?= $title; ?>
                </h2>
            <? endif; ?>
            <? if ($file["SRC"]): ?>
                <a href="<?= $file["SRC"]; ?>" class="section-color__button btn" download="<?=$file["ORIGINAL_NAME"]?>">Скачать карту цветов</a>
            <? endif; ?>
        </div>
        <div class="section-color__slider-container">
            <div class="slider-color__wrap">
                <div id="slider-color">
                    <div class="gray_border"></div>
                    <? if (isset($filepdf)): ?>
                        <div class="warning_text">
                            <p>Внимание! Возможно искажение цветопередачи.</p><a target="_blank"
                                href="<?= $filepdf ?>">Подробнее..</a>
                        </div>
                    <? endif; ?>
                    <div class="keen-slider">
                        <? foreach ($block["items"] as $arItem): ?>
                            <div class="section-color__item keen-slider__slide">
                                <? if ($arItem["file"]["ORIGIN_SRC"]): ?>
                                    <?
                                    $arImg = Utils::resizeImage($arItem["file"]["ID"], 400, 400, 'exact', 90);
                                    ?>
                                    <a href="<?= $arItem["file"]["ORIGIN_SRC"]; ?>" class="section-color__item-image"
                                        data-fancybox="gallery" data-caption="<?= $arItem["colorName"]; ?>">
                                        <img data-src="<?= $arImg['src']; ?>" data-lazy />
                                    </a>
                                <? endif; ?>
                                <? if ($arItem["colorName"]): ?>
                                    <span class="section-color__item-title inter">
                                        <?= $arItem["colorName"]; ?>
                                    </span>
                                <? endif; ?>
                                <? if ($arItem["file"]["ORIGIN_SRC"]): ?>
                                    <div class="section-color__item-full">
                                        <img data-src="<?= $arImg['src']; ?>" data-lazy />
                                    </div>
                                <? endif; ?>
                            </div>
                        <? endforeach; ?>
                    </div>
                    <div class="section-color__arrows"></div>
                </div>
            </div>
            <div class="section-color__form-section">
                <img class="section-color__form-image" src="<?= SITE_TEMPLATE_PATH ?>/static/images/form-color.png" />
                <div class="section-color__form-text">
                    <p class="section-color__form-title">Закажи свой цвет</p>
                    <p class="section-color__form-subtitle">*от 300 кг</p>
                </div>
            </div>
        </div>
    </div>
</section>