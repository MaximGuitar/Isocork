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

    $arFilter = Array("IBLOCK_ID"=>10, "ID"=>$id);
    $res = CIBlockElement::GetList(Array(), $arFilter);
    if ($ob = $res->GetNextElement()){;
        $arProps = $ob->GetProperties();
        $arFields = $ob->GetFields();
   
        if(!empty($arProps["MARKET_TEXT_LEFT"]["VALUE"]["TEXT"])){
            $textLeft = $arProps["MARKET_TEXT_LEFT"]["VALUE"]["TEXT"];
        }

        if(!empty($arProps["MARKET_TEXT_RIGHT"]["VALUE"]["TEXT"])){
             $textRight = $arProps["MARKET_TEXT_RIGHT"]["VALUE"]["TEXT"];
         }
        
    }  ?>

    <h3 class="modal-contact__title"><?=$arFields["NAME"];?></h3>
    <div class="modal-contact__text">
        <?if($textLeft):?>
            <div class="modal-text"><?=htmlspecialcharsBack($textLeft)?></div>
        <?endif;?>
        <?if($textRight):?>
            <div class="modal-text"><?=htmlspecialcharsBack($textRight)?></div>
        <?endif;?>
    </div>
<?endif;?>