<item>
    <title><?php print $title; ?></title>
    <link><?php print $link; ?></</link>
    <image><?php
      $img = '<img src="' . $node->field_image['und'][0]['uri'] . '" />';
      print trim($img);?></image>
</item>