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
    $arrPointerDistributor = [];
    if($result['word'] == '') {
        $region_sections = CIBlockSection::GetList (
            Array('name' => 'ASC'),
            Array("IBLOCK_ID" => 10, "ACTIVE" => "Y"),
            false,
            Array('ID', 'NAME', 'CODE')
        ); 
    } else {
        $region_sections = CIBlockSection::GetList (
            Array('name' => 'ASC'),
            Array("IBLOCK_ID" => 10, "ACTIVE" => "Y",
            "NAME"=> "%" . $result['word'] . "%"),
            false,
            Array('ID', 'NAME', 'CODE')
        ); 
    }?>

    <? while($region = $region_sections->GetNext()){?>
        <div class="contact-region__item inter" data-region="<?=$region['ID'];?>"><?=$region['NAME'];?></div>
    <? } ?>
<? endif;