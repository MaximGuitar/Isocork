<? /** @var $block array */
use \Placestart\Utils;
?>
<section class="section-square-link-blocks">
        <div class="container">
            <h2 class="section-title"><?=$block["title"];?></h2>
            <div class="square-link-blocks-slider">
                <div class="grid keen-slider">
                    <?foreach($block["items"] as $key => $arItem):
                        $modalParam = '';
                        $modalText = ($arItem['text']);
                        if($arItem['text'])
                        $currentSlide = $key+1;
                        $modalParam = 'data-modal data-type="just_text" data-block="' . 'my_applicationation_type3' . '" data-id="' . $key . '"';    
                    ?> 
                        <? // d($arItem);?>
                        <div class="square-link-block keen-slider__slide" <?if($arItem["text"]){echo $modalParam;}?>>
                                <div class="img-wrap">
                                <?
                                $arImg = Utils::resizeImage($arItem['file']['ID'], 409, 409,'proportional',90);                     
                                ?>  
                                    <img data-lazy data-src="<?=$arImg['src'];?>" alt="" class="bg">
                                    <?if($arItem["text"]):?>
                                        <div class="cover">
                                            <button class="btn btn--transparent btn--inline">
                                                <svg class="btn__arrow">
                                                    <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right"></use>
                                                </svg>
                                                Подробнее
                                            </button>
                                        </div>
                                    <?endif;?>
                                </div>  
                                <?if($arItem["desc"]):?>
                                    <p class="link link-cover inter"><?=$arItem["desc"];?></p>
                                <?endif;?>
                              
                            </div>
                    <?endforeach;?>
                </div>
                <div class="arrows"></div>
            </div>
        </div>
    </section>