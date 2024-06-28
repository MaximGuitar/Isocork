<? /** @var $block array */
?>

<section class="section-probkovaya-smes-content">
        <div class="container">
        <?foreach($block["items"] as $arItem):?> 
            <h2 class="section-title"><?=$arItem['title'];?></h2>
            <div class="main-content">
            <div class="text-col">           
                <?if($arItem['file']['ORIGIN_SRC']):?>
                    <img src="<?=$arItem['file']['ORIGIN_SRC'];?>" alt="" class="germetic-img mobile">
                <?endif;?>
                <?if($arItem['text']):?>
                    <div class="content-text">    
                      <?=$arItem['text'];?>
                    </div>
                <?endif;?>
       
            </div>
            <?if($arItem['file']['ORIGIN_SRC']):?>
                <div class="content-col">
                    <img src="<?=$arItem['file']['ORIGIN_SRC'];?>" alt="" class="germetic-img">
                </div>
            <?endif;?>
        </div>
        <?endforeach;?>
        </div>
 </section> 

