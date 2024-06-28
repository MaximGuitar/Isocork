<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Политика конфиденциальности");
?><?$APPLICATION->IncludeComponent(
	"placestart:text.page",
	"textPage",
	Array(
		"ELEMENT_ID" => "60",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "content"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>