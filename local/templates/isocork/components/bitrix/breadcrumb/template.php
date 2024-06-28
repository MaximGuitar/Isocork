<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

ob_start();
?>
<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
    <li itemscope itemtype="http://schema.org/ListItem">
        <a href="/">Главная</a>
        <meta itemprop="position" content="1"/>
        —
    </li>
    <?php
        $itemSize = count($arResult);
        for($index = 0; $index < $itemSize; $index++):
            $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    ?>
        <?php if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1): ?>
            <li itemscope itemtype="http://schema.org/ListItem">
                <a href="<?= $arResult[$index]["LINK"] ?>" itemprop="name"><?= $title ?></a>
                <meta itemprop="position" content="<?= $index + 2 ?>" />
                —
            </li>
        <?php else: ?>
            <li itemscope itemtype="http://schema.org/ListItem">
                <span itemprop="name"><?= $title ?></span>
                <meta itemprop="position" content="<?= $index + 2 ?>" />
            </li>
        <?php endif ?>
    <?php endfor; ?>
</ul>

<?php

$strReturn = ob_get_contents();
ob_end_clean();


return $strReturn;