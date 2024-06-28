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
if ($inputJSON !== null):
    $result = json_decode($inputJSON, TRUE);
    $idElement = $result["elementCount"];
    $blockElement = $result["blockElement"];
    $content = $result["content"];
    $arrIndex = 0;
    $IBlockID = $result["IdIblock"];
    $elemID = $result["IdElement"];
    $arSelect = array("ID", "NAME", "DETAIL_TEXT");
    $arFilter = array("IBLOCK_ID" => IntVal($IBlockID), "ID" => IntVal($elemID), "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
    } 
    ?>
    <div class="modal-just_text__container">
        <? if ($arFields): ?>
            <div class="modal-text modal-just_text__text">
                <?= $arFields['DETAIL_TEXT']; ?>
            </div>
        <? endif; ?>
    </div>
<? endif; ?>