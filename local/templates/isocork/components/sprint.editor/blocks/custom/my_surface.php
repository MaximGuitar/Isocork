<? /** @var $block array */

$title = $block["title"];
?>
<section class="section-surface" id="section-surface">
    <div class="container">
        <?if($title):?>
            <h2 class="section-title align-right section-surface__title"><?=$title;?></h2> 
        <?endif;?>

        <div class="slider-surface">
            <div class="section-surface__slider-grid">
                <div class="keen-slider">
                    <?foreach($block["items"] as $key=>$arItem):
                        $modalParam = '';
                        $modalText = strip_tags($arItem['modalText']);
                        if($arItem['modalImage'] || $modalText)
                            $modalParam = 'data-modal data-type="seo" data-block="' . $block["name"] . '" data-id="' . $key . '"';
                        ?>
                        <div class="section-surface__slider-item keen-slider__slide" <?=$modalParam;?>>
                            <div class="section-surface__item-image-wrap">
                                <?if($arItem["file"]["ORIGIN_SRC"]):?>
                                    <img src="<?=$arItem["file"]["ORIGIN_SRC"];?>" alt="<?=$arItem["surfaceName"];?>">
                                <?endif;?>
                            </div>
                            <?if($arItem["surfaceName"]):?>
                                <p class="section-surface__item-text inter"><?=$arItem["surfaceName"];?></p>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                </div>
                <div class="section-surface__arrows"></div>
            </div>
        </div>
    </div>
</section>