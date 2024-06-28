<? /** @var $block array */
  use \Placestart\Utils;
?>

<section class="section-germetic-content">
        <div class="container">
        <?foreach($block["items"] as $arItem):?> 
            <div class="text-col">
                <h2 class="section-title"><?=$arItem['title'];?></h2>
                <?if($arItem['file']['ORIGIN_SRC']):?>
                    <?
                        $arImg = Utils::resizeImage($arItem['file']['ID'], 681, 1000,'proportional',90);
                    ?>  
                    <img src="<?=$arImg['src'];?>" alt="" class="germetic-img mobile">
                <?endif;?>
                <?if($arItem['text']):?>
                    <div class="content-text">    
                      <?=$arItem['text'];?>
                    </div>
                <?endif;?>
                <?if($arItem['button_text']):?>
                    <a href="<?=$block['file']['SRC'];?>" class="btn btn--transparent-dark file-download" download='<?=$block['file']['ORIGINAL_NAME'];?>'><?=$arItem['button_text'];?></a>
                <?endif;?>
            </div>
            <?if($arItem['file']['ORIGIN_SRC']):?>
                <div class="content-col">
                    <img src="<?=$arImg['src'];?>" alt="" class="germetic-img">
                </div>
            <?endif;?>
        <?endforeach;?>
        </div>
 </section> 

