<div class="field-ad-image-wrapper">
  <?php foreach ($field_sponsor_ad_image_items as $arr): ?>
<div class="field-ad-image">
  <div class="field-ad-image-inner">
    <a href="<?php print $arr['img_url'] ?>" target="_blank"><img alt="Advertisement" src="<?php print $arr['img_src']; ?>" /></a></div>
</div>
<?php endforeach; ?>
</div>
