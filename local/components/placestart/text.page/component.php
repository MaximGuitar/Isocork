<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

    $arResult['ID'] = $arParams['ELEMENT_ID'];
    $arResult['IBLOCK_ID'] = $arParams['IBLOCK_ID'];
    $arResult['TITLE_PAGE'] = $arParams['TITLE_PAGE'];

    $this->IncludeComponentTemplate();
?>