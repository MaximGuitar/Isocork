<? /** @var $block array */
$i = 0;
?>
<section class="section_circle_diagram inter">
        <div class="container">
            <div class="circle_title">
                 <?=$block["title"];?>
            </div>   
            <div class="main_block">        
                <div class="content_circle"> 
                    <?foreach($block["items"] as $arItem):?> 
                    <a href="#circle<?=$i;?>" class="button_circle" data-tab-diagramm data-tab-id="tab-<?=$i; ?>">
                        <?if($arItem["desc"]):?>
                            <p><?=$arItem["desc"];?></p>
                        <?endif;?>
                        </a>       
                    <?$i++; endforeach;?>  
                </div>
                <?$i = 0; foreach($block["items"] as $arItem):?> 
                    <div class="diagram_circle" id="circle<?=$i; ?>" data-tab-item="tab-<?=$i;?>">
                        <div class="main_diagram">
                        <img src="<?=$arItem["file"]["ORIGIN_SRC"];?>" alt="" class="img">
                        <div class="content_diagram">
                            <div class="procent_text">
                                <?if($arItem["procent"]):?>
                                    <p><?=$arItem["procent"];?>%</p>
                                <?endif;?>   
                            </div>
                        <div class="content_text">
                            <?if($arItem["desc1"]):?>
                                <p><?=$arItem["desc1"];?></p>
                            <?endif;?>
                        </div>
                        </div>
                    
                    </div>
                    <div class="content_text_mobile">
                            <?if($arItem["desc1"]):?>
                                <p><?=$arItem["desc1"];?></p>
                            <?endif;?>
                        </div>
                </div>
             <?$i++; endforeach;?>  
        </div>        
</section>
                    