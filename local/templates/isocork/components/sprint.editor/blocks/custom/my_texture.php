<? /** @var $block array */

$title = $block["title"];
?>  
<section class="section-texture" id="section-texture">
    <div class="container">
        <?if($title):?>
            <h2 class="section-title section-texture__title m-90"><?=$title;?></h2> 
        <?endif;?>

        <div class="slider-texture">
            <div class="section-texture__slider-grid">
                <div class="keen-slider">
                    <?foreach($block["items"] as $key=>$arItem):
                        $modalParam = '';
                        $modalText = strip_tags($arItem['modalText']);
                        if($arItem['modalImage'] || $modalText)
                            $modalParam = 'data-modal data-type="seo" data-block="' . $block["name"] . '" data-id="' . $key . '"';
                        ?>
                        <div class="section-texture__item keen-slider__slide" <?=$modalParam;?>>
                            <div class="section-texture__item-image-wrap">
                                <?if($arItem["file"]["ORIGIN_SRC"]):?>
                                    <img src="<?=$arItem["file"]["ORIGIN_SRC"];?>" alt="<?=$arItem["name"];?>">
                                <?endif;?>
                            </div>
                            <?if($arItem["name"]):?>
                                <p class="section-texture__item-text inter"><?=$arItem["name"];?></p>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                </div>
                <div class="section-texture__slider-arrows"></div>
            </div>
        </div>
    </div>
</section>