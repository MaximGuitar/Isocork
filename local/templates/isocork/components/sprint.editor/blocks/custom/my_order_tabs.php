<? /** @var $block array */
use \Placestart\Utils;
$title = $block["title"];
$file = $block["file"]["SRC"];
?>
<section class="section-order" id="section-order">
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
                <div class="btn button_circle btn--transparent-dark section-specifications-tabs__tab-item" data-tab
                    data-tab-id="tab-<?=$i; ?>"><?=$itemblock['title'];?></div>
                <? $i++; endforeach;?>
                <?endforeach;?>
            </div>
            <?endif;?>
        </div>
        <?foreach($block["items"]  as $i=> $arItem):?>
            <?foreach ($arItem['blocks'] as $itemblock): ?>
                <div class="section-specifications-tabs__tab-content diagram_circle" data-tab-item="tab-<?=$i;?>">
                    <div class="section-order__grid slider-order">
                        <div class="section-order__item-image-wrap">
                            <?if($block["items"][$i]['blocks'][0]['file']['SRC']):?>
                                <?  
                                    $arImg = Utils::resizeImage($block["items"][$i]['blocks'][0]['file']['ID'], 805, 805,'proportional',90);
                                ?>  
                            <img class="section-order__item-image" data-lazy data-src="<?=$arImg['src'];?>"
                                alt="<?=$title;?>">
                            <?endif;?>
                            <div class="section-order__dots-container">
                                <div class="section-order__dots-wrap"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="circle-wrap" viewBox="0 0 100 100">
                                    <circle id="circle" class="circle" cx="50" cy="50" r="50" stroke-width="1" fill="none"
                                        stroke-dasharray="315" stroke-dashoffset="315"
                                        transform="rotate(-90 ) translate(-100 0)" />
                                </svg>
                                <div class="section-order__icon-wrap">
                                    <img src="<?=$block["items"][$i]['blocks'][0]['items'][0]['file']['SRC'];?>"
                                        class="section-order__icon" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper section-order__swiper">
                            <div class="swiper-wrapper">
                            <?foreach($itemblock["items"] as $key => $arItem):
                                $modalParam = '';
                                $modalText = ($arItem['text']);
                                if($arItem['text'])
                                $currentSlide = $key+1;
                                $modalParam = 'data-modal data-type="order_tabs" data-block="' . 'my_order_tabs' . '" data-id="' . $i . '" data-slideid="' . $key . '"';
                            ?>
                                <div class="section-order__item swiper-slide" data-icon="<?=$arItem['file']['SRC'];?>">
                         
                                    <div class="section-order__item-content">
                                        <div class="section-order__item-title-wrap">
                                            <p class="section-order__item-title">Шаг <?=$currentSlide;?></p>
                                        </div>
                                        <div class="section-order__item-text-wrap">
                                            <?if($arItem['specificationKey']):?>
                                            <p class="inter section-order__item-text inter"><?=$arItem['specificationKey'];?>
                                            </p>
                                            <?endif;?>
                                            <?if($arItem['text']):?>
                                                <div class="more_link"   <?=$modalParam;?>>Подробнее...</div>
                                            <?endif;?>
                                                <?if($file):?>
                                                    <a class="download_isnsruction" href="<?=$file;?>" download='<?=$block['file']['ORIGINAL_NAME'];?>'>Скачать инструкцию по
                                                        нанесению</a>
                                                <?endif;?>
                                            <?if($arItem['linkText'] && $arItem['link']):?>
                                            <a href="<?=$arItem['link'];?>"
                                                class="section-order__item-link btn btn--black"><?=$arItem['linkText'];?></a>
                                            <?endif;?>
                                        </div>
                                    </div>
                                </div>
                                <?endforeach;?>
                            </div>
                            <div class="section-order__navigation">
                                <div class="section-order__arrows">
                                    <div class="slider-arrow slider-arrow--left">
                                        <svg class="slider-arrow__icon">
                                            <use
                                                href="<?=SITE_TEMPLATE_PATH?>/static/images/sprite.svg#longest-arrow-to-right">
                                            </use>
                                        </svg>
                                    </div>
                                    <div class="slider-counter"><span
                                            class="slider-current-slide">01</span>/<?=str_pad(count($itemblock["items"]), 2, '0', STR_PAD_LEFT);?>
                                    </div>

                                    <div class="slider-arrow slider-arrow--right">
                                        <svg class="slider-arrow__icon">
                                            <use
                                                href="<?=SITE_TEMPLATE_PATH?>/static/images/sprite.svg#longest-arrow-to-right">
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? $i++; endforeach;?>
        <?endforeach;?>
        <?if($block['descr']):?>                         
            <div class="description">
                <!-- <div class="description__title">
                    Внимание
                </div> -->
                <div class="description__text">
                    <?= $block['descr']?>
                </div>
            </div>
        <?endif;?>
    </div>

</section>