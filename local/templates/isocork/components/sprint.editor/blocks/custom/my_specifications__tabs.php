<? /** @var $block array */

$title = $block["title"];
$file = $block["file"]['SRC'];

?>
<section class="section-specifications-tabs" id="section-specifications-tabs">
    <div class="container">
        <?if($title):?>
            <h2 class="section-title m-90"><?=$title;?></h2>
        <?endif;?>
        <div class="section-specifications-tabs__head">
            <?if($block["items"]):?>
                <div class="section-specifications-tabs__tabs">
                    <?$i = 0;
                    foreach($block["items"] as $arItem):?>
                        <?foreach ($arItem['blocks'] as $itemblock): ?>        
                            <div class="btn btn--transparent-dark section-specifications-tabs__tab-item" data-tab data-tab-id="tab-<?=$i; ?>"><?=$itemblock['title'];?></div>
                        <? $i++; endforeach;?>
                    <?endforeach;?>
                </div>
            <?endif;?>
            <?if($file):?>
                <a href="<?=$file;?>" class="btn btn--transparent-dark section-specifications-tabs__btn" download='<?=$block['file']['ORIGINAL_NAME'];?>'>Скачать PDF</a>
            <?endif;?>
        </div>

        <div class="section-specifications-tabs__tabs-content">
            <?$i = 0;
            foreach($block["items"] as $arItem):?>
                <?foreach ($arItem['blocks'] as $itemblock): ?>        
                    <div class="section-specifications-tabs__tab-content" data-tab-item="tab-<?=$i;?>">
                        <?$countVisible = 0;
                        foreach($itemblock["items"] as $arItem):?>
                            <? $classVisible = '';
                            if($countVisible > 5) $classVisible = 'hidden'; ?> 
                                <div class="section-specification__table-row <?=$classVisible;?>">
                                    <?if($arItem['specificationKey']):?>
                                        <div class="section-specification__table-column"><?=$arItem['specificationKey'];?></div>
                                    <?endif;?>
                                    <?if($arItem['specificationValue']):?>
                                        <div class="section-specification__table-column"><?=$arItem['specificationValue'];?></div>
                                    <?endif;?>
                                </div>
                            <?$countVisible++;?>
                        <?endforeach;?>

                        <?if($countVisible > 5):?>
                            <button class="btn section-specification__btn-more btn--transparent-dark">
                                <svg class='btn__arrow'>
                                    <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
                                </svg>	
                                Показать еще
                            </button>
                        <?endif;?>
                    </div>
                <? $i++; endforeach;?>
            <?endforeach;?>
        </div>
    </div>
</section>