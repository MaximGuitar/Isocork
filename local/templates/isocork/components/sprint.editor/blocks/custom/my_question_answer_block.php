<? /** @var $block array */
?>
<section class="section-accordion-pages" id="section-accordion">
    <div class="container">
        <? if ($block['title']): ?>
            <h2 class="section-title--87">
                <?= $block['title']; ?>
            </h2>
        <? endif; ?>
        <? if ($subtitle): ?>
            <div class="modal-text section-subtitle">
                <?= $subtitle; ?>
            </div>
        <? endif; ?>
        <div class="section-accordion-pages__wrap">
            <? foreach ($block["items"] as $arItem): ?>
                <div class="accordion__item " data-accordeon="">
                    <div class="accordion__top" data-accordeon-toggle="">
                        <p class="accordion__title inter">
                            <? if ($arItem['desc'])
                                echo $arItem['desc']; ?>
                        </p>
                        <svg class="accordion__title-svg">
                            <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-down"></use>
                        </svg>
                    </div>
                    <div class="collapse is-collapsed" data-accordeon-collapse="">
                        <div class="accordion__content">
                          <?= $arItem["text"] ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>