<? /** @var $block array */
use \Placestart\Utils;

$title = $block["title"];
?>
<section class="section-circles-slider">
    <div class="container">
        <? if ($title): ?>
            <h2 class="section-title">
                <?= $title; ?>
            </h2>
        <? endif; ?>
        <? if (count($block["items"]) > 1): ?>
            <div class="circles-slider-wrap">
                <div class="swiper circles-slider">
                    <div class="listing_blockRight"></div>
                    <div class="listing_blockleft"></div>
                    <div class="swiper-wrapper">
                        <? foreach ($block["items"] as $arItem): ?>
                            <div class="swiper-slide">
                                <div class="circle-block">
                                    <?
                                    $arImg = Utils::resizeImage($arItem['file']['ID'], 348, 348, 'proportional', 90);
                                    ?>
                                    <img src="<?= $arImg['src']; ?>" alt="" class="img">
                                    <p class="desc">
                                        <?= $arItem["advanatageName"]; ?>
                                    </p>
                                    <? if ($arItem["actionName"] || $arItem["action"]): ?>
                                        <div class="action-popup">
                                            <p class="name">
                                                <?= $arItem["actionName"]; ?>
                                            </p>
                                            <p class="text inter">
                                                <?= $arItem["action"]; ?>
                                            </p>
                                        </div>
                                    <? endif; ?>
                                </div>
                            </div>
                        <? endforeach; ?>

                    </div>
                    <div class="navigation">
                        <div class="slider-arrow slider-arrow--left">
                            <svg class="slider-arrow__icon">
                                <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#longest-arrow-to-right"></use>
                            </svg>
                        </div>
                        <div class="pagination"></div>
                        <div class="slider-arrow slider-arrow--right">
                            <svg class="slider-arrow__icon">
                                <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#longest-arrow-to-right"></use>
                            </svg>
                        </div>

                    </div>
                </div>
            <? endif; ?>
        </div>
    </div>

</section>