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
    
    $filter = array(
        'IBLOCK_ID' => 10,
        'ACTIVE' => 'Y',
    );

    if($result['region']) {
        $filter["SECTION_ID"] = $result['region'];
    }

    $resultList = CIBlockElement::GetList([], $filter);
    $resultAns = $resultList->GetNext();?>
    <?if(!empty($resultAns)):?>
        <div class="contact-distributor">
            <p class="contact-distributor__item inter active" data-type="all">Все</p>
            <?
                $distributors = CIBlockPropertyEnum::GetList([],[
                    "IBLOCK_ID" => 10,
                    "CODE" => "MARKET_TYPE"
                ]);

                while ($distributor = $distributors->Fetch()){
                    echo '<p class="contact-distributor__item inter" data-type="' . $distributor["VALUE"] . '">' . $distributor["VALUE"] . '</p>';
                }
            ?>
        </div>
        <div class="contact-scrollbar scrollbar-rail contact-distributor__scrollbar">
            <? $pointerIndex = 0;
               
               $resultList = CIBlockElement::GetList(array(), $filter);
                while ($element = $resultList->GetNext()) { 
                    $arFilter = Array("ID"=>$element['ID']);
                    $result = CIBlockElement::GetList(Array(), $arFilter);
                    if ($ob = $result->GetNextElement()){;
                        $arProps = $ob->GetProperties();

                        $address = $arProps['MARKET_ADDRESS']['VALUE'];
                        $phone = $arProps['MARKET_PHONE']['VALUE'];
                        $email = $arProps['MARKET_EMAIL']['VALUE'];
                    } ?>
                    <div class="contact__address" data-mark="<?=$pointerIndex;?>"  data-id="<?= $element["ID"];?>" data-name="<?= $element["NAME"];?>" data-address="<?=$address;?>">
                        <h3 class="contact__title inter"><?= $element["NAME"];?></h3>
                        <div class="contact__info">
                            <?if($address) echo '<p class="contact__info-item inter">' . $address . '</p>';?>
                            <?if($phone) echo '<a href="tel:' . $phone . '" class="contact__info-item inter">' . $phone . '</a>';?>
                            <?if($email) echo '<a href="mailto: ' . $email . '" class="contact__info-item inter">' . $email . '</a>';?>
                        </div>
                    </div>
                    <? $pointerIndex++;
                }?>
        </div>
    <?else:?>
        <div class="contact-region__not-found">
            <p class="contact-region__not-found-title">
                <? 
                    $res = CIBlockSection::GetByID($result['region']);
                    if($ar_res = $res->GetNext())
                    echo $ar_res['NAME'];
                ?>
            </p>
            <p class="contact-region__not-found-text">Представитель не найден.<br/>Обратитесь в головной офис.</p>
        </div>
        <div class="contact-scrollbar scrollbar-rail contact-distributor__scrollbar">
            <?
                $res = CIBlockElement::GetList(array(), array(
                    'ACTIVE' => 'Y', 
                    'ID' => 58
                ));

                echo '<div class="contact-address">';
                while ($element = $res->GetNext()) { ?>
                    <h3><?= $element["NAME"];?></h3>
                    <?if($element["PREVIEW_TEXT"]): ?>
                        <div class="contact-text">
                            <?=htmlspecialcharsBack($element["PREVIEW_TEXT"]);?>
                        </div>
                    <?endif;
                }
                echo '</div>';
            ?>
        </div>
    <?endif;?>
<? endif;