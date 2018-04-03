<item>
    <title><?php print $title; ?></title>
    <content:encoded><?php print '<![CDATA[<!doctype html><html lang="en" prefix="op: http://media.facebook.com/op#"><head><meta property="fb:pages" content="225561420502" /><link rel="canonical" href="' ?><?php print $link; ?><?php print '"></head><body>' ?><?php print $description;?><?php print '</body></html>]]>' ?></content:encoded>
    <?php print $item_elements; ?>
</item>

