<? /** @var $block array */
use \Placestart\Utils;
?>
<section class="section-render" id="section-interior">
    <div class="section-render__wrap">
        <div class="swiper slider-render">
            <div class="swiper-wrapper slider-render__wrap">
                <?if($block['items']): ?>
                    <?foreach($block["items"] as $arItem):?> 
                        <div class="swiper-slide slider-render__slide">
                            <div class="swiper slider-render__slide-slider">
                                <div class="swiper-wrapper">
                                    <?foreach ($arItem['blocks'] as $itemblock): ?>
                                        <?foreach ($itemblock['items'] as $itemblockMini): ?>                                     
                                            <div class="swiper-slide">                                          
                                            <?                
                                                $arImg = Utils::resizeImage($itemblockMini['fileIcon']['ID'], 1903, 658,'proportional',90);                    
                                            ?> 
                                                <img class="preloader-circles" data-src="<?=$arImg['src'];?>" alt="" data-lazy>
                                            </div>
                                        <?endforeach;?>
                                    <?endforeach;?>
                                </div>
                            </div>
                            <div class="swiper slider-render__slide-slider--thumbnail">
                                <div class="swiper-wrapper">
                                    <?foreach ($arItem['blocks'] as $itemblock): ?> 
                                        <?foreach ($itemblock['items'] as $itemblockMini): ?>
                                            <div class="swiper-slide">
                                                <div class="swiper-slide__wrap">
                                                    <div class="swiper-slide__image-wrap">
                                                        <img class="preloader-circles" data-src="<?=$itemblockMini['file']['SRC']?>" alt="" data-lazy> 
                                                    </div>
                                                </div>
                                            </div>
                                        <?endforeach;?>
                                    <?endforeach;?>
                                </div>
                            </div>
                        </div>
                    <?endforeach;?>
                <?endif;?>
            </div>
        </div>

        <div class="slider-render--thumbnail">
            <div class="swiper swiper-render--thumbnail">
                <div class="swiper-wrapper slider-render__thumbnail-wrap">
                    <?if($block['items']): ?>
                        <?foreach($block["items"] as $arItem):?> 
                            <div class="swiper-slide slider-render__thumbnail-slide">
                                <?foreach ($arItem['blocks'] as $itemblock): ?>
                                    <img class="preloader-circles" data-src="<?=$itemblock['items'][0]['fileIcon']['ORIGIN_SRC']?>" alt="" data-lazy>
                                <?endforeach;?>
                            </div>
                        <?endforeach;?>
                    <?endif;?>
                </div>
            </div>
            <div class="slider-render__thumbnail-arrows">
                <div class="slider-arrow slider-arrow--left">
                    <svg class="slider-arrow__icon">
                        <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#short-arrow-to-right"></use>
                    </svg>
                    </div><div class="slider-arrow slider-arrow--right">
                    <svg class="slider-arrow__icon">
                        <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#short-arrow-to-right"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>