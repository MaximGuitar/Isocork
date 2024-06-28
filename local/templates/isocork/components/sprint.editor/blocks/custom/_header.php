<?php /**
 * Подключается перед выводом всех блоков
 *
 * @var $this     SprintEditorBlocksComponent
 * @var $blocks   array - массив со всеми блоками, можно модифицировать
 * @var $arParams array - массив с параметрами компонента
 */



$json_str = json_encode($blocks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); 
?>
<script>
    if(!window.content)
    {
        window.content = <?php echo $json_str; ?>;
    }
</script>