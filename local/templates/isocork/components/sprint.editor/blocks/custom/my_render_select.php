<? /** @var $block array */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */
global $APPLICATION;?><?
$elements = Sprint\Editor\Blocks\IblockElements::getList(
    $block, []
);
?>

<?foreach($elements as $arItem):?>
	<?$APPLICATION->IncludeComponent(
		"sprint.editor:blocks", 
		"custom", 
		Array(
			"IBLOCK_ID" => $arItem['IBLOCK_ID'],
			"ELEMENT_ID" => $arItem['ID'],
			"PROPERTY_CODE" => "CONTENT",
		),
		false,
		Array()
	);?>
<? endforeach; ?>