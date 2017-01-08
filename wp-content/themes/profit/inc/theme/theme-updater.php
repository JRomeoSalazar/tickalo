<?php

/**
 * Load theme updater functions.
 * Action is used so that child themes can easily disable.
 * 
 * @subpackage Profit
 * @since Profit 1.1.0
 */

function mp_profit_profit_updater() {
    require( get_template_directory() . '/classes/theme/theme-updater.php' );
}

add_action('after_setup_theme', 'mp_profit_profit_updater');
