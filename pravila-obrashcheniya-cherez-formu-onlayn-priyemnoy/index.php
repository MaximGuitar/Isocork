<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Правила обращения через форму онлайн-приёмной");
?><?$APPLICATION->IncludeComponent(
	"placestart:text.page",
	"textPage",
	Array(
		"ELEMENT_ID" => "61",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "content"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>