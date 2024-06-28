<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var $this SprintEditorBlocksComponent */
/** @var CBitrixComponent $component */
global $APPLICATION;
$this->setFrameMode(true);

use Placestart\Utils;
use PHPInterface\ComponentHelper;


$helper = new PHPInterface\ComponentHelper($component);
?>
<?
    $title = $arResult["NAME"];
    $subtitle = $arResult["DISPLAY_PROPERTIES"]["PRODUCT_BANNER_TEXT"]["VALUE"];
    $image = $arResult["DISPLAY_PROPERTIES"]["PRODUCT_BANNER_IMAGE"]["FILE_VALUE"]["SRC"];

    $res = CIBlockElement::GetList(array(), array(
        'ID' => $arResult["ID"],
        'IBLOCK_ID' => 1,
        'ACTIVE' => 'Y', 
    ));
    
    $element = $res->GetNextElement();
    $arProps = $element->GetProperties();

    $btn1Text = $arProps['PRODUCT_BTN1_TEXT']['VALUE'];
    $btn1Link = $arProps['PRODUCT_BTN1_LINK']['VALUE'];

    $btn2Text = $arProps['PRODUCT_BTN2_TEXT']['VALUE'];
    $btn2Link = $arProps['PRODUCT_BTN2_LINK']['VALUE'];

    $bannerType = $arProps['PRODUCT_BANNER_TYPE']['VALUE_XML_ID'];
    $bannerSlider = $arProps['PRODUCT_BANNER_SLIDES']['VALUE'];
    $PhotoDuration = $arProps["PHOTO_DURATION"]["VALUE"];
    $VideoDuration = $arProps["VIDEO_DURATION"]["VALUE"];
?>

<? if($image || $bannerSlider): ?>
    <?if($bannerType == 'STATIC'|| $bannerType == 'DEVMODE'):?>
        <section class="screen-banner" <?if($bannerType == 'DEVMODE')echo 'style="margin-bottom:0;"'?> id="first-screen">
            <div class="screen-banner__image">
                <img src="<?=$image?>" alt="<?=$title?>"/>
            </div>

            <div class="container screen-banner__container">
                <div id="breadcrumbs" class="breadcrumbs--white">
                    <?php $helper->deferredCall('Placestart\Utils::ShowNavChain', ['breadcrumbs']); ?>
                </div>
                
                <h1 class="screen-banner__title"><?=htmlspecialcharsBack($title)?></h1>
                <?if($subtitle): ?>
                    <p class="screen-banner__text inter"><?=htmlspecialcharsBack($subtitle);?></p>
                <?endif;?>
                <div class="screen-banner__btn-wrap">
                    <? if($bannerType == 'DEVMODE'):?>
                        <div class="banner_form">
                            <div class="">
                                <form action="" class="inputs" data-form>
                                <input type="hidden" name="form-id" value="form-callback"> 

                                <div class="form-elem modal-feedback__form-elem">
                                    <input type="tel" name="tel" class="form-input form-input--white" placeholder="Телефон" value="">
                                    <p class="form-placeholder form-placeholder--white">Телефон*</p>
                                </div>
                    
                                <button data-submit-btn="" class="banner_btn contact-form__btn modal-feedback__btn btn btn--filled btn--inline">
                                    <svg class="btn__arrow">
                                        <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right"></use>
                                    </svg>
                                    Отправить запрос
                                </button>
                            </div>
                            <p class="personal modal-feedback__personal">
                                Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/" class="personal__link">на&nbsp;обработку персональных данных</a>
                            </p>
                        </div>
					</form>



                     
                    <?endif;?>
                    <? if($bannerType == 'STATIC'):?>
                    <?if($btn1Link):?>
                        <a href="<?=$btn1Link?>" class="screen-banner__btn btn btn--white">
                    <?else:?>
                        <a href="/" data-modal data-type="feedback" class="screen-banner__btn btn btn--white">
                    <?endif;?>
                        <? if($bannerType == 'STATIC')
                        {
                            echo $btn1Text ? $btn1Text : 'Оставить заявку'; 
                        }
                        ?>
                    </a>
                    <?if($bannerType == 'STATIC'):?>
                        <a href="#specification" class="screen-banner__btn btn btn--transparent">Технические характеристики</a>
                    <?endif;?>
                    <?endif;?>
                </div>
            </div>
            <?if($bannerType == 'STATIC'):?>
                <div class="main-screen__next">
                    листай вниз
                    <svg class='main-screen__next-arr'>
                        <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-bottom'></use>
                    </svg>
                </div>
            <?endif;?>
        </section>
    <?endif;?>
    <?if($bannerType == 'SLIDER'):?>
        <section class="screen-banner screen-banner--slider" id="first-screen">         
            <?php
            //Формируем массив фото и видео из кодов
            $bannerSliderVideoAndPhotoFiles = array();
            foreach ($bannerSlider as $Code) {
                $file = array(CFile::GetFileArray($Code));
                array_push($bannerSliderVideoAndPhotoFiles, $file);
            }
            ?>
            <div class="screen-banner__slider-wrap">
                <div class="swiper screen-banner__slider" id="screen-slider">
                    <div class="swiper-wrapper">
                        <? foreach ($bannerSliderVideoAndPhotoFiles as $slide): ?>
                            <?php $format = explode("/", $slide[0]["CONTENT_TYPE"])[0]; //получаем формат видео или пикча
                                if($format==="video")
                                {
                                    $CurrentDuration =  $VideoDuration;
                                }
                                else{
                                    $CurrentDuration =  $PhotoDuration;
                                } //если видео то 3000мс если видео то 15000
                            ?>
                            <div class="swiper-slide screen-banner__slide" data-swiper-autoplay="<?=$CurrentDuration?>" >
                                <?php if ($format === "image"): ?>
                                    <img src="<?= $slide[0]["SRC"]; ?>" alt="" class="photo">
                                <? elseif ($format === "video"): ?>
                                    <video src="<?= $slide[0]["SRC"]; ?>" autoplay muted loop class="video"></video>
                                <? endif; ?>
                            </div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>

            <div class="container screen-banner__container">
                <div id="breadcrumbs" class="breadcrumbs--white">
                    <?php $helper->deferredCall('Placestart\Utils::ShowNavChain', ['breadcrumbs']); ?>
                </div>
                
                <div class="screen-banner__content">
                    <?if($subtitle): ?>
                        <h1 class="screen-banner__title"><?=htmlspecialcharsBack($subtitle);?></h1>
                    <?else:?>
                        <h1 class="screen-banner__title"><?=htmlspecialcharsBack($title);?></h1>
                    <?endif;?>
                    <div class="screen-banner__btn-wrap">
                        <?if($btn1Link):?>
                            <a href="<?=$btn1Link?>" class="screen-banner__btn btn btn--white">
                        <?else:?>
                            <a href="/" data-modal data-type="feedback" class="screen-banner__btn btn btn--white">
                        <?endif;?>
                            <? echo $btn1Text ? $btn1Text : 'Оставить заявку'; ?>
                        </a>

                        <?if($btn2Link && $btn2Text):?>
                            <a href="<?=$btn2Link?>" class="screen-banner__btn btn btn--transparent"><?=$btn2Text;?></a>
                        <?endif;?>
                    </div>

                    <div class="swiper-pagination screen-banner__slider-pagination"></div>
                </div>
            </div>
        </section>
    <?endif;?>

<?else: ?>
    <div class="page">
        <div class="container">
            <div id="breadcrumbs">
                <?php $helper->deferredCall('Placestart\Utils::ShowNavChain', ['breadcrumbs']); ?>
            </div>
            <h1 class="page-title"><?=$arResult["NAME"]?></h1>
        </div>
    </div>
<? endif; ?>

<div class="content">
    <?$APPLICATION->IncludeComponent(
        "sprint.editor:blocks",
        "custom",
        Array(
            "ELEMENT_ID" => $arResult["ID"],
            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
            "PROPERTY_CODE" => "CONTENT",
        ),
    );
    ?>
</div>
<?php $helper->saveCache(); ?>