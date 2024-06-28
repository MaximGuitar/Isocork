<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обработка персональных данных");
?><?$APPLICATION->IncludeComponent(
	"placestart:text.page",
	"textPage",
	Array(
		"ELEMENT_ID" => "62",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "content"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>