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

    foreach ($content as $key => $value) {

        if ($value["name"] == $blockElement) {
            $arrIndex = $key;
            break;
        }
    }
    $arrElement = $content[$arrIndex]['items'][$idElement];


    ?>

    <div class="modal-just_text__container">
        <? if ($arrElement['text']): ?>
            <div class="modal-text modal-just_text__text">
                <?= $arrElement['text']; ?>
            </div>
        <? endif; ?>
    </div>
<? endif; ?>