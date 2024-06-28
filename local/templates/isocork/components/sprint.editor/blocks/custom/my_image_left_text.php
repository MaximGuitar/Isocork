<? /** @var $block array */
?>

<section class="section-left-image-content">
        <div class="container">
        <?foreach($block["items"] as $arItem):?> 
            <?if($arItem['file']['ORIGIN_SRC']):?>

            <img src="<?=$arItem['file']['ORIGIN_SRC'];?>" alt="" class="germetic-img">
              
            <?endif;?>
            <div class="text-col">
                <?if($arItem['text']):?>
                    <div class="content-text">    
                      <?=$arItem['text'];?>
                    </div>
                <?endif;?>
             
            </div>
           
        <?endforeach;?>
        </div>
 </section> 

