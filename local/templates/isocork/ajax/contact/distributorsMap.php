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

    $filter = array(
        'IBLOCK_ID' => 10,
        'ACTIVE' => 'Y', 
    );

    if($result['type'] != 'all') {
        $filter["=PROPERTY_42_VALUE"] = $result['type'];
    }

    if($result['region']) {
        $filter["SECTION_ID"] = $result['region'];
    }

    $pointerIndex = 0; 
    $res = CIBlockElement::GetList(array(), $filter);
    ?>

    <?if(!empty($res->GetNext())):
        $res = CIBlockElement::GetList(array(), $filter);?>
        <?while ($element = $res->GetNext()) { 
            $arFilter = Array("ID"=>$element['ID']);
            $result = CIBlockElement::GetList(Array(), $arFilter);
            if ($ob = $result->GetNextElement()){;
                $arProps = $ob->GetProperties();
                $point = $arProps['MARKET_MAP']['VALUE'];

                $position_in_map = explode(',', $point); 
                echo '<div class="markers" data-lat="' . $position_in_map[0] . '" data-lng="' . $position_in_map[1] . '"></div>';
            } ?>
        
        <? } ?>
    <?else:
        $res = CIBlockElement::GetList(array(), array(
            'ACTIVE' => 'Y', 
            'ID' => 58
        ));
    
        while ($ob = $res->GetNextElement()) { 
            $arProps = $ob->GetProperties();
            $point = $arProps['MAP_POINT']['VALUE'];

            if($point) {
                $position_in_map = explode(',', $point); 
                echo '<div class="markers" data-lat="' . $position_in_map[0] . '" data-lng="' . $position_in_map[1] . '"></div>';
            }
        }
        ?>
    <?endif;?>
<? endif;