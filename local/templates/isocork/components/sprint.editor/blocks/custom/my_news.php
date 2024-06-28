<? /** @var $block array */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$title = $block["title"];
$iblock = $block["iblock_id"];
$sectionId = $block["section_ids"];
?>

<section class="section-news section-slider-news" id="section-news">
	<div class="container">
        <?if($title):?>
		    <h2 class="section-title m-70"><?=$title;?></h2>
        <?else:?>
            <h2 class="section-title m-70">Новости</h2>
        <?endif;?>
		<div class="keen-slider">
            
            <?if($sectionId): 
                $arFilter = Array("IBLOCK_ID"=>$iblock, "SECTION_ID"=>$sectionId, "ACTIVE" => "Y");?>
            <?else:?>

                <?
                // $my_sections = CIBlockSection::GetList (
                //     Array(),
                //     Array("IBLOCK_ID" => $iblock, "ACTIVE" => "Y"),
                //     false,
                //     Array('ID')
                // );

                // $arrSection = [0];

                // while($ar_fields = $my_sections->GetNext()) {
                //     array_push($arrSection, $ar_fields['ID']);
                // }
                
                $arFilter = Array("IBLOCK_ID"=>$iblock);?>
            <?endif;?>
            <?
                $res = CIBlockElement::GetList(Array("ACTIVE_FROM" => "DESC"), $arFilter, false, Array ("nTopCount" => 6));

                while($ob = $res->GetNextElement())
                {
                    $arFields = $ob->GetFields();
                
                    $date = $arFields["DATE_CREATE"];
                    $title = $arFields["NAME"];
                    $text = $arFields["PREVIEW_TEXT"];
                    $url = $arFields["DETAIL_PAGE_URL"];
                    $image = $arFields["PREVIEW_PICTURE"] ? CFile::GetPath($arFields["PREVIEW_PICTURE"]) : SITE_TEMPLATE_PATH . "/static/images/pug.jpg";
                    ?>

                    <div class="keen-slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="post-card">
                            <div class="post-card__img-wrap">
                                <img src="<?=$image;?>" alt="<?=$title;?>" class="post-card__img">
                            </div>
                            <?if($date):?>
                                <p class="post-card__date inter"><?echo date("d.m.Y", strtotime($date));?>
                                </p>
                            <?endif?>
                            <?if($title):?>
                                <p class="post-card__title">
                                    <a href="<?=$url?>" class="link-cover"><?=$title?></a>
                                </p>
                            <?endif;?>
                            <?if($text):?>
                                <p class="post-card__desc inter"><?=htmlspecialcharsBack($text);?></p>
                            <?endif;?>
                        </div>
                    </div> 
                <?}
            ?>
		</div>
		<div class="section-news__arrows"></div>
		<div class="section-news__link-container">
			<a href="/novosti/" class="section-news__link btn btn--transparent-dark">
				<svg class='btn__arrow'>
					<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
				</svg>
				Все новости
			</a>
		</div>
	</div>
</section>