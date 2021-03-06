<?php

/*
 * Add New Buttons styles Brand Button, White Button,  
 * Brand Table, Brand Accordion, Read More Post Grid 
 * Change default classes
 */
add_action('mp_library', 'mp_profit_extend_style_classes', 11, 1);

function mp_profit_extend_style_classes($motopressCELibrary) {
    $mp_profit_color_primary = get_option('mp_profit_color_primary', '#27b399');
    $mp_profit_color_primary_light = get_option('mp_profit_color_primary_light', '#37c4aa');

    if (isset($motopressCELibrary)) {

// button
        $buttonObj = &$motopressCELibrary->getObject('mp_button');
        if ($buttonObj) {
            $styleClasses = &$buttonObj->getStyle('mp_style_classes');

            $styleClasses['predefined']['color']['values']['theme-grey'] = array(
                'class' => 'mp-theme-button-grey',
                'label' => __('Theme Grey',  'profit' )
            );
            $styleClasses['predefined']['color']['values']['theme-brand'] = array(
                'class' => 'mp-theme-button-brand',
                'label' => __('Theme Brand',  'profit' )
            );
            $styleClasses['default'] = array(
                'mp-theme-button-brand',
                'motopress-btn-size-middle'
            );
        }

// accordion
        $accordionObj = &$motopressCELibrary->getObject('mp_accordion');
        if ($accordionObj) {
            $styleClasses = &$accordionObj->getStyle('mp_style_classes');
            $styleClasses['predefined']["style"]["values"]['theme-brand'] = array(
                'class' => 'mp-theme-accordion-brand',
                'label' => __('Theme Brand',  'profit' )
            );
            $styleClasses['default'] = array(
                'mp-theme-accordion-brand'
            );
        }
// table
        $tableObj = &$motopressCELibrary->getObject('mp_table');
        if ($tableObj) {
            $styleClasses = &$tableObj->getStyle('mp_style_classes');
            $styleClasses['predefined']['color']['values']['theme-brand'] = array(
                'class' => 'mp-theme-table-brand',
                'label' => __('Theme Brand',  'profit' )
            );
            $styleClasses['predefined']['color']['values']['theme-silver'] = array(
                'class' => 'motopress-table-style-silver',
                'label' => __('Light',  'profit' )
            );
            unset($styleClasses['predefined']["style"]["values"]['silver']);
            $styleClasses['default'] = array(
                'mp-theme-table-brand',
                'motopress-table-first-col-left'
            );
        }
// postGrid
        $postGridObj = &$motopressCELibrary->getObject('mp_posts_grid');
        if ($postGridObj) {
            $postGridObj->parameters['image_size']['default'] = 'custom';
            $postGridObj->parameters['image_custom_size']['default'] = '870x480';
            $postGridObj->parameters['title_tag']['default'] = 'h3';
            $postGridObj->parameters['filter_btn_color']['default'] = 'none';
        }
       
// list
        $listObj = &$motopressCELibrary->getObject('mp_list');
        if ($listObj) {
            $listObj->parameters['icon_color']['default'] = $mp_profit_color_primary;
        }
// icon 
        $iconObj = &$motopressCELibrary->getObject('mp_icon');
        if ($iconObj) {
            $iconObj->parameters['icon_color']['default'] = '';
            $iconObj->parameters['bg_shape']['default'] = 'circle';
            $iconObj->parameters['icon_background_size']['default'] = 2;
            $iconObj->parameters['bg_color']['default'] = '';
            $styleClasses = &$iconObj->getStyle('mp_style_classes');
            $styleClasses['predefined']['color']['values']['theme-brand'] = array(
                'class' => 'mp-theme-icon-bg-brand',
                'label' => __('Theme Brand',  'profit' )
            );
            $styleClasses['default'] = array(
                'mp-theme-icon-bg-brand',
            );
        }
// button inner
        $buttonGroupInnerObj = &$motopressCELibrary->getObject('mp_button_inner');
        if ($buttonGroupInnerObj) {

            $buttonGroupInnerObj->parameters['color']['list']['mp-theme-button-brand'] = __('Theme Brand',  'profit' );
            $buttonGroupInnerObj->parameters['color']['list']['mp-theme-button-grey'] = __('Theme Grey',  'profit' );
            $styleClasses = &$buttonGroupInnerObj->getStyle('mp_style_classes');

            $styleClasses['predefined']['color']['values']['theme-brand'] = array(
                'class' => 'mp-theme-button-brand',
                'label' => __('Theme Brand',  'profit' )
            );
            $styleClasses['predefined']['color']['values']['theme-grey'] = array(
                'class' => 'mp-theme-button-grey',
                'label' => __('Theme Grey',  'profit' )
            );
            $buttonGroupInnerObj->parameters['color']['default'] = 'mp-theme-button-brand';
        }

        // download button
        $downloadButtonObj = &$motopressCELibrary->getObject('mp_download_button');
        if ($downloadButtonObj) {
            $styleClasses = &$downloadButtonObj->getStyle('mp_style_classes');

            $styleClasses['predefined']['color']['values']['theme-white'] = array(
                'class' => 'mp-theme-button-grey',
                'label' => __('Theme Grey',  'profit' )
            );
            $styleClasses['predefined']['color']['values']['theme-brand'] = array(
                'class' => 'mp-theme-button-brand',
                'label' => __('Theme Brand',  'profit' )
            );

            $styleClasses['default'] = array(
                'mp-theme-button-brand',
                'motopress-btn-size-middle',
                'motopress-btn-icon-indent-middle'
            );
        }
// service box
        $serviceBoxObj = &$motopressCELibrary->getObject('mp_service_box');
        if ($serviceBoxObj) {
            $serviceBoxObj->parameters['heading_tag']['default'] = 'h4';
            $serviceBoxObj->parameters['icon_size']['default'] = 'large';
            $serviceBoxObj->parameters['icon_custom_color']['default'] = '#ffffff';
            $serviceBoxObj->parameters['icon_background_type']['default'] = 'circle';
            $serviceBoxObj->parameters['icon_background_size']['default'] = 2;
            $serviceBoxObj->parameters['icon_background_color']['default'] = '';
            $serviceBoxObj->parameters['button_custom_bg_color']['default'] = $mp_profit_color_primary;
            $serviceBoxObj->parameters['button_custom_text_color']['default'] = '#ffffff';
            $serviceBoxObj->parameters['icon_color']['list']['mp-theme-icon-brand'] = __('Theme Brand',  'profit' );
            $serviceBoxObj->parameters['icon_color']['default'] = 'mp-theme-icon-brand';
            $serviceBoxObj->parameters['button_color']['list']['mp-theme-button-brand'] = __('Theme Brand',  'profit' );
            $serviceBoxObj->parameters['button_color']['default'] = 'mp-theme-button-brand';
            $styleClasses = &$serviceBoxObj->getStyle('mp_style_classes');
            $styleClasses['predefined']['color']['values']['theme-brand'] = array(
                'class' => 'motopress-service-box-brand',
                'label' => __('Theme Brand',  'profit' )
            );
            $styleClasses['default'] = array(
                'motopress-service-box-brand'
            );
        }
// call 
        $ctaObj = &$motopressCELibrary->getObject('mp_cta');
        if ($ctaObj) {
            $ctaObj->parameters['style_bg_color']['default'] = $mp_profit_color_primary;
            $ctaObj->parameters['icon_color']['list']['mp-theme-icon-white'] = __('Theme Brand',  'profit' );
            $ctaObj->parameters['icon_color']['default'] = 'mp-theme-icon-white';
            $ctaObj->parameters['shape']["default"]="squere";
            $ctaObj->parameters['style']['list']['brand'] = __('Theme Brand',  'profit' );
            $ctaObj->parameters['style']['default'] = 'brand';
            $ctaObj->parameters['style_text_color']['default'] = '#ffffff';
            $ctaObj->parameters['button_color']['list']['mp-theme-button-grey'] = __('Theme Grey',  'profit' );
            $ctaObj->parameters['button_color']['default'] = 'mp-theme-button-grey';
        }
// timer
        $countdownTimerObj = &$motopressCELibrary->getObject('mp_countdown_timer');
        if ($countdownTimerObj) {
            $countdownTimerObj->parameters['font_color']['default'] = '';
            $countdownTimerObj->parameters['block_color']['default'] = '';
            $styleClasses = &$countdownTimerObj->getStyle('mp_style_classes');
            $styleClasses['predefined']['color']['values']['theme-brand'] = array(
                'class' => 'mp-theme-countdown-timer-brand',
                'label' => __('Theme Brand',  'profit' )
            );
            $styleClasses['default'] = array(
                'mp-theme-countdown-timer-brand',
            );
        }
// chart
        $chartObj = &$motopressCELibrary->getObject('mp_google_chart');
        if ($chartObj) {
            $chartObj->parameters['colors']['default'] = $mp_profit_color_primary . ',' . $mp_profit_color_primary_light;
        }
// modal
        $modalObj = &$motopressCELibrary->getObject('mp_modal');
        if ($modalObj) {
            $styleClasses = &$modalObj->getStyle('mp_style_classes');

            $styleClasses['predefined']['color']['values']['theme-white'] = array(
                'class' => 'mp-theme-button-white',
                'label' => __('Theme White',  'profit' )
            );
            $styleClasses['predefined']['color']['values']['theme-brand'] = array(
                'class' => 'mp-theme-button-brand',
                'label' => __('Theme Brand',  'profit' )
            );
            $styleClasses['default'] = array(
                'mp-theme-button-brand',
                'motopress-btn-size-middle',
                'motopress-btn-icon-indent-middle'
            );
        }
    }
// tab
    $tabObj = &$motopressCELibrary->getObject('mp_tab');
    if ($tabObj) {
        $tabObj->parameters['icon_color']['list']['mp-theme-icon-brand'] = __('Theme Brand',  'profit' );
        $tabObj->parameters['icon_color']['default'] = 'mp-theme-icon-brand';
    }
}
