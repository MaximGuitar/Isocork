<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пробка");
?><?$APPLICATION->IncludeComponent(
	"placestart:text.page",
	"textPage",
	Array(
		"ELEMENT_ID" => "63",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "content"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>