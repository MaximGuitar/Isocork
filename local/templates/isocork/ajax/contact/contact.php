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
    
    $id = $result["cityId"];
    $res = CIBlockElement::GetList(array(), array(
        'SECTION_ID' => $id,
        'ACTIVE' => 'Y', 
    ));
    
    echo '<div class="contact-address">';
    while ($element = $res->GetNext()) { ?>
        <h3><?= $element["NAME"];?></h3>
        <?if($element["PREVIEW_TEXT"]):?>
            <div class="contact-text"><?=$element["PREVIEW_TEXT"];?></div>
        <?endif;
    }
    echo '</div>';
endif;