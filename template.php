<?php

/* First and Last Classes on Teasers */
function cni_preprocess_page(&$variables) {
    if (isset ($variables['page']['content']['system_main']['nodes'])) {
        $nodes = $variables['page']['content']['system_main']['nodes'];
        $i = 1;
        $len = count($nodes);
        if ($len > 0) {
            foreach (array_keys($nodes) as $nid) {
                if ($i == 1) {
                    $variables['page']['content']['system_main']['nodes'][$nid]['#node']->classes_array = array('first');
                }
                if ($i == $len - 1) {
                    $variables['page']['content']['system_main']['nodes'][$nid]['#node']->classes_array = array('last');
                }
                $i++;
                /* So I don't get "Warning: Cannot use a scalar value as an array" */
                unset($nodes, $nid);
            }
        }
    }
}

function cni_preprocess_node(&$variables) {
    $node = $variables['node'];
    if (!empty($node->classes_array)) {
        $variables['classes_array'] = array_merge($variables['classes_array'], $node->classes_array);
    }

    if (node_is_page($node) !== FALSE) {
        drupal_add_js('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56e774978692f861', 'external');
    }
}

/* Breadcrumbs */

function cni_breadcrumb($variables) {
    $breadcrumb = $variables['breadcrumb'];
    if (!empty($breadcrumb)) {

        // Provide a navigational heading to give context for breadcrumb links to
        // screen-reader users. Make the heading invisible with .element-invisible.

        $output = '<div class="breadcrumb"><div class="breadcrumb-inner">' . implode(' / ', $breadcrumb) . '</div></div>';
        return $output;
    }
}

/* Span Tag on Links */

function cni_link($variables) {
    return '<a href="' . check_plain(url($variables['path'], $variables['options'])) . '"' . drupal_attributes($variables['options']['attributes']) . '><span>' . ($variables['options']['html'] ? $variables['text'] : check_plain($variables['text'])) . '</span></a>';
}

/* Some text in ye old Search Form */

function cni_form_alter(&$form, &$form_state, $form_id) {
    if ($form_id == 'search_block_form') {

        // Add extra attributes to the text box
        $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search';}";
        $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
        // Prevent user from searching the default text
        $form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='Search'){ alert('Please enter a search'); return false; }";
    }
}

/**
 * @param $vars
 */
function cni_preprocess_html(&$vars) {

    /* add body classes */
    $path = drupal_get_path_alias($_GET['q']);
    $aliases = explode('/', $path);
    foreach ($aliases as $alias) {
        $vars['classes_array'][] = drupal_clean_css_identifier($alias);
    }

    /* add site-specific css */
    $base_path = base_path();
    $conf_path = conf_path();
    $site_css = $base_path . $conf_path . '/cni-site.css';

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $site_css)) {
        drupal_add_css(
            $site_css,
            array(
                'type' => 'file',
                'media' => 'all',
                'preprocess' => FALSE,
                'every_page' => TRUE,
                'weight' => 999,
                'group' => CSS_THEME
            )
        );
    }

    /* add favicons */
    $icon_path = $base_path . $conf_path .'/files/favicons/';

    $theme_color = array(
        '#type' => 'html_tag',
        '#tag' => 'meta',
        '#attributes' => array(
            'name' => 'theme-color',
            'content' => '#ffffff',
        )
    );
    drupal_add_html_head($theme_color, 'theme_color');

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $icon_path . 'safari-pinned-tab.svg')) {
        $mask_icon = array(
            '#type' => 'html_tag',
            '#tag' => 'link',
            '#attributes' => array(
                'rel' => 'mask-icon',
                'href' => $icon_path . 'safari-pinned-tab.svg',
                'color' => '#5bbad5',
            )
        );
        drupal_add_html_head($mask_icon, 'mask_icon');

    }

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $icon_path . 'manifest.json')) {
        $manifest = array(
            '#type' => 'html_tag',
            '#tag' => 'link',
            '#attributes' => array(
                'rel' => 'manifest',
                'href' => $icon_path . 'manifest.json',
            )
        );
        drupal_add_html_head($manifest, 'manifest');
    }

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $icon_path . 'favicon-16x16.png')) {
        $icon16 = array(
            '#type' => 'html_tag',
            '#tag' => 'link',
            '#attributes' => array(
                'rel' => 'icon',
                'type' => 'image/png',
                'sizes' => '16x16',
                'href' => $icon_path . 'favicon-16x16.png',
            )
        );
        drupal_add_html_head($icon16, 'icon16');
    }

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $icon_path . 'favicon-32x32.png')) {
        $icon32 = array(
            '#type' => 'html_tag',
            '#tag' => 'link',
            '#attributes' => array(
                'rel' => 'icon',
                'type' => 'image/png',
                'sizes' => '32x32',
                'href' => $icon_path . 'favicon-32x32.png',
            )
        );
        drupal_add_html_head($icon32, 'icon32');
    }

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $icon_path . 'apple-touch-icon.png')) {
        $appletouchicon = array(
            '#type' => 'html_tag',
            '#tag' => 'link',
            '#attributes' => array(
                'rel' => 'apple-touch-icon',
                'sizes' => '180x180',
                'href' => $icon_path . 'apple-touch-icon.png',
            )
        );
        drupal_add_html_head($appletouchicon, 'apple-touch-icon');
    }

}