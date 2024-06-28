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

    $res = CIBlockElement::GetList(array(), $filter);

    $pointerIndex = 0;
    while ($element = $res->GetNext()) { 
        $arFilter = Array("ID"=>$element['ID']);
        $result = CIBlockElement::GetList(Array(), $arFilter);
        if ($ob = $result->GetNextElement()){;
            $arProps = $ob->GetProperties();
            $point = $arProps['MARKET_MAP']['VALUE'];

            $address = $arProps['MARKET_ADDRESS']['VALUE'];
            $phone = $arProps['MARKET_PHONE']['VALUE'];
            $email = $arProps['MARKET_EMAIL']['VALUE'];
            if($point) {
                array_push($arrPointerDistributor, $point);
            }
        } ?>
        <div class="contact__address" data-mark="<?=$pointerIndex;?>" data-id="<?= $element["ID"];?>" data-name="<?= $element["NAME"];?>" data-address="<?=$address;?>">
            <h3 class="contact__title inter"><?= $element["NAME"];?></h3>
            <div class="contact__info">
                <?if($address) echo '<p class="contact__info-item inter">' . $address . '</p>';?>
                <?if($phone) echo '<a href="tel:' . $phone . '" class="contact__info-item inter">' . $phone . '</a>';?>
                <?if($email) echo '<a href="mailto: ' . $email . '" class="contact__info-item inter">' . $email . '</a>';?>
            </div>
        </div>
        <? $pointerIndex++;
     }
endif;