<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

    <div class="node-content-wrapper">
      <?php if (isset($content['field_image'])): ?>
          <div class="field-image">
            <?php print render($content['field_image']); ?>
          </div>
      <?php endif; ?>

      <?php if (isset($content['field_video'])): ?>
          <div class="field-video">
            <?php print render($content['field_video']); ?>
          </div>
      <?php endif; ?>

      <?php print render($title_prefix); ?>

      <?php if (!$page): ?>
          <h2 class="title"<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>

      <?php if ($page): ?>
          <h1 class="title"<?php print $title_attributes; ?>><?php print $title; ?></h1>
      <?php endif; ?>

      <?php print render($title_suffix); ?>

      <?php if ($page) { ?>
          <?php  if (theme_get_setting('remove_addthis') != 1) : ?>
          <!-- Go to www.addthis.com/dashboard to customize your tools -->
          <div class="addthis_sharing_toolbox"></div>
          <?php endif; ?>
      <?php } ?>

      <?php if ($display_submitted): ?>
          <div class="submitted<?php if ($page) {
            echo ' clearfix';
          } ?>">
              <span class="date"><?php print $date; ?></span>
          </div>
      <?php endif; ?>

        <div id="pico">
            <div class="content"<?php print $content_attributes; ?>>
              <?php
              // We hide the comments and links now so that we can render them later.
              hide($content['field_image']);
              hide($content['field_video']);
              hide($content['comments']);
              hide($content['links']);
              hide($content['field_tags']);
              hide($content['field_section']);
              print render($content);
              ?>
            </div>
        </div>

      <?php if (isset($content['links'])): ?>
        <?php print render($content['links']); ?>
      <?php endif; ?>

      <?php if (isset($content['field_section'])): ?>
          <nav class="taxonomy">
              <div class="taxonomy-inner clearfix">
                <?php print render($content['field_section']); ?>
              </div>
          </nav>
      <?php endif; ?>

      <?php if (isset($content['field_tags'])): ?>
          <nav class="taxonomy">
              <div class="taxonomy-inner clearfix">
                <?php print render($content['field_tags']); ?>
              </div>
          </nav>
      <?php endif; ?>

    </div>

</article>

<?php if (isset ($free_message)): ?>
    <div class="free-message">
      <?php print $free_message; ?>
    </div>
<?php endif; ?>

<?php print render($content['comments']); ?>
