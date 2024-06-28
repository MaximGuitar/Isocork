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
    
    $idElement = $result["elementCount"];
    $idSlide = $result["SlideCount"];
    $blockElement = $result["blockElement"];
    $content = $result["content"];
    $arrIndex = 0;
   
    foreach ($content as $key=>$value) {
       
       if($value["name"] == $blockElement) {
        $arrIndex = $key;  
        break;
       }
    }
    $arrElement = $content[$arrIndex]['items'][$idElement];
?>

<div class="modal-order_tabs__container">
    <?if($arrElement['blocks'][0]['items'][$idSlide]['text']):?>
        <div class="modal-text modal-order_tabs__text"><?=$arrElement['blocks'][0]['items'][$idSlide]['text'];?></div>
    <?endif;?>
</div>
<?endif;?>