<?php

drupal_add_css(drupal_get_path('theme', 'cni') . '/css/theme-settings.css', [
    'group' => CSS_THEME,
    'weight' => 100
]);

// Get the number of columns
function get_columns()
{
    $grid_size = theme_get_setting('grid_size');
    $columns = [];
    for ($grid_unit = 0; $grid_unit <= $grid_size; $grid_unit++) {
        $columns[] = $grid_unit;
        $columns[$grid_unit] = $grid_unit . ' columns';
    }
    return $columns;
}

function cni_form_system_theme_settings_alter(&$form, $form_state)
{

    $grid_size = theme_get_setting('grid_size');
    $col_number = get_columns();

    $form['advanced_settings'] = [
        '#type' => 'vertical_tabs',
        '#title' => t('Advanced Theme Settings'),
        '#description' => t('Customize widths of the Preface and Postscript regions.'),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#weight' => -10,
        '#prefix' => t('<h3> Advanced Settings </h3>')
    ];

    // Misc Settings (Facebook, Twitter, etc.)
    $form['advanced_settings']['misc_settings'] = [
        '#type' => 'fieldset',
        '#title' => t('Misc Settings'),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#weight' => -10,
    ];

    $form['advanced_settings']['misc_settings']['twitter'] = [
        '#type' => 'textfield',
        '#title' => t('Twitter'),
        '#size' => 10,
        '#default_value' => theme_get_setting('twitter'),
    ];

    $form['advanced_settings']['misc_settings']['facebook'] = [
        '#type' => 'textfield',
        '#title' => t('Facebook'),
        '#size' => 10,
        '#default_value' => theme_get_setting('facebook'),
    ];

    $form['advanced_settings']['misc_settings']['pinterest'] = [
        '#type' => 'textfield',
        '#title' => t('Pinterest'),
        '#size' => 10,
        '#default_value' => theme_get_setting('pinterest'),
    ];

    $form['advanced_settings']['misc_settings']['instagram'] = [
        '#type' => 'textfield',
        '#title' => t('Instagram'),
        '#size' => 10,
        '#default_value' => theme_get_setting('instagram'),
    ];

    $form['advanced_settings']['misc_settings']['googleplus'] = [
        '#type' => 'textfield',
        '#title' => t('Google Plus'),
        '#size' => 10,
        '#default_value' => theme_get_setting('googleplus'),
    ];

    $form['advanced_settings']['misc_settings']['youtube'] = [
        '#type' => 'textfield',
        '#title' => t('YouTube'),
        '#description' => t('Enter full YouTube URL.'),
        '#size' => 10,
        '#default_value' => theme_get_setting('youtube'),
    ];

    $form['advanced_settings']['misc_settings']['rssfeed'] = [
        '#type' => 'textfield',
        '#title' => t('RSS Feed'),
        '#description' => t('Enter Yes to activate'),
        '#size' => 10,
        '#default_value' => theme_get_setting('rssfeed'),
    ];

    /* TODO: remove */
    $form['advanced_settings']['misc_settings']['e_edition'] = [
        '#type' => 'hidden',
        '#default_value' => theme_get_setting('e_edition'),
    ];

    /* TODO: remove */
    $form['advanced_settings']['misc_settings']['pub'] = [
        '#type' => 'hidden',
        '#default_value' => theme_get_setting('pub'),
    ];

    /* TODO: remove */
    $form['advanced_settings']['misc_settings']['ptype'] = [
        '#type' => 'hidden',
        '#default_value' => theme_get_setting('ptype'),
    ];

    $form['advanced_settings']['misc_settings']['nav_color'] = [
        '#type' => 'textfield',
        '#title' => t('Navigation Background Color'),
        '#description' => t('Optional, include initial #'),
        '#size' => 10,
        '#default_value' => theme_get_setting('nav_color'),
    ];

    $form['advanced_settings']['misc_settings']['body_background_color'] = [
        '#type' => 'textfield',
        '#title' => t('Body Background Color'),
        '#description' => t('Optional, include initial #'),
        '#size' => 10,
        '#default_value' => theme_get_setting('body_background_color'),
    ];

    $form['advanced_settings']['misc_settings']['max_nav_width'] = [
        '#type' => 'textfield',
        '#title' => t('Max Main Menu Width'),
        '#description' => t('Optionally constrain main menu width'),
        '#size' => 10,
        '#default_value' => theme_get_setting('max_nav_width'),
    ];

    $form['advanced_settings']['misc_settings']['max_user_nav_width'] = [
        '#type' => 'textfield',
        '#title' => t('Max User Menu Width'),
        '#description' => t('Optionally constrain user menu width'),
        '#size' => 10,
        '#default_value' => theme_get_setting('max_user_nav_width'),
    ];

    $form['advanced_settings']['misc_settings']['logo_width'] = [
        '#type' => 'textfield',
        '#title' => t('Logo Width'),
        '#description' => t('Optional maximum allowed width for logo'),
        '#size' => 10,
        '#default_value' => theme_get_setting('logo_width'),
    ];

    /* Default Menu Break Point */
    $tmp = theme_get_setting('menu_break_point');
    $menu_break_point = empty($tmp) ? '767' : $tmp;
    $form['advanced_settings']['misc_settings']['menu_break_point'] = [
        '#type' => 'select',
        '#title' => t('Menu Break Point'),
        '#description' => t('Width at which menu changes to Mobile View.'),
        '#options' => ['767' => '767', '958' => '958'],
        '#default_value' => $menu_break_point,
    ];

    $form['advanced_settings']['misc_settings']['adscript'] = [
        '#type' => 'textarea',
        '#title' => t('Ad Script'),
        '#description' => t('Enter any advertising script to go in the footer.'),
        '#default_value' => theme_get_setting('adscript'),
    ];

    $value = theme_get_setting('remove_addthis');
    $form['advanced_settings']['misc_settings']['remove_addthis'] = [
        '#type' => 'checkbox',
        '#title' => t('Remove AddThis script' . $value),
        '#default_value' => $value,
    ];

    // Grid Settings
    $form['advanced_settings']['grid_settings'] = [
        '#type' => 'fieldset',
        '#title' => t('Grid Settings'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE
    ];

    $form['advanced_settings']['grid_settings']['grid_size'] = [
        '#type' => 'select',
        '#title' => t('Grid Size'),
        '#default_value' => theme_get_setting('grid_size'),
        '#options' => [
            12 => t('12 columns')
        ],
    ];

    $form['advanced_settings']['grid_settings']['sidebar_grid_settings'] = [
        '#type' => 'fieldset',
        '#title' => t('Sidebar Grid Settings'),
        '#description' => t('Customize the Sidebars.'),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#attributes' => [
            'class' => ['form-inline'],
        ],
        '#prefix' => t('<h3> Sidebar Grid Settings </h3>')
    ];

    $form['advanced_settings']['grid_settings']['sidebar_grid_settings']['sidebar_layout'] = [
        '#type' => 'select',
        '#title' => t('Sidebar Layout'),
        '#default_value' => theme_get_setting('sidebar_layout'),
        '#options' => [
            'sidebars-both-first' => t('Both Sidebars First'),
            'sidebars-both-second' => t('Both Sidebars Second'),
            'sidebars-split' => t('Split Sidebars'),
        ],
    ];

    $form['advanced_settings']['grid_settings']['sidebar_grid_settings']['sidebar_first_width'] = [
        '#type' => 'select',
        '#title' => t('Sidebar First'),
        '#default_value' => theme_get_setting('sidebar_first_width'),
        '#options' => $col_number,
    ];

    $form['advanced_settings']['grid_settings']['sidebar_grid_settings']['sidebar_second_width'] = [
        '#type' => 'select',
        '#title' => t('Sidebar Second'),
        '#default_value' => theme_get_setting('sidebar_second_width'),
        '#options' => $col_number,
    ];

    $form['advanced_settings']['grid_settings']['preface_settings'] = [
        '#type' => 'fieldset',
        '#title' => t('More Grid Settings'),
        '#description' => t('Customize widths of the Preface regions.  Note that all four values combined should ideally add up to ' . $grid_size . '.'),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#attributes' => [
            'class' => ['form-inline'],
        ],
        '#prefix' => t('<h3> Preface Grid Widths </h3>')
    ];

    $form['advanced_settings']['grid_settings']['postscript_settings'] = [
        '#type' => 'fieldset',
        '#title' => t('More Grid Settings'),
        '#description' => t('Customize widths of the Postscript regions.  Note that all four values combined should ideally add up to ' . $grid_size . '.'),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#attributes' => [
            'class' => ['form-inline'],
        ],
        '#prefix' => t('<h3> Postscript Grid Widths </h3>')
    ];

    for ($region_count = 1; $region_count <= 4; $region_count++) {

        $form['advanced_settings']['grid_settings']['preface_settings']['preface_' . $region_count . '_grid_width'] = [
            '#type' => 'select',
            '#title' => t('Preface ' . $region_count),
            '#default_value' => theme_get_setting('preface_' . $region_count . '_grid_width'),
            '#options' => $col_number,
        ];

        $form['advanced_settings']['grid_settings']['postscript_settings']['postscript_' . $region_count . '_grid_width'] = [
            '#type' => 'select',
            '#title' => t('Postscript ' . $region_count),
            '#default_value' => theme_get_setting('postscript_' . $region_count . '_grid_width'),
            '#options' => $col_number,
        ];

    }

}
