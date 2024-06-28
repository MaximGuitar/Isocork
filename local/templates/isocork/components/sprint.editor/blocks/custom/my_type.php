<? /** @var $block array */

$title = $block["title"];

?>
<section class="section-type" id="section-type">
    <div class="container">
        <h2 class="section-type__title section-title"><?=$title;?></h2>
        <div id="slider-type">
            <div class="keen-slider">
                <?foreach($block["items"] as $arItem):?>
                    <div class="section-type__item keen-slider__slide">
                        <?if($arItem["file"]["ORIGIN_SRC"]):?>
                            <div class="section-type__item-image">
                                <img src="<?=$arItem["file"]["ORIGIN_SRC"];?>" alt="<?=$arItem["desc"];?>"/>
                            </div>
                        <?endif;?>
                        <span class="section-type__item-progress"></span>
                        <div class="section-type__item-title-wrap">
                            <?if($arItem["desc"]):?>
                                <div class="section-type__item-title"><?=htmlspecialcharsBack($arItem["desc"]);?></div>
                            <?endif;?>
                            <?if($arItem["fileIcon"]["ORIGIN_SRC"]): ?>
                                <span class="section-type__item-title-icon">
                                    <img src="<?=$arItem["fileIcon"]["ORIGIN_SRC"];?>" alt="icon">
                                </span>
                            <?endif;?>
                        </div>
                        <?if($arItem["text"]):?>
                            <div class="section-type__item-text content-text"><?=htmlspecialcharsBack($arItem["text"]);?></div>
                        <?endif;?>
                    </div>
                <?endforeach;?>
            </div>
            <div class="section-type__arrows"></div>
        </div>
    </div>
</section>