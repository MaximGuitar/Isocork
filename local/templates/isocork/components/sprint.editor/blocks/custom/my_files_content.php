<? /** @var $block array */

$title = $block["title"];
?>
<section class="section-files" id="section-files">
    <div class="container">
        <?if($title):?>
            <h2 class="section-title align-center m-90"><?=$title;?></h2>
        <?endif;?>

        <div class="section-files__grid">
            <?foreach($block["files"] as $item):
                $arFile = CFile::GetFileArray($item['file']['ID']);
                $fileName = $arFile['ORIGINAL_NAME'];
                $fileType = substr($fileName,strripos($fileName,'.')+1);
                $fileSize = CFile::FormatSize($arFile['FILE_SIZE']);
                ?>
                <a download="<?= $item['file']['ORIGINAL_NAME'] ?>" title="<?= $item['desc'] ?>" href="<?= $item['file']['SRC'] ?>" class="file__item">
                    <svg class="file__svg">
                        <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#file"></use>
                    </svg>
                    <span class="file__info inter"><?=$fileType;?> <?=$fileSize;?></span>
                    <span class="file__title inter">
                        <?if($item['desc']): echo $item['desc']; ?>
                        <?else: echo $item['file']['ORIGINAL_NAME'];
                        endif; ?>
                    </span>
                </a> 
            <?endforeach;?>
        </div>
    </div>
</section>