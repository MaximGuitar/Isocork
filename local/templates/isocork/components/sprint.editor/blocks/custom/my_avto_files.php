<? /** @var $block array */
$IDinfo = $block["IDinfo"];
$IDelement = $block["BlockNumber"]-1;
?>
<section class="section-files" id="section-files">
    <div class="container">
        <?if($title):?>
            <h2 class="section-title align-center m-90"><?=$title;?></h2>
        <?endif;?>

        <div class="section-files__grid">
                        <?
                        $arFilter = array(
                            'IBLOCK_ID' =>  $IDinfo, 
                            'ACTIVE' => 'Y',  // выборка только активных элементов
                        );
                        $counter = 0;
                        $res = CIBlockElement::GetList(array(), $arFilter);                   
                        while ($element = $res->GetNext()) {      
                            $db_props = CIBlockElement::GetProperty(
                                $IDinfo,
                                $element['ID'],
                                $arOrder = Array(),
                                $arFilter = Array("CODE"=>"CONTENT")
                            );
                            if($ar_props = $db_props->Fetch())
                            $CONTENTBloks= ($ar_props['VALUE']);            
                         ?>
                            <?
                                if($counter==$IDelement)
                                {   
                                    $decodeElem = json_decode($CONTENTBloks,true);
                                    foreach ($decodeElem['blocks'] as &$value) {
                                        if(in_array("my_files_content",$value))
                                        {
                                            foreach($value['files'] as $file)
                                            {
                                                $resArr = (reset($file));
                                                $fileName = $resArr['ORIGINAL_NAME'];
                                                $fileType = substr($fileName,strripos($fileName,'.')+1);
                                                $fileSize = CFile::FormatSize($resArr['FILE_SIZE']);
                                               
                                                ?> 
                                                    <a download="<?= $resArr['ORIGINAL_NAME'] ?>" title="<?= $item['desc'] ?>" href="<?= $resArr['SRC'] ?>" class="file__item">
                                                    <svg class="file__svg">
                                                        <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#file"></use>
                                                    </svg>
                                                    <span class="file__info inter"><?=$fileType;?> <?=$fileSize;?></span>
                                                    <span class="file__title inter">
                                                        <?=preg_replace('/\.\w+$/', '',  $fileName); ?>  
                                                    </span>
                                                    </a> 
                                                <?
                                            }
                                        }
                                    }   
                                 
                                }
                                $counter++
                           ;?>                        
 <? } ?> 
        </div>
    </div>                  
</section>


