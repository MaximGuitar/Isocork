<?if($arResult["NavPageCount"] > 1):?>
    <?if ($arResult["NavPageNomer"]+1 <= $arResult["nEndPage"]):?>
        <?
            $plus = $arResult["NavPageNomer"]+1;
            $url = $arResult["sUrlPathParams"] . "PAGEN_1=" . $plus
        ?>
        <div class="section-news__link-container load_more" data-url="<?=$url?>">
			<a href="javascript:void(0);" class="section-news__link btn btn--transparent-dark">
				<svg class='btn__arrow btn__arrow--bottom'>
					<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right'></use>
				</svg>
				Показать еще
			</a>
		</div>
    <?endif?>
<?endif?>