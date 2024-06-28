<? /** @var $block array */

$title = $block["title"];
?>
<section class="section-video" id="section-video">
    <div class="container">
        <div class="slider-video">
            <div class="keen-slider keen-slider--big">
                <?foreach($block["items"] as $key=>$arItem): ?>
                    <div class="section-video__slider-item keen-slider__slide">
                        <?
                            $video = $arItem['video'];
                            $preview = $arItem['file']['SRC'];
                            $title = $arItem['title'];
                            $text = $arItem['desc'];
                            if (strpos($video, 'watch?v=') != false) {
                                $video = str_replace('watch?v=', 'embed/', $video);
                            }
                        ?>
                        <div class="section-video__slide-preview"> 
                            <div class="section-video__slide-preview-image" style="background-image: url(<?=$preview;?>); background-size: cover;">
                             <img src="<?= SITE_TEMPLATE_PATH ?>/static/images/play.png" alt="">
                            </div>
                            <iframe class="section-video__slide-video" style="width: 100%;" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                            data-src="<?=$video;?>" data-lazy>  
                            </iframe>
                        </div>
                        <div class="section-video__slide-content">
                            <?if($title):?>
                                <h3 class="section-video__slide-title"><?=$title;?></h3>
                            <?endif;?>
                            <?if($text):?>
                                <div class="section-video__slide-text"><?=$text;?></div>
                            <?endif;?>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
            <div class="section-video__slider-thumbnail">
                <div id="thumbnails" class="keen-slider keen-slider--thumbnail">
                    <?foreach($block["items"] as $key=>$arItem): ?>
                        <div class="section-video__slider-thumbnail-item keen-slider__slide">
                            <?
                                $preview = $arItem['file']['SRC'];
                            ?>
                            <div class="section-video__slide-thumbnail-preview" style="background-image: url(<?=$preview;?>); background-size: cover;"></div>
                        </div>
                    <?endforeach;?>
                </div>
                <div class="section-video__arrows"></div>
            </div>
        </div>
    </div>
</section>