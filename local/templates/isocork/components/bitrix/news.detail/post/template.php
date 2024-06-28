<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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
global $APPLICATION;
$this->setFrameMode(true);
ob_start();
?>
<div class="page page--100">
    <div class="post-head">
        <div class="container">
            <!-- <div id="breadcrumbs" class="breadcrumbs--white">#INNER_BLOCK#</div> -->
            <div id="breadcrumbs" class="breadcrumbs--white">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "template.php",
                    array(
                        "COMPONENT_TEMPLATE" => "template.php",
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );
                ?>
            </div>
            <div class="post-head__text">
                <p class="post-head__date inter">
                    <?= $arResult["ACTIVE_FROM"]; ?>
                </p>
                <h1 class="page-title post-head__title">
                    <?= $arResult["NAME"] ?>
                </h1>
            </div>
            <div class="ya-share2 post-head__share" data-curtain data-shape="round" data-limit="0"
                data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,viber,whatsapp"></div>
        </div>
    </div>
    <? if ($arResult["DETAIL_PICTURE"]["SRC"]): ?>
        <div class="post-image-wrap container-news">

            <img class="post-image" src="<?= $arResult["DETAIL_PICTURE"]["SRC"]; ?>" alt="<?= $arResult["NAME"] ?>" />
        </div>
    <? endif; ?>

    <div class="content content-news">
        <? $content = $APPLICATION->IncludeComponent(
            "sprint.editor:blocks",
            "custom",
            array(
                "ELEMENT_ID" => $arResult["ID"],
                "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                "PROPERTY_CODE" => "CONTENT",
            ),
            $component,
            array(
                "HIDE_ICONS" => "Y"
            )
        ); ?>
    </div>
    <div class="post-more">
        <div class="container">
            <div class="post-more__container">
                <p class="post-more__title inter">СМОТРИТЕ ТАКЖЕ</p>

                <div class="post-more__slider-container">
                    <div class="keen-slider post-more__slider">
                        <?
                         $data = unserialize($_COOKIE["ViewedNews"]);
                        if($data){
                            array_push($data, $arResult['ID']);
                        }
                      
                     
                        $moreResult = CIBlockElement::GetList(
                            array("ACTIVE_FROM" => "DESC"),
                            array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "!=ID" => $data),
                            false,
                            array("nTopCount" => 6)
                        );

                        while ($arResultPost = $moreResult->GetNext()) { ?>
                            <a href="<?= $arResultPost["DETAIL_PAGE_URL"] ?>" class="keen-slider__slide post-more__post">
                                <? $image = $arResultPost["PREVIEW_PICTURE"] ? CFile::GetPath($arResultPost["PREVIEW_PICTURE"]) : SITE_TEMPLATE_PATH . "/static/images/pug.jpg"; ?>
                                <div class="post-more__post-image">
                                    <img src="<?= $image; ?>" alt="<?= $arResultPost['NAME']; ?>" />
                                </div>
                                <p class="post-more__post-date">
                                    <?
                                    echo date("d.m.Y", strtotime($arResultPost["ACTIVE_FROM"]));
                                    ?>
                                </p>
                                <h3 class="post-more__post-title">
                                    <?= $arResultPost['NAME']; ?>
                                </h3>
                            </a>
                        <? }
                        ?>
                    </div>
                    <div class="post-more__arrows"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://yastatic.net/share2/share.js"></script>
<?
$this->__component->SetResultCacheKeys(array("CACHED_TPL"));
$this->__component->arResult["CACHED_TPL"] = @ob_get_contents();
ob_get_clean();
?>