<? /** @var $block array */

$title = $block["title"];
$subtitle = $block["subtitle"];
$summ100 = $block["summ100"];
$pogonnie_metry = $block["pogonnie_metry"];
?>

<section class="economic_benefit" >

        <div class="container">
            <?if($title):?>
                <h2 class="section-title benefit_title "><?=$title;?></h2>
            <?endif;?>
            <?if($subtitle):?>
                <p class="section-subtitle section-equipment__subtitle inter"><?=$subtitle;?></p>
            <?endif;?>
    
            <?if(count($block["items"]) > 1):?>         
                 <?foreach($block["items"] as $arItem):?>                          
                    <div class="benefitDiagramm">
                        <div class="Material_name">
                        <?if($arItem["MaterialName"]):?>
                            <div class=" inter"><?=$arItem["MaterialName"];?></div>
                        <?endif;?>
                        </div>
                        <div class="MainLines" >
                        <div class="PriceLines" style="width: <?=(ceil(($arItem["priceMaterial"]+$arItem["priceWork"])/(int)($summ100/100)));?>%">
                                <div class="MaterialPriceLine" style="width: <?=(100*($arItem["priceMaterial"]/($arItem["priceMaterial"]+$arItem["priceWork"])))?>%">
                                    <?if($arItem["priceMaterial"]):?>
                                            <div class="inter">
                                                <?=number_format($arItem["priceMaterial"], 0, ',', ' ');?>
                                            </div>
                                    <?endif;?>
                                <img class="benefit_img" src="<?= SITE_TEMPLATE_PATH ?>/static/images/info-icon.svg"> 
                                <div class="material_info">
                                             <?=$pogonnie_metry?>м.п. х 100 руб/п.м. х 2 стороны = <?=number_format($arItem["priceMaterial"], 0, ',', ' ');?> руб
                                 </div>
                                     
                                </div>
                                        
                             
                               
                                <div class="WorkPriceLine"  style="width: <?=(100*($arItem["priceWork"]/($arItem["priceMaterial"]+$arItem["priceWork"])))?>%">
                                <?if($arItem["priceWork"]):?>
                                    <div class=" inter"><?=number_format($arItem["priceWork"], 0, ',', ' ');?></div>
                                <?endif;?>  
                                <img class="benefit_img" src="<?= SITE_TEMPLATE_PATH ?>/static/images/info-icon.svg">
                                <div class="material_info">
                                             <?=$pogonnie_metry?>м.п. х 100 руб/п.м. х 2 стороны = <?=number_format($arItem["priceWork"], 0, ',', ' ');?> руб
                                 </div>
                        </div> 
                        </div>
                                                                  
                    </div>
                    <div class="inter FinalPrice">
                    <?=number_format($arItem["priceWork"]+$arItem["priceMaterial"], 0, ',', ' ');?>
                    </div>              
                </div>                 
                <?endforeach;?>     
                        <div class="info_block">
                <p class="pogonaj">Общий погонаж дома - <?=$pogonnie_metry?> п.м.
                    Диаметр шва 10х10(мм). </p>
                    <div class="cubes">
                        <div class="cube">                      
                            <div class="green_cube"></div><p>Стоимость материала, ₽ </p>
                        </div>
                        <div class="cube">                      
                            <div class="orange_cube"></div><p>Стоимость работ, ₽</p>
                        </div>
                        
                       
                    </div>                  
            <?endif;?>   
</section>