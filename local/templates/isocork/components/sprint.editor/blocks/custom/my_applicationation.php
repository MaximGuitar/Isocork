<? /** @var $block array */

$title = $block["title"];
$text = $block["text"];
?>

<section class="section-applicationation" id="section-applicationation">
    <div class="container">
        <?if($title):?>
            <h2 class="section-title align-right section-applicationation__title"><?=$title;?></h2>
        <?else:?>
            <h2 class="section-title align-right section-applicationation__title">Области применения</h2>
        <?endif;?>			
        <div class="section-applicationation__grid slider-application">
            <div class="keen-slider">
                <?foreach($block["items"] as $arItem):?> 
                    <div class="section-applicationation__item keen-slider__slide">
                        <div class="section-applicationation__item-wrap">
                            <?if($arItem['file']['ORIGIN_SRC']):?>
                                <div class="section-applicationation__item-before">
                                    <img class="section-applicationation__item-image" src="<?=$arItem['file']['ORIGIN_SRC'];?>" alt="<?=$arItem['desc'];?>">
                                </div>
                            <?endif;?>
                            <?if($arItem['fileIcon']['ORIGIN_SRC']):?>
                                <div class="section-applicationation__item-after">
                                    <img class="section-applicationation__item-image" src="<?=$arItem['fileIcon']['ORIGIN_SRC'];?>" alt="<?=$arItem['desc'];?>">
                                </div>
                            <?endif;?>
                            <div class="section-applicationation__item-change">
                                <div class="section-applicationation__item-change-btn">
                                    <svg class='change-arr change-arr--left'>
                                        <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arr-right'></use>
                                    </svg>
                                    <svg class='change-arr change-arr--right'>
                                        <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arr-right'></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <?if($arItem['desc']):?>
                            <p class="section-applicationation__item-title inter"><?=$arItem['desc'];?></p>
                        <?endif;?>
                    </div>
                <?endforeach;?>
            </div>
            <div class="section-applicationation__arrows"></div>
        </div>
        <?if($text):?>
            <div class="section-applicationation__text inter"><?=$text;?></div>
        <?endif;?>
    </div>
</section>