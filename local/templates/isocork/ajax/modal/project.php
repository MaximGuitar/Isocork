<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

CModule::IncludeModule('iblock'); 

$inputJSON = file_get_contents('php://input');
if($inputJSON !== null):
    $result = json_decode($inputJSON, TRUE);
    
    $id = $result["id"];

    $arFilter = Array("IBLOCK_ID"=>8, "ID"=>$id);
    $res = CIBlockElement::GetList(Array(), $arFilter);
    if ($ob = $res->GetNextElement()){;
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $gallery = $arProps["PROJECT_GALLERY"]["VALUE"];
    }  ?>

    <div class="project-container">
        <?if($gallery):?> 
            <div class="project-slider">
                <div id="project-slider-origin" class="keen-slider project-slider-origin">
                    <?for ($i = 0; $i < count($gallery); $i++):?>
                        <a href="<?=CFile::GetPath($gallery[$i])?>" class="keen-slider__slide number-slide<?=$i;?> project-slide-origin" data-fancybox="gallery" data-options='{"touch" : false, "backFocus" : false}'>
                            <img src="<?=CFile::GetPath($gallery[$i])?>" alt="<?=$arFields["NAME"]?>" class="project-slide-origin__image"/>
                        </a>
                    <?endfor;?>
                </div>
                <div id="project-slider-thumbnails" class="keen-slider thumbnail project-slider-thumbnails">
                    <?for ($i = 0; $i < count($gallery); $i++):?>
                        <div class="keen-slider__slide number-slide<?=$i;?> project-slide-thumbnails">
                            <img src="<?=CFile::GetPath($gallery[$i])?>" class="project-slide-thumbnails__image"/>
                        </div>
                    <?endfor;?>
                </div>
            </div>
        <?endif;?>
        <div class="project-content">
            <?$title = $arProps["PROJECT_DISPLAY_NAME"]["VALUE"] ? $arProps["PROJECT_DISPLAY_NAME"]["VALUE"] : $arFields["NAME"]; ?>
            <h3 class="project-content__title"><?=$title;?></h3>
            <?if($arProps["PROJECT_CITY"]["VALUE"]):?>
                <p class="project-content__subtitle inter">(г.<?=$arProps["PROJECT_CITY"]["VALUE"];?>)</p>
            <?endif;?>
            <?if($arFields["DETAIL_TEXT"]):?>
                <div class="project-content__text modal-text"><?=$arFields["DETAIL_TEXT"];?></div>
            <?endif;?>
            <?if($arProps["PROJECT_PRICE"]["VALUE"]):?>
                <p class="project-content__price inter">Цена: <?=$arProps["PROJECT_PRICE"]["VALUE"];?> ₽</p>
            <?endif;?>
        </div>
    </div>
<?endif;?>