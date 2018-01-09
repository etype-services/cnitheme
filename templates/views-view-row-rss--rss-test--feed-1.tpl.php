<?php if (! empty($node->field_image['und'][0]['uri'])) {
    $img  = '<img src="' . $node->field_image['und'][0]['uri'] . '" />';
} else {
    $img = '';
} ?>
<item>
    <title><?php print $title; ?></title>
    <link><?php print $link; ?>
    <image><?php print trim($img);?></image>
</item>