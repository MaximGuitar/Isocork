<? /** @var $block array */
?>
<section class="section-number" id="section-number">
    <div class="container">
        <div class="section-number__wrap">
            <div class="section-number__left">
                <h2 class="section-number__title"><?=$block["title"];?></h2>
                <div class="content-text section-number__text"><?=$block["text"];?></div>
                <?if($block["btnText"]):?>
                    <?if($block["btnLink"]):?>
                        <a href="<?=$block["btnLink"];?>" class="btn btn-inline btn--orange section-number__btn"><?=$block["btnText"];?></a>
                    <?else:?>
                        <a href="#" class="btn btn-inline btn--filled section-number__btn" data-modal data-type="feedback"><?=$block["btnText"];?></a>
                    <?endif;?>
                <?endif;?>
            </div>
            <div class="section-number__right">
                <div class="section-number__number-wrap">
                    <?foreach($block["items"] as $arItem):?> 
                        <?if($arItem["title"]):?>
                            <div class="section-number__number-item">
                                <span class="section-number__number-title"><?=$arItem["title"];?></span>
                                <p class="section-number__number-text inter"><?=$arItem["desc"];?></p>
                            </div>
                        <?endif;?>
                    <?endforeach;?>
                </div>

                <?if($block["file"]["ORIGIN_SRC"]):?>
                    <div class="section-number__image">
                        <img src="<?=$block["file"]["ORIGIN_SRC"];?>" alt="<?=$block["title"];?>">
                    </div>
                <?endif;?>
            </div>
        </div>
    </div>
</section>