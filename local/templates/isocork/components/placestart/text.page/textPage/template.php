<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die(); ?>
<?
CModule::IncludeModule("iblock");
$res = CIBlockElement::GetList(
    array(),
    array(
        'ID' => $arResult["ID"],
        'IBLOCK_ID' => $arResult["IBLOCK_ID"],
        'ACTIVE' => 'Y',
    )
);

$element = $res->GetNextElement();
$arProps = $element->GetProperties();
$btn1Text = $arProps['PAGE_BTN_TEXT']['VALUE'];
$title = $arProps["NAME"];
$subtitle = $arProps["PAGE_BANNER_TEXT"]["VALUE"];
$image = $arProps["PAGE_BANNER_IMAGE"]["VALUE"];
$type = $arProps["PAGE_SELECT_BANNER"]['VALUE_XML_ID'];
$VideoAndPhotoCodes = $arProps["PAGE_VIDEO_SLIDER"]["VALUE"];
$PhotoDuration = $arProps["PHOTO_DURATION"]["VALUE"];
$VideoDuration = $arProps["VIDEO_DURATION"]["VALUE"];
?>

<? if ($type == 'default1'): //база с картинкой заголовком и подзаголовком?>
    <section class="screen-banner" id="first-screen">
        <div class="screen-banner__image">
            <img src="<?= CFile::GetPath($image) ?>" alt="<?= $title ?>" />
        </div>

        <div class="container screen-banner__container">
            <div id="breadcrumbs" class="breadcrumbs--white">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "breadcrumbs",
                    array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );
                ?>
            </div>
            <?
            CModule::IncludeModule('iblock');
            $res = CIBlockElement::GetByID($arResult["ID"]);
            if ($ar_res = $res->GetNext())
                echo '<h1 class="screen-banner__title">' . $ar_res['NAME'] . '</h1>';
            ?>
            <? if ($subtitle): ?>
                <p class="screen-banner__text inter">
                    <?= htmlspecialcharsBack($subtitle); ?>
                </p>
            <? endif; ?>
            <div class="screen-banner__btn-wrap">
                <? if ($btn1Link): ?>
                    <a href="<?= $btn1Link ?>" class="screen-banner__btn btn btn--white">
                    <? else: ?>
                        <a href="/" data-modal data-type="feedback" class="screen-banner__btn btn btn--white">
                        <? endif; ?>
                        <? echo $btn1Text ? $btn1Text : 'Оставить заявку'; ?>
                    </a>

            </div>
        </div>

        <div class="main-screen__next">
            листай вниз
            <svg class='main-screen__next-arr'>
                <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-bottom'></use>
            </svg>
        </div>
    </section>
    </div>

<? endif; ?>


<? if ($type == 'default2' || $type == ''): //хлебные крошки и заголовок?>
    <div class="page">
        <div class="content">
            <div class="container">
                <div id="breadcrumb">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "breadcrumbs",
                        array(
                            "PATH" => "",
                            "SITE_ID" => "s1",
                            "START_FROM" => "0"
                        )
                    );
                    ?>
                </div>
                <?
                CModule::IncludeModule('iblock');
                $res = CIBlockElement::GetByID($arResult["ID"]);
                if ($ar_res = $res->GetNext())
                    echo '<h1 class="page-title">' . $ar_res['NAME'] . '</h1>';
                ?>
            </div>
        </div>
    </div>
<? endif; ?>

<?
$pattern = '/#(.*?)#/i';
$wrap = '<span>$1</span>';
$subtitle = preg_replace($pattern, $wrap, $subtitle);
?>
<? if ($type == 'about_us'): //только для страницы о нас?>
    <section class="about_us screen-banner" id="">
        <div class="white screen-banner__image">
            <img src="<?= CFile::GetPath($image) ?>" alt="<?= $title ?>" />
        </div>

        <div class="container screen-banner__container">
            <div id="breadcrumbs" class="green breadcrumbs--white">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "breadcrumbs",
                    array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );
                ?>
            </div>
            <div class="orange_line"></div>
            <svg class='about_svg'>
                <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/banner_logo.svg#ban_log'></use>
            </svg>
            <? if ($subtitle): ?>
                <p class="about_text inter">
                    <?= htmlspecialcharsBack($subtitle); ?>
                </p>
            <? endif; ?>
            <div class="screen-banner__btn-wrap">
                <? if ($btn1Link): ?>
                    <a href="<?= $btn1Link ?>" class="screen-banner__btn btn btn--white">
                    <? else: ?>
                        <a href="/" data-modal data-type="feedback" class="screen-banner__btn btn btn_green">
                        <? endif; ?>
                        <? echo $btn1Text ? $btn1Text : 'Оставить заявку'; ?>
                    </a>

            </div>
        </div>


    </section>
    </div>


<? endif; ?>



<? if ($type == 'video'): ?>
    <?php
    //Формируем массив фото и видео из кодов
    $VideoAndPhotoFiles = array();
    foreach ($VideoAndPhotoCodes as $Code) {
        $file = array(CFile::GetFileArray($Code));
        array_push($VideoAndPhotoFiles, $file);
    }
    ?>
    <section class="screen-banner" id="first-screen">
        <?php ?>
        <div class="swiper PhotoVideoSlider" id="VideoPhotoSlider">
            <div class="swiper-wrapper  PhotoVideoSlider__block">
                <? foreach ($VideoAndPhotoFiles as $MediaElement): ?>
                    <?php $format = explode("/", $MediaElement[0]["CONTENT_TYPE"])[0]; //получаем формат видео или пикча ?>
                    <div class="swiper-slide PhotoVideoSlider__slide" data-swiper-autoplay="<?if($format==="video"){echo $VideoDuration;}else{echo $PhotoDuration;} //если видео то 3000мс если видео то 15000?>">
                        <?php if ($format === "image"): ?>
                            <img src="<?= $MediaElement[0]["SRC"]; ?>" alt="" class="photo">
                        <? elseif ($format === "video"): ?>
                            <video src="<?= $MediaElement[0]["SRC"]; ?>" autoplay loop muted class="video"></video>
                        <? endif; ?>
                    </div>
                <? endforeach ?>
            </div>
        </div>


        <div class="container screen-banner__container">
            <div id="breadcrumbs" class="breadcrumbs--white">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "breadcrumbs",
                    array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );
                ?>
            </div>
            <?
            CModule::IncludeModule('iblock');
            $res = CIBlockElement::GetByID($arResult["ID"]);
            if ($ar_res = $res->GetNext())
                echo '<h1 class="screen-banner__title">' . $ar_res['NAME'] . '</h1>';
            ?>
            <? if ($subtitle): ?>
                <p class="screen-banner__text inter">
                    <?= htmlspecialcharsBack($subtitle); ?>
                </p>
            <? endif; ?>
            <div class="screen-banner__btn-wrap">
                <? if ($btn1Link): ?>
                    <a href="<?= $btn1Link ?>" class="screen-banner__btn btn btn--white">
                    <? else: ?>
                        <a href="/" data-modal data-type="feedback" class="screen-banner__btn btn btn--white">
                        <? endif; ?>
                        <? echo $btn1Text ? $btn1Text : 'Оставить заявку'; ?>
                    </a>

            </div>
        </div>

        <div class="main-screen__next">
            листай вниз
            <svg class='main-screen__next-arr'>
                <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-bottom'></use>
            </svg>
        </div>
    </section>
    </div>
<? endif; ?>


<? $APPLICATION->IncludeComponent(
    "sprint.editor:blocks",
    "custom",
    array(
        "ELEMENT_ID" => $arResult["ID"],
        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
        "PROPERTY_CODE" => "CONTENT",
    )
); ?>