<? /** @var $block array */

$title = $block["title"];
$subtitle = $block["value"];
?>
<section class="section-accordion" id="section-accordion">
    <div class="container">
        <? if ($title): ?>
            <h2 class="section-title--87">
                <?= $title; ?>
            </h2>
        <? endif; ?>
        <? if ($subtitle): ?>
            <div class="modal-text section-subtitle">
                <?= $subtitle; ?>
            </div>
        <? endif; ?>
        <div class="section-accordion__wrap">
            <? foreach ($block["items"] as $arItem): ?>
                <div class="accordion__item " data-accordeon="">
                    <div class="accordion__top" data-accordeon-toggle="">
                        <p class="accordion__title inter">
                            <? if ($arItem['title'])
                                echo $arItem['title']; ?>
                        </p>
                        <svg class="accordion__title-svg">
                            <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-down"></use>
                        </svg>
                    </div>
                    <div class="collapse is-collapsed" data-accordeon-collapse="">
                        <div class="accordion__content">
                            <?
                            foreach ($arItem['blocks'] as $itemblock):
                                if ($itemblock['name'] == 'my_text'): ?>
                                    <div class="modal-text">
                                        <?= Sprint\Editor\Blocks\Text::getValue($itemblock) ?>
                                    </div>
                                <? elseif ($itemblock['name'] == 'files' || $itemblock['name'] == 'my_files'): ?>
                                    <? if (!empty($itemblock['files'])): ?>
                                        <div class="file__wrap">
                                            <? foreach ($itemblock['files'] as $item):
                                                $arFile = CFile::GetFileArray($item['file']['ID']);
                                                $fileName = $arFile['ORIGINAL_NAME'];
                                                $fileType = substr($fileName, strripos($fileName, '.') + 1);
                                                $fileSize = CFile::FormatSize($arFile['FILE_SIZE']);
                                                ?>
                                                <a download="<?= $item['file']['ORIGINAL_NAME'] ?>" title="<?= $item['desc'] ?>"
                                                    href="<?= $item['file']['SRC'] ?>" class="file__item">
                                                    <svg class="file__svg">
                                                        <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#file"></use>
                                                    </svg>
                                                    <span class="file__info inter">
                                                        <?= $fileType; ?>
                                                        <?= $fileSize; ?>
                                                    </span>
                                                    <span class="file__title inter">
                                                        <? if ($item['desc']):
                                                            echo $item['desc']; ?>
                                                        <? else:
                                                            echo $item['file']['ORIGINAL_NAME'];
                                                        endif; ?>
                                                    </span>
                                                </a>
                                            <? endforeach; ?>
                                        </div>
                                    <? endif; ?>

                                <? elseif ($itemblock['name'] == 'avtofiles' || $itemblock['name'] == 'my_avto_files'): ?>
                                    <? if (!empty($itemblock['IDinfo']) & !empty($itemblock['BlockNumber'])): ?>
                                        <div class="file__wrap">
                                            <?
                                            $arFilter = array(
                                                'IBLOCK_ID' => $itemblock['IDinfo'],
                                                'ID' => $itemblock['BlockNumber'],
                                                'ACTIVE' => 'Y', // выборка только активных элементов
                                            );


                                            $res = CIBlockElement::GetList(array(), $arFilter);
                                            while ($element = $res->GetNext()) {
                                                $db_props = CIBlockElement::GetProperty(
                                                    $itemblock['IDinfo'],
                                                    $element['ID'],
                                                    $arOrder = array(),
                                                    $arFilter = array("CODE" => "CONTENT")
                                                );

                                                if ($ar_props = $db_props->Fetch())
                                                    $CONTENTBloks = ($ar_props['VALUE']);

                                                ?>
                                                <?

                                                $decodeElem = json_decode($CONTENTBloks, true);
                                                foreach ($decodeElem['blocks'] as &$value) {
                                                    if (in_array("my_files_content", $value)) {
                                                        if (is_array($value['files'] )) {
                                                            foreach ($value['files'] as $file) {
                                                                $resArr = (reset($file));
                                                                $fileName = $resArr['ORIGINAL_NAME'];
                                                                $fileType = substr($fileName, strripos($fileName, '.') + 1);
                                                                $fileSize = CFile::FormatSize($resArr['FILE_SIZE']);
                                                                ?>
                                                                <a download="<?= $resArr['ORIGINAL_NAME'] ?>" title="<?= $item['desc'] ?>"
                                                                    href="<?= $resArr['SRC'] ?>" class="file__item">
                                                                    <svg class="file__svg">
                                                                        <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#file"></use>
                                                                    </svg>
                                                                    <span class="file__info inter">
                                                                        <?= $fileType; ?>
                                                                        <?= $fileSize; ?>
                                                                    </span>
                                                                    <span class="file__title inter">
                                                                        <?= preg_replace('/\.\w+$/', '', $fileName); ?>
                                                                    </span>
                                                                </a>
                                                                <?
                                                            }
                                                        }
                                                    }
                                                }


                                                ; ?>
                                            <? } ?>
                                        </div>
                                    <? endif; ?>
                                <? endif; ?>

                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>