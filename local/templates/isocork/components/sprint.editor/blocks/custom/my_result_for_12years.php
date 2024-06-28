<? /** @var $block array */
$img = $block['file']['ORIGIN_SRC']; ?>


<section class="section-result-for-12years">
  <div class="container">
    <? if ($img): ?>
      <div class="years">
        <div class="text"> За <? echo date('Y') - 2010; ?> лет работы</div>
        <img src="<?= $img; ?>" alt="" class="years-12-img">
      </div>
      
    <? endif; ?>
    <div class="text-col">
      <? foreach ($block["items"] as $arItem): ?>


        <? if ($arItem['text']): ?>
          <div class="text-content">
            <?= $arItem['text']; ?>
          </div>
        <? endif; ?>



      <? endforeach; ?>
    </div>
  </div>
</section>