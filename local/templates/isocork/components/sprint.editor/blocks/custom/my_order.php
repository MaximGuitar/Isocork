<? /** @var $block array */
use \Placestart\Utils;

$title = $block["title"];
$file = $block["file"];
$filePDF = $block["filepdf"]["SRC"];
?>

<section class="section-order" id="section-order">
    <div class="container">
        <? if ($title): ?>
            <h2 class="section-title m-90">
                <?= $title; ?>
            </h2>
        <? endif; ?>
        <div class="section-order__grid slider-order">
            <div class="section-order__item-image-wrap">
                <?
                $arImg = Utils::resizeImage($file["ID"], 805, 805, 'proportional', 90);
                ?>
                <? if ($file["ORIGIN_SRC"]): ?>
                    <img class="section-order__item-image" data-lazy data-src="<?= $arImg['src']; ?>" alt="<?= $title; ?>">
                <? endif; ?>
                <div class="section-order__dots-container">
                    <div class="section-order__dots-wrap"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="circle-wrap" viewBox="0 0 100 100">
                        <circle id="circle" class="circle" cx="50" cy="50" r="50" stroke-width="1" fill="none"
                            stroke-dasharray="315" stroke-dashoffset="315" transform="rotate(-90 ) translate(-100 0)" />
                    </svg>
                    <? if ($block["items"][0]['file']['ORIGIN_SRC']): ?>
                        <div class="section-order__icon-wrap">
                            <img src="<?= $block["items"][0]['file']['ORIGIN_SRC']; ?>" class="section-order__icon" />
                        </div>
                    <? endif; ?>
                </div>
            </div>
            <div class="swiper section-order__swiper">
                <div class="swiper-wrapper">
                    <? foreach ($block["items"] as $key => $arItem):
                        $modalParam = '';
                        $modalText = ($arItem['text']);
                        if ($arItem['text'])
                            $modalParam = 'data-modal data-type="just_text" data-block="' . 'my_order' . '" data-id="' . $key . '"';
                        $currentSlide = $key + 1; ?>
                        <div class="section-order__item swiper-slide" data-icon="<?= $arItem['file']['ORIGIN_SRC']; ?>">
                            <div class="section-order__item-content">
                                <div class="section-order__item-title-wrap">
                                    <p class="section-order__item-title">Шаг
                                        <?= $currentSlide; ?>
                                    </p>
                                </div>
                                <div class="section-order__item-text-wrap">
                                    <? if ($arItem['desc']): ?>
                                        <p class="inter section-order__item-text inter">
                                            <?= $arItem['desc']; ?>
                                        </p>
                                    <? endif; ?>
                                    <? if ($arItem['text']): ?>
                                        <? if ($arItem['text'] != "<p><br></p>"): ?>
                                            <div class="more_link" <?= $modalParam; ?>>Подробнее...</div>
                                        <? endif; ?>
                                    <? endif; ?>
                                    <!-- <? //if($arItem['linkText'] && $arItem['link']):?>
                                        <a href="<?= $arItem['link']; ?>" class="section-order__item-link btn btn--black"><?= $arItem['linkText']; ?></a>
                                    <? //endif;?> -->
                                    <? if ($filePDF): ?>
                                        <a class="download_isnsruction" href="<?= $filePDF; ?>" download="<?=$block["filepdf"]['ORIGINAL_NAME'];?>">Скачать инструкцию по
                                            нанесению</a>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
                <div class="section-order__navigation">
                    <div class="section-order__arrows">
                        <div class="slider-arrow slider-arrow--left">
                            <svg class="slider-arrow__icon">
                                <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#longest-arrow-to-right">
                                </use>
                            </svg>
                        </div>
                        <div class="slider-counter"><span class="slider-current-slide">01</span>/
                            <?= str_pad(count($block["items"]), 2, '0', STR_PAD_LEFT); ?>
                        </div>
                        <div class="slider-arrow slider-arrow--right">
                            <svg class="slider-arrow__icon">
                                <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#longest-arrow-to-right">
                                </use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>