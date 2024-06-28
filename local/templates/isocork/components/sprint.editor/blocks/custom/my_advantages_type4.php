<? /** @var $block array */

$title = $block["title"];
$counter = 0;

?>
<section class="section-advantages-type3">
    <div class="container">
        <? if ($title): ?>
            <h2 class="section-title--80 title align-center">
                <?= $title; ?>
            </h2>
        <? endif; ?>
        <div class="advantages-type3-slider">
            <div class="swiper">
                <? if (count($block["items"]) > 1): ?>
                    <div class="slider-arrow orange_image1">
                        <svg>
                            <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#orange-cirkle-arrow'></use>
                        </svg>
                    </div>
                    <div class="slider-arrow orange_image2">
                        <svg>
                            <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#orange-cirkle-arrow'></use>
                        </svg>
                    </div>
                    <div class="swiper-wrapper">

                        <? foreach ($block["items"] as $key => $arItem):
                            $modalParam = '';
                            $modalText = ($arItem['text']);
                            if ($arItem['text'])
                                $currentSlide = $key + 1;
                            $modalParam = 'data-modal data-type="just_text" data-block="' . 'my_advantages_type4' . '" data-id="' . $key . '"';
                            ?>
                            <div class="swiper-slide" <? if ($arItem["text"]) {
                                echo $modalParam;
                            } ?>>
                                <div class="advantage-type3">
                                    <img src="<?= $arItem["file"]["ORIGIN_SRC"]; ?>" alt="" class="bg">
                                    <p class="num">
                                        <?php
                                        $counter++;
                                        if ($counter < 10) {
                                            print_r(str_pad($counter, 2, 0, STR_PAD_LEFT));
                                        } else {
                                            echo $counter;
                                        }
                                        ?>
                                    </p>
                                    <p class="name inter">
                                        <?= $arItem["slidetitle"]; ?>
                                    </p>
                                    <? if ($arItem["text"]  and  $arItem["text"] != "<p><br></p>"): ?>
                                        <div class="link inter">
                                            <?= $arItem["subtitle"]; ?>
                                            <svg class="arr">
                                                <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
                                            </svg>
                                        </div>
                                    <? endif; ?>
                                </div>

                            </div>
                        <? endforeach; ?>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </div>
</section>