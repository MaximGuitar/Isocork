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
    <div class="modal-seo__container <?= $arrElement['modalImage'] ? '' : 'modal-seo__container--no-image' ?>">
        <? if ($arrElement['modalImage']!=""): ?>
            <? if ($arrElement['modalImage']['ORIGIN_SRC']): ?>
                <div class="modal-seo__image-wrap">
                    <img src="<?= $arrElement['modalImage']['ORIGIN_SRC'] ?>" alt="<?= $arrElement['desc'] ?>">
                </div>
            <? endif; ?>
        <? endif; ?>
        <? if ($arrElement['modalText']): ?>
            <? if ($arrElement['modalText'] != "<p><br></p>"): ?>
                <div class="modal-text modal-seo__text">
                    <?= $arrElement['modalText']; ?>
                </div>
            <? endif; ?>
        <? endif; ?>
    </div>
<? endif; ?>