<? /** @var $block array
 *  @var $this SprintEditorBlocksComponent
 *  @var $arParams array - массив с параметрами компонента
 */

$image = $block["file"]["ORIGIN_SRC"];
$title = $block["title"];

$titleDescription = $block["titleDescription"];
$text = $block['text']['value'];
?>

<section class="section-advantages-type2" id="section-advantages-type2">
    <div class="section-advantages-type2__wrap">
        <div class="container">
            <?if($title):?>
                <h2 class="section-title--80 section-advantages-type2__title align-center"><?=$title;?></h2>
            <?endif;?>
            
            <div class="section-advantages-type2__slider">
                <div class="section-advantages-type2__slider-grid">
                    <div class="keen-slider">
                        <?foreach($block["items"] as $key=>$arItem):
                            $modalParam = '';
                            $modalText = strip_tags($arItem['modalText']);
                                if($arItem['modalImage'] || $modalText)
                                    $modalParam = 'data-modal data-type="seo" data-block="' . $block["name"] . '" data-id="' . $key . '"';
                            ?>
                            <div class="section-advantages-type2__item keen-slider__slide">
                                <?if($arItem["file"]):?>
                                    <div class="section-advantages-type2__item-image-wrap">
                                        <img src="<?=$arItem["file"]["ORIGIN_SRC"];?>" alt="<?=$arItem["desc"];?>"/>
                                    </div>
                                <?endif;?>
                                <div class="section-advantages-type2__item-content">
                                    <div>
                                        <?if($arItem["name"]):?>
                                            <h3 class="section-advantages-type2__item-title inter"><?=$arItem["name"];?></h3>
                                        <?endif;?>
                                        <?if($arItem["desc"]):?>
                                            <p class="section-advantages-type2__item-text inter"><?=htmlspecialcharsBack($arItem["desc"]);?></p>
                                        <?endif;?>
                                    </div>
                                    <? 
                                    if($arItem['modalImage'] || $modalText): ?>
                                        <a href="javascript: void(0);" <?=$modalParam;?> class="btn btn--white section-advantages-type2__item-btn">Подробнее</a>
                                    <?endif;?>
                                </div>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
                <div class="section-advantages-type2__slider-arrows"></div>
            </div>
        </div>
    </div>
</section>