<? /** @var $block array */
?>
<section class="section-application-type2" id="section-application-type2">
    <div class="container">
        <div class="section-application-type2__container">
            <h2 class="section-title--80 section-application-type2__title"><?=$block["title"];?></h2>
            <?if($block["value"]):?>
                <div class="modal-text section-application-type2__text"><?=$block["value"];?></div>
            <?endif;?>

            <div class="slider-application-type2">
                <div class="keen-slider">
                    <?foreach($block["items"] as $arItem):?> 
                        <div class="slider-application-type2__item keen-slider__slide">
                            <?if($arItem["file"]["ORIGIN_SRC"]):?>
                                <div class="slider-application-type2__item-image">
                                    <img src="<?=$arItem["file"]["ORIGIN_SRC"];?>"/>
                                </div>
                            <?endif;?>
                            <?if($arItem["desc"]):?>
                                <span class="slider-application-type2__item-title inter"><?=$arItem["desc"];?></span>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                </div>
                <div class="slider-application-type2__arrows"></div>
            </div>
        </div>
    </div>
    <?if($block["word"]): ?>
        <p class="section-application-type2__word"><?=$block["word"];?></p>
    <?endif;?>
</section>