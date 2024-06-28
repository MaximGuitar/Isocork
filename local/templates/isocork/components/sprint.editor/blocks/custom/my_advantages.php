<? /** @var $block array
  *  @var $this SprintEditorBlocksComponent
  *  @var $arParams array - массив с параметрами компонента
  */

$image = $block["file"]["ORIGIN_SRC"];
$title = $block["title"];
$word = $block["word"];
$endtext = $block["endtext"];
$filepdf = $block["filepdf"]["SRC"];
$titleDescription = $block["titleDescription"];
$text = $block['text']['value'];
?>

<section class="section-about-inner" id="section-advantages">
    <? if ($titleDescription || $text): ?>
        <div class="section-about-inner__text-container">
            <? if ($titleDescription): ?>
                <h2 class="section-about-inner__title">
                    <?= $titleDescription; ?>
                </h2>
            <? endif; ?>
            <? if ($text): ?>
                <div class="section-about-inner__text">
                    <div class="content-text">
                        <?= $text; ?>
                    </div>
                </div>
            <? endif; ?>
        </div>
    <? endif; ?>
    <div class="section-about-inner__content content-about">
        <? if ($image) ?>
        <img src="<?= $image; ?>" alt="<?= $title; ?>" class="section-about__cork-img">

        <div class="section-about__goals container">
            <h2 class="section-about-inner__goals-title">
                <?= $title; ?>
            </h2>
            <div id="slider-goals">
                <div class="section-about__slider-goals-grid swiper">
                    <div class="swiper-wrapper">
                        <? foreach ($block["items"] as $key => $arItem):
                            $modalParam = '';
                            $modalText = strip_tags($arItem['modalText']);
                            if ($arItem['modalImage'] || $modalText)
                                $modalParam = 'data-modal data-type="seo" data-block="' . $block["name"] . '" data-id="' . $key . '"';
                            ?>
                            <div class="section-about__goal swiper-slide section-about__goal-slide  <?= $arItem['hoverText'] ? 'hovertext' : ' ' ?>"  <?= $modalParam; ?>>
                                <? if ($arItem["file"]["ORIGIN_SRC"]): ?>
                                    <div class="section-about__goal-image-wrap section-about__goal-imgscr">
                                        <img src="<?= $arItem["file"]["ORIGIN_SRC"]; ?>" alt="<?= $arItem["desc"]; ?>" />
                                    </div>
                                <? endif; ?>
                                <? if ($arItem["desc"]): ?>
                                    <p class="section-about__goal-text inter section-about__goal-textscr">
                                        <?= htmlspecialcharsBack($arItem["desc"]); ?>
                                    </p>
                                <? endif; ?>
                                <? if (($arItem['hoverText'])): ?>
                                    <div class="section-about__goal-activebtn">
                                        <div class="hover_text">
                                            <?= $arItem['hoverText'] ?>
                                        </div>
                                    </div>
                                <? elseif ($arItem['modalImage'] || $modalText): ?>
                                    <div class="section-about__goal-activebtn">
                                        <a href="" class="section-about__goal-imgbtn btn">
                                            <svg class="btn__arrow">
                                                <use href="/local/templates/isocork/static/images/sprite.svg#gold_arrow_right">
                                                </use>
                                            </svg>
                                            <p class="section-about__goal-btntext inter">Подробнее</p>
                                        </a>
                                    </div>
                                <? endif; ?>
                            </div>
                        <? endforeach; ?>

                        <? if ($endtext): ?>
                            <div class="section-about__goal swiper-slide">
                                <!-- <p class="section-about__goal-text inter"><?= htmlspecialcharsBack($arItem["desc"]); ?></p> -->
                                <p class="section-about__goal-text inter">
                                    <?= $endtext; ?>
                                </p>
                                <a href="<?= $filepdf; ?>" class="section-about__goal-slideEndBtn btn" download="<?=$block["filepdf"]["ORIGINAL_NAME"]?>">
                                    <p class="section-about__goal-btntextEnd inter">Скачать PDF</p>
                                </a>

                            </div>
                        <? endif; ?>
                    </div>
                </div>
                <div class="section-about__slider-arrows">
                    <div class="slider-arrow slider-arrow--left">
                        <svg class="slider-arrow__icon">
                            <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#longest-arrow-to-right"></use>
                        </svg>
                    </div>
                    <div class="slider-arrow slider-arrow--right">
                        <svg class="slider-arrow__icon">
                            <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#longest-arrow-to-right"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <? if ($word): ?>
            <p class="section-about__isocork section-about__isocork--first">
                <?= $word; ?>
            </p>
            <p class="section-about__isocork section-about__isocork--last">
                <?= $word; ?>
            </p>
        <? endif; ?>
    </div>
</section>