<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

    if(!CModule::IncludeModule("iblock")) return;

    $arTypes = CIBlockParameters::GetIBlockTypes();

    $arIBlocks=array();
    $db_iblock = CIBlock::GetList(array("SORT"=>"ASC"), array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
    while($arRes = $db_iblock->Fetch())
        $arIBlocks[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];

    $arComponentParameters = array(
        "GROUPS" => array(),
        "PARAMETERS" => array(
            "IBLOCK_TYPE" => array(
                "PARENT" => "BASE",
                "NAME" => 'Тип информационного блока',
                "TYPE" => "LIST",
                "VALUES" => $arTypes,
                "DEFAULT" => "news",
                "REFRESH" => "Y",
            ),
            "IBLOCK_ID" => array(
                "PARENT" => "BASE",
                "NAME" => 'Код информационного блока',
                "TYPE" => "LIST",
                "VALUES" => $arIBlocks,
                "DEFAULT" => '',
                "ADDITIONAL_VALUES" => "Y",
                "REFRESH" => "Y",
            ),
            "ELEMENT_ID" => array(
                "PARENT" => "BASE",
                "NAME" => 'ID страницы',
                "TYPE" => "STRING",
                "DEFAULT" => '',
            )
        ),
    );
?>