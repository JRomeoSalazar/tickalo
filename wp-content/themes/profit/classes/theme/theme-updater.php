<?php

/**
 * Easy Digital Downloads Theme Updater
 *
 * @subpackage Profit
 * @since Profit 1.0.0
 */
// Includes the files needed for the theme updater
if (!class_exists('MP_Profit_EDD_Updater_Admin')) {
    include( dirname(__FILE__) . '/theme-updater-admin.php' );
}
$mp_profit_info = wp_get_theme( get_template() );
$mp_profit_name = $mp_profit_info->get('Name');
$mp_profit_slug = get_template();
$mp_profit_version = $mp_profit_info->get('Version');
$mp_profit_author = $mp_profit_info->get('Author');
$mp_profit_remote_api_url = $mp_profit_info->get('AuthorURI');
// Loads the updater classes
$mp_profit_updater = new MP_Profit_EDD_Updater_Admin(
        // Config settings
        $config = array(
    'remote_api_url' => $mp_profit_remote_api_url, // Site where EDD is hosted
    'item_name' => $mp_profit_name, // Name of theme
    'theme_slug' => $mp_profit_slug, // Theme slug
    'version' => $mp_profit_version, // The current version of this theme
    'author' => $mp_profit_author, // The author of this theme
    'download_id' => '', // Optional, used for generating a license renewal link
    'renew_url' => '' // Optional, allows for a custom license renewal link
        ),
        // Strings
        $strings = array(
    'theme-license' => __('Theme License',  'profit' ),
    'enter-key' => __('Enter your theme license key.',  'profit' ),
    'license-key' => __('License Key',  'profit' ),
    'license-action' => __('License Action',  'profit' ),
    'deactivate-license' => __('Deactivate License',  'profit' ),
    'license-error' => __('Errors',  'profit' ),
    'license-is-inactive' => __('License is inactive.',  'profit' ),
    'site-is-inactive' => __('Site is inactive.',  'profit' ),
    'license-valid-until' => __("Valid until",  'profit' ),
    'license-valid-lifetime' => __("Valid (Lifetime)",  'profit' ),
    'license-key-is-disabled' => __('License key is disabled.',  'profit' ),
    'license-key-expired' => __('License key has expired.',  'profit' ),
    'license-key-invalid' => __('License status is invalid.',  'profit' ),
    'item-name-mismatch' => __("Your License Key does not match the installed theme.",  'profit' ),
    'action' => __('Action',  'profit' ),
    'license-unknown' => __('License  is unknown.',  'profit' ),
    'status' => __('Status',  'profit' ),
    'activate-license' => __('Activate License',  'profit' ),
    'update-notice' => __("Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.",  'profit' ),
    'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.',  'profit' )
        )
);
