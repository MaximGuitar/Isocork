<? /** @var $block array */
$IDinfo = $block["IDinfo"];
?>
<section class="section-yearscontent">
        <div class="container">
            <div class="header_block">
                <div class="orange_top_line">
                </div>
                <div class="osnova">
                    Основание ООО «Русская пробка»
                </div>             
                <div class="year_text">2010</div>
                <div class="mob orange_block">
                    <div class="footer_line"></div>
                    <div class="orange_circle"></div>
                </div>
            </div>
                 <div class="about-storyline storyline" id="storyline">
                <div class="storyline__line" style="--translate: 0%" data-line></div>
                    <?
                        $counter = 0;
                        $arFilter = array(
                            'IBLOCK_ID' => $IDinfo, 
                            'ACTIVE' => 'Y',  // выборка только активных элементов
                        );
                        $res = CIBlockElement::GetList(array(), $arFilter);                                 
                        while ($element = $res->GetNext()) {           
                            $counter++;               
                            $db_props = CIBlockElement::GetProperty(
                                $IDinfo,
                                $element['EXTERNAL_ID'],
                                $arOrder = Array(),
                                $arFilter = Array("CODE"=>"YEAR")
                            );
                            if($ar_props = $db_props->Fetch())
                            $YEAR= IntVal($ar_props["VALUE"]);
                         ?>
                <div class="storyline__part" data-part>                           
                    <div class="first_info storyline__entered_content_first">
                        <?if ($counter%2==0 & $YEAR!=0): ?>
                            <div class="year_text_left year_text"><?=$YEAR;?></div>
                        <? endif; ?>
                            <?=($element['PREVIEW_TEXT']);?>
                    </div>
                    <div class="storyline__romb" data-point></div>
                    <div class="second_info storyline__desc">         
                        <div class="storyline__entered_content_first">
                        <?if ($counter%2!=0 & $YEAR!=0): ?>
                        <div class="year_text_right year_text"><?=$YEAR;?></div>
                        <?endif; ?>
                            <?=($element['DETAIL_TEXT']); ?>
                        </div>
                     </div>
                </div>
            <? } ?> 
            </div>
            <div class="footer_block">
            <div class="orange_block">
                <div class="footer_line"></div>
                <div class="orange_circle"> </div>
            </div>
        Стремимся к новым горизонтам развития!
        </div>
        </div>
        </div>
 </section> 

