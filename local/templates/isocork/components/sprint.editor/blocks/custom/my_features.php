<? /** @var $block array */

$title = $block["title"];
$text = $block["text"];
?>
<section class="section-features" id="section-features">
    <div class="slider-features">
        <div class="section-features__content">
            <?if($title):?>
                <h2 class="section-title--80 section-features__title"><?=$title;?></h2> 
            <?endif;?>
            <?if($text):?>
                <div class="modal-text"><?=$text;?></div> 
            <?endif;?>
        </div>
        <div class="section-features__slider-grid">
            <div class="keen-slider">
                <?foreach($block["items"] as $key=>$arItem):
                    $modalParam = '';
                    $modalText = strip_tags($arItem['modalText']);
                    if($arItem['modalImage'] || $modalText)
                        $modalParam = 'data-modal data-type="seo" data-block="' . $block["name"] . '" data-id="' . $key . '"';
                    ?>
                    <div class="section-features__slider-item keen-slider__slide" <?=$modalParam;?>>
                        <div class="section-features__item-image-wrap" style="background-image: url('<?=$arItem["file"]["ORIGIN_SRC"];?>')">
                            <?if($arItem["name"]):?>
                                <p class="section-features__item-text inter"><?=$arItem["name"];?></p>
                            <?endif;?>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
            <div class="section-features__arrows"></div>
        </div>
    </div>
</section>