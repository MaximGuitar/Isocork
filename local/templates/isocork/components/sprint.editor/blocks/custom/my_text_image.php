<? /** @var $block array */?>

<section class="texts-section section-container" id="texts-section">
    <?foreach($block["items"] as $arItem):?> 
        <div class="texts-section__container">
            <?if($arItem['file']['ORIGIN_SRC']):?>
                <div class="texts-section__img-col">
                    <img alt="<?=$arItem['imageTitle']?>" src="<?=$arItem['file']['ORIGIN_SRC'];?>" class="texts-section__img">
                </div>
            <?endif;?>
            <?if($arItem['text']):?>
                <div class="texts-section__text-col content-text"><?=$arItem['text'];?></div>
            <?endif;?>
        </div>
    <?endforeach;?>
</section>