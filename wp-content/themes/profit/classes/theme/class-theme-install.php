<?php
/**
 * Setup Wizard Class
 *
 * Takes new users through some basic steps to setup their store.
 *
 * @subpackage Profit
 * @since Profit 1.1.0
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * MP_Profit_Admin_Setup_Wizard class
 */
class MP_Profit_Admin_Setup_Wizard {

    /** @var string Currenct Step */
    private $prefix = 'mp_profit';

    /** @var string Currenct Step */
    private $step = '';

    /** @var array Steps for the setup wizard */
    private $steps = array();

    /**
     * Get prefix.
     *
     * @access public
     * @return sting
     */
    private function getPrefix() {
        return $this->prefix . '_';
    }

    /**
     * Hook in tabs.
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'admin_menus'));
    }

    /**
     * Add admin menus/screens.
     */
    public function admin_menus() {
        add_theme_page(__('Theme Wizard',  'profit' ), __('Theme Wizard',  'profit' ), 'edit_theme_options', 'theme-setup', array($this, 'setup_wizard'));
    }

    /**
     * Show the setup wizard
     */
    public function setup_wizard() {
        if (empty($_GET['page']) || 'theme-setup' !== $_GET['page']) {
            return;
        }
        $this->steps = array(
            'introduction' => array(
                'name' => __('Start',  'profit' ),
                'view' => array($this, 'setup_introduction'),
                'handler' => ''
            ),
            'section' => array(
                'name' => __('Front Page Setup',  'profit' ),
                'view' => array($this, 'setup_section'),
                'handler' => ''
            ),
            'customizer' => array(
                'name' => __('Customizer',  'profit' ),
                'view' => array($this, 'setup_customizer'),
                'handler' => ''
            ),
            'plugins' => array(
                'name' => __('Plugins',  'profit' ),
                'view' => array($this, 'setup_plugins'),
                'handler' => ''
            ),
            'install_plugins' => array(
                'name' => __('Install Plugins',  'profit' ),
                'view' => array($this, 'setup_install_plugins'),
                'handler' => ''
            ),
            'ready' => array(
                'name' => __('Ready',  'profit' ),
                'view' => array($this, 'setup_ready'),
                'handler' => ''
            )
        );
        $this->step = isset($_GET['step']) ? sanitize_key($_GET['step']) : current(array_keys($this->steps));
        $this->setup_wizard_header();
        $this->setup_wizard_steps();
        ?>
        <div class="welcome-panel wizard-panel">
            <?php
            $this->setup_wizard_content();
            $this->setup_wizard_footer();
            ?>
        </div>
        <?php
        exit;
    }

    public function get_next_step_link() {
        $keys = array_keys($this->steps);
        return add_query_arg('step', $keys[array_search($this->step, array_keys($this->steps)) + 1], remove_query_arg('translation_updated'));
    }

    /*
     * Dismiss Theme Wizard admin notice 
     */

    private function wizard_dismiss() {
        update_user_meta(get_current_user_id(), $this->getPrefix() . 'wizard_dismiss', 1);
    }

    /**
     * Setup Wizard Header
     */
    public function setup_wizard_header() {
        $this->wizard_dismiss();
        ?>
        <div class="wrap">
            <h2 class="text-center" style="margin-top: 0px;"><?php _e('Theme Quick Guided Tour',  'profit' ); ?></h2>
            <?php
        }

        /**
         * Setup Wizard Footer
         */
        public function setup_wizard_footer() {
            ?>
        </div>
        <?php
    }

    /**
     * Output the steps
     */
    public function setup_wizard_steps() {
        $ouput_steps = $this->steps;
        $i = 0;
        ?>
        <ol class="theme-setup-steps subsubsub">
            <?php
            foreach ($ouput_steps as $step_key => $step) :
                $i++;
                ?>
                <li style="color:inherit;" >
                    <?php
                    $text = esc_html($step['name']);
                    if (array_search($this->step, array_keys($this->steps)) >= array_search($step_key, array_keys($this->steps)) || $this->step === $step_key) {
                        $text = '<strong>' . esc_html($step['name']) . '</strong>';
                    }
                    echo $text;
                    if ($i < sizeof($ouput_steps)): echo " > ";
                    endif;
                    ?>
                </li>
            <?php endforeach; ?>
        </ol>
        <hr style="clear: both; margin: 40px 0 1em;"/>
        <?php
    }

    /**
     * Output the content for the current step
     */
    public function setup_wizard_content() {
        echo '<div class="theme-setup-content welcome-panel-content">';
        call_user_func($this->steps[$this->step]['view']);
        echo '</div>';
    }

    /**
     * Introduction step
     */
    public function setup_introduction() {
        ?>
        <h2><?php _e('Welcome to the Profit Theme!',  'profit' ); ?></h2>
        <table class="form-table"> 
            <tbody>
                <tr>
                    <td>
                        <p><?php _e('Thank you for choosing Profit theme. This quick guided tour will show you how to:',  'profit' ); ?></p>
                        <ul>
                            <li>- <?php _e('easily customize the theme in a few steps;',  'profit' ); ?></li>
                            <li>- <?php _e('change colors, texts and images;',  'profit' ); ?></li>
                            <li>- <?php _e('start a business website and build pages visually.',  'profit' ); ?></li>
                        </ul>
                        <p><i><?php _e('If you don&rsquo;t want to go through the wizard, you can',  'profit' ); ?>
                                <a href="<?php echo esc_url(admin_url('themes.php')); ?>" class="" ><?php _e('skip and return to the WordPress dashboard.',  'profit' ); ?></a>
                                <?php _e('This Wizard is always available under Appearance > Theme Wizard menu.',  'profit' ); ?></i></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <p class="theme_setup-actions step text-center">
            <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button button-primary button-large"><?php _e('Let\'s Go!',  'profit' ); ?></a>          
        </p>

        <?php
    }

    /**
     * Customizer setup
     */
    public function setup_customizer() {
        ?>
       <p class="theme_setup-actions step " style="float:right; margin: -0.3em 0 0;">
            <?php
            if ($this->checkPlugins()) :
                $keys = array_keys($this->steps);
                $url = add_query_arg('step', $keys[array_search($this->step, array_keys($this->steps)) + 3], remove_query_arg('translation_updated'));
                ?>
                <a href="<?php echo esc_url($url); ?>" class="button button-primary button-large"><?php _e('Continue',  'profit' ); ?></a>
            <?php else: ?>
                <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button button-primary button-large"><?php _e('Continue',  'profit' ); ?></a>
            <?php endif; ?>
        </p>  
        <h2><?php _e('Customizer',  'profit' ); ?></h2>
        <table class="form-table"> 
            <tbody>
                <tr>
                    <td colspan="2">
                        <p><?php _e('One of the main tools of this theme is WordPress Customizer. Navigate to <strong>Appearance > Customize</strong> to change logo, website title, contact information, colors, background image, menus and so on. Once you are done with the changes click &rdquo;Save&rdquo; button  to display  updates on the live site.',  'profit' ); ?></p>
                    </td>
                </tr>
                <tr colspan="2">
                    <td>
                        <h3><?php _e('1. Site Identity',  'profit' ); ?></h3>
                    </td>
                </tr>
                <tr >
                    <td>
                        <img src="<?php echo get_template_directory_uri() . '/images/admin-customizer.png'; ?>">
                    </td>
                    <td>
                        <p><?php _e('The Site Identity section in customizer allows you to change the site title, description, and control whether or not you want to display them in the header.',  'profit' ); ?></p>
                    </td>
                </tr>
                <tr colspan="2">
                    <td>
                        <h3><?php _e('2. Theme Colors',  'profit' ); ?></h3>
                    </td>
                </tr>
                <tr >
                    <td>
                        <img src="<?php echo get_template_directory_uri() . '/images/admin-customizer-colors.png'; ?>">
                    </td>
                    <td>
                        <p><?php _e('In this section you can choose between 4 predefined color schemes, modify header text color, color of the text content and change accent color for buttons.',  'profit' ); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <hr/>
        <p class="theme_setup-actions step text-right" style="float:right; margin-top: 0.5em;">
            <?php
            if ($this->checkPlugins()) :
                $keys = array_keys($this->steps);
                $url = add_query_arg('step', $keys[array_search($this->step, array_keys($this->steps)) + 3], remove_query_arg('translation_updated'));
                ?>
                <a href="<?php echo esc_url($url); ?>" class="button button-primary button-large"><?php _e('Continue',  'profit' ); ?></a>
            <?php else: ?>
                <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button button-primary button-large"><?php _e('Continue',  'profit' ); ?></a>
            <?php endif; ?>
        </p>
        <p class="theme_setup-actions step text-right">
            <a href="<?php echo esc_url(admin_url('themes.php')); ?>" class="button button-large" ><?php _e('Exit',  'profit' ); ?></a>
        </p>
        <?php
    }

    /**
     * Locale settings
     */
    public function setup_section() {
        ?>
        <p class="theme_setup-actions step " style="float:right; margin: -0.3em 0 0;">
            <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button button-primary button-large"><?php _e('Continue',  'profit' ); ?></a>
        </p>        
        <h2><?php _e('Front Page Setup',  'profit' ); ?></h2>


        <table class="form-table"> 
            <tbody>
                <tr>
                    <td colspan="2">
                        <p><?php _e('A huge feature of this theme is completely customizable Front Page. Front Page is the main page of your website that includes all content blocks you may need to build website. Features, Call to action, Portfolio, Contact form, Google Maps and many other blocks are available for you from the box. How to setup your Front Page:',  'profit' ); ?></p>
                    </td>
                </tr>
                <tr colspan="2">
                    <td>
                        <h3><?php _e('1. Create Front Page',  'profit' ); ?></h3>
                    </td>
                </tr>
                <tr >
                    <td>
                        <img src="<?php echo get_template_directory_uri() . '/images/admin-customizer-frontpage.png'; ?>">
                    </td>
                    <td>
                        <ul>
                            <li><?php _e('1. Follow this link to ',  'profit' ); ?> <a href="<?php echo esc_url(admin_url('post-new.php?post_type=page')); ?>" target="_blank"><?php _e('Create New Page',  'profit' ); ?></a></li>
                            <li><?php _e('2. Name it "Home" or "Front Page"',  'profit' ); ?></li>
                            <li><strong><?php _e('3. Choose "Customizable Front Page" template',  'profit' ); ?></strong></li>
                            <li><?php _e('4. Press Publish button',  'profit' ); ?></li>
                        </ul>
                        <p class="description"><?php _e('For more information, please view',  'profit' ); ?> <a href="https://codex.wordpress.org/Pages#Creating_Pages" target="_blank"><?php _e('documentation',  'profit' ); ?></a></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3><?php _e('2. Setup Front Page',  'profit' ); ?></h3>
                    </td>
                </tr>
                <tr >
                    <td>
                        <img src="<?php echo get_template_directory_uri() . '/images/admin-customizer-frontpage-1.png'; ?>">
                    </td>

                    <td>
                        <ul>
                            <li><?php _e('1. Navigate to ',  'profit' ); ?> <a href="<?php echo esc_url(admin_url('options-reading.php')); ?>" target="_blank"><?php _e('Settings -> Reading',  'profit' ); ?></a></li>
                            <li><?php _e('2. In Settings -> Reading, set "Front page displays" to "A static page"',  'profit' ); ?></li>
                            <li><?php _e('2. In Settings -> Reading, set "Front page" to "Home" or "Front Page" you\'ve created in first step',  'profit' ); ?></li>
                            <li><?php _e('3. Scroll down and Save changes',  'profit' ); ?></li>
                        </ul>
                        <p class="description"><?php _e('For more information, please view',  'profit' ); ?> <a href="https://codex.wordpress.org/Creating_a_Static_Front_Page" target="_blank"><?php _e('documentation',  'profit' ); ?></a></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3><?php _e('3. Setup Posts Page (Blog)',  'profit' ); ?></h3>
                    </td>
                </tr>
                <tr >
                    <td>
                        <img src="<?php echo get_template_directory_uri() . '/images/admin-customizer-frontpage-2.png'; ?>">
                    </td>
                    <td>
                        <ul>
                            <li><?php _e('1. Create new page and name it "Blog"',  'profit' ); ?></li>
                            <li><?php _e('2. In Settings -> Reading, set "Posts page" to "Blog"',  'profit' ); ?></li>
                            <li><?php _e('3. Scroll down and Save changes',  'profit' ); ?></li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>

        <hr/>
        <p class="theme_setup-actions step text-right" style="float:right; margin-top: 0.5em;">
            <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button button-primary button-large"><?php _e('Continue',  'profit' ); ?></a>
        </p>
        <p class="theme_setup-actions step text-right">
            <a href="<?php echo esc_url(admin_url('themes.php')); ?>" class="button" ><?php _e('Exit',  'profit' ); ?></a>
        </p>
        <?php
    }

    /**
     * Ready 
     */
    public function setup_ready() {
        ?>
        <h2 class="text-center"><?php _e('You are Ready!',  'profit' ); ?></h2>
        <p><?php _e('Thank you for choosing Proift theme.',  'profit' ); ?></p>
        <hr/>
        <p class="theme_setup-actions step">
            <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-primary button-large"><?php _e('Customize this theme',  'profit' ); ?></a>
            <a href="<?php echo esc_url(admin_url('themes.php')); ?>" class="button button-large" ><?php _e('Return to the WordPress Dashboard',  'profit' ); ?></a>
        </p>       
        <?php
    }

    public function checkPlugins() {
        
        if ((is_plugin_active('mp-profit/profit.php') && is_plugin_active('another-mailchimp-widget/another-mailchimp-widget.php') && is_plugin_active('woocommerce/woocommerce.php') && is_plugin_active('regenerate-thumbnails/regenerate-thumbnails.php') && is_plugin_active('motopress-content-editor/motopress-content-editor.php'))) {
            
            return true;
        } else {
            return false;
        }
    }

    /**
     * Setup plugin 
     */
    public function setup_plugins() {

        $installed_plugins = get_plugins();
        ?>  <form  method="post" action="<?php echo esc_url($this->get_next_step_link()); ?>">
            <p class="theme_setup-actions step" style="float:right; margin: -0.3em 0 0;">
                <?php
                $keys = array_keys($this->steps);
                $url = add_query_arg('step', $keys[array_search($this->step, array_keys($this->steps)) + 2], remove_query_arg('translation_updated'));
                ?>
                <a href="<?php echo esc_url($url); ?>" class="button"><?php _e('Skip',  'profit' ); ?></a>
                <input class="button button-primary" type="submit" value="Install Plugins">
            </p>
            <h2><?php _e('This theme recommends the following free plugins:',  'profit' ); ?></h2>
            <br>

            <?php
            if (!isset($installed_plugins['mp-profit/profit.php'])) :
                ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="1" checked="checked" name="plugins[mp_profit_install]">
                        <?php _e('Profit Theme Engine',  'profit' ) ?>
                        <p class="description"><?php _e('Adds Slider and Front Page Sections to this theme.',  'profit' ) ?></p>

                    </label>
                </div>
            <?php elseif (is_plugin_inactive('mp-profit/profit.php')) : ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="1" checked="checked" name="plugins[mp_profit_activate]">                        
                        <?php _e('Profit Theme Engine',  'profit' ) ?>
                        <p class="description"><?php _e('Activate this plugin.',  'profit' ); ?></p>
                    </label>
                </div>
            <?php endif; ?>
            <?php
            if (!isset($installed_plugins['another-mailchimp-widget/another-mailchimp-widget.php'])) :
                ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="1" checked="checked" name="plugins[another_mailchimp_install]">

                        <?php _e('Newsletter widget',  'profit' ) ?>
                        <p class="description"><?php _e('Adds newsletter widget to this theme.',  'profit' ) ?></p>


                    </label>
                </div>
            <?php elseif (is_plugin_inactive('another-mailchimp-widget/another-mailchimp-widget.php')) : ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="1" checked="checked" name="plugins[another_mailchimp_activate]">
                        <?php _e('Newsletter widget',  'profit' ) ?>                        
                        <p class="description"><?php _e('Activate this plugin.',  'profit' ); ?></p>

                    </label>
                </div>
            <?php endif; ?>
            <?php
            

            if (!isset($installed_plugins['motopress-content-editor/motopress-content-editor.php'])) :
                ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="1" checked="checked" name="plugins[motopress_install]">
                        <?php _e('MotoPress Content Editor', 'profit') ?>
                        <p class="description"><?php _e('Enhances the standard WordPress editor and enables to build websites visually. It\'s complete solution for building responsive pages without coding and simply by dragging and dropping content elements.', 'profit') ?></p>
                    </label>
                </div>
            <?php elseif (is_plugin_inactive('motopress-content-editor/motopress-content-editor.php')) : ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="1" checked="checked" name="plugins[motopress_activate]">
                        <?php _e('MotoPress Content Editor', 'profit') ?>
                        <p class="description"><?php _e('Activate this plugin.', 'profit'); ?></p>                       
                    </label>
                </div>
                <?php
            endif;
            
            ?>                
            <?php
            if (!isset($installed_plugins['woocommerce/woocommerce.php'])) :
                ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="0" name="plugins[woocommerce_install]">

                        <?php _e('WooCommerce for eCommerce',  'profit' ) ?>
                        <p class="description"><?php _e('The world\'s favorite eCommerce solution that gives you complete control to sell anything. Install this plugin if you are going to sell from this website.',  'profit' ) ?></p>
                    </label>
                </div>
            <?php elseif (is_plugin_inactive('woocommerce/woocommerce.php')) : ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="0" name="plugins[woocommerce_activate]">

                        <?php _e('WooCommerce for eCommerce',  'profit' ) ?>
                        <p class="description"><?php _e('Activate this plugin.',  'profit' ); ?></p>

                    </label>
                </div>
            <?php endif; ?>
            <?php
            if (!isset($installed_plugins['stock-ticker/stock-ticker.php'])) :
                ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="0" name="plugins[stock_ticker_install]">

                        <?php _e('Stock Ticker',  'profit' ) ?>


                    </label>
                    <p class="description"><?php _e('Easy add customizable moving or static ticker tapes with stock information for custom stock symbols.',  'profit' ) ?></p>
                </div>
            <?php elseif (is_plugin_inactive('stock-ticker/stock-ticker.php')) : ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="0" name="plugins[stock_ticker_activate]" >
                        <?php _e('Stock Ticker',  'profit' ) ?>
                        <p class="description"><?php _e('Activate this plugin.',  'profit' ); ?></p>

                    </label>
                </div>
            <?php endif; ?>            
            <?php
            if (!isset($installed_plugins['regenerate-thumbnails/regenerate-thumbnails.php'])) :
                ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="0" name="plugins[regenerate_thumbnails_install]">

                        <?php _e('Regenerate Thumbnails',  'profit' ) ?>


                    </label>
                    <p class="description"><?php _e('Allows you to regenerate the thumbnails for your images if you\'ve changed a theme. Available under Dashboard - Tools - Regenerate Thumbnails menu.',  'profit' ) ?></p>
                </div>
            <?php elseif (is_plugin_inactive('regenerate-thumbnails/regenerate-thumbnails.php')) : ?>
                <div class="checkbox" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" value="0" name="plugins[regenerate_thumbnails_activate]" >
                        <?php _e('Regenerate Thumbnails',  'profit' ) ?>
                        <p class="description"><?php _e('Activate this plugin.',  'profit' ); ?></p>

                    </label>
                </div>
            <?php endif; ?>

            <hr/>
            <p class="theme_setup-actions step text-right" style="float:right; margin-top: 0.5em;">
                <?php
                $keys = array_keys($this->steps);
                $url = add_query_arg('step', $keys[array_search($this->step, array_keys($this->steps)) + 2], remove_query_arg('translation_updated'));
                ?>
                <a href="<?php echo esc_url($url); ?>" class="button button-large"><?php _e('Skip',  'profit' ); ?></a>

                <input class="button button-primary" type="submit" value="Install Plugins"> </p>
            <p class="theme_setup-actions step text-right">
                <a href="<?php echo esc_url(admin_url('themes.php')); ?>" class="button" ><?php _e('Exit',  'profit' ); ?></a>
            </p>


        </form>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                var check = false;
                jQuery(".wizard-panel input[type='checkbox']").each(function () {
                    if (jQuery(this).is(":checked")) {
                        check = true;
                    }
                });
                if (!check) {
                    jQuery('.wizard-panel input[type="submit"]').attr("disabled", "disabled");
                }
                jQuery('.wizard-panel input[type="checkbox"]').click(function () {
                    if (jQuery(this).is(":checked")) {
                        jQuery(this).parent().find('input[type="checkbox"]').attr('value', '1');
                    } else {
                        jQuery(this).parent().find('input[type="checkbox"]').attr('value', '0');
                    }
                    jQuery('.wizard-panel input[type="submit"]').attr("disabled", "disabled");
                    jQuery('.wizard-panel input[type="checkbox"]').each(function () {
                        if (jQuery(this).is(":checked")) {
                            jQuery('.wizard-panel input[type="submit"]').removeAttr("disabled");
                        }
                    });

                });
            });
        </script>
        <?php
    }

    public function setup_install_plugins() {
        ?>
        <style type="text/css">
            .wrap .wrap{
                margin: 0;
            }
            .wrap .wrap p:nth-child(7),
            .wrap  .wrap h1{
                display:none;   
            }
        </style>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery("html, body").animate({scrollTop: jQuery(document).height()}, 1000);
            });
        </script>
        <p class="theme_setup-actions step " style="float:right; margin: -0.3em 0 0;">
            <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button button-primary button-large"><?php _e('Continue',  'profit' ); ?></a>
        </p>   
        <h2><?php _e('Installing the plugins (this may take awhile)',  'profit' ); ?></h2>
        <?php
        if (isset($_POST["plugins"])) :
            $array = $_POST["plugins"];
            if (sizeof($array) > 0) {
                require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

                if (array_key_exists("mp_profit_install", $array) || array_key_exists("mp_profit_activate", $array)) {
                    _e('<h4>Profit Theme Engine</h4>',  'profit' );
                }
                if (array_key_exists("mp_profit_install", $array)) {
                    $plugin = 'mp-profit';
                    $url = 'https://downloads.wordpress.org/plugin/mp-profit.zip';
                    $this->install_plugin($plugin, $url);
                    $plugin_path = 'mp-profit/profit.php';
                    $plugin_name = __('Profit Theme Engine',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("mp_profit_activate", $array)) {
                    $plugin_path = 'mp-profit/profit.php';
                    $plugin_name = __('Profit Theme Engine',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("another_mailchimp_install", $array) || array_key_exists("another_mailchimp_activate", $array)) {
                    _e('<h4>MailChimp widget for Profit theme</h4>',  'profit' );
                }
                if (array_key_exists("another_mailchimp_install", $array)) {
                    $plugin = 'another-mailchimp-widget';
                    $url = 'https://downloads.wordpress.org/plugin/another-mailchimp-widget.zip';
                    $this->install_plugin($plugin, $url);
                    $plugin_path = 'another-mailchimp-widget/another-mailchimp-widget.php';
                    $plugin_name = __('MailChimp widget for Profit theme',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("another_mailchimp_activate", $array)) {
                    $plugin_path = 'another-mailchimp-widget/another-mailchimp-widget.php';
                    $plugin_name = __('MailChimp widget for Profit theme',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                
                if (array_key_exists("motopress_install", $array) || array_key_exists("motopress_activate", $array)) {
                    _e('<h4>MotoPress Content Editor</h4>', 'profit');
                }
                if (array_key_exists("motopress_install", $array)) {
                    $plugin = 'motopress-content-editor';
                    $url = get_template_directory_uri() . '/assets/motopress-content-editor.zip';
                    $this->install_plugin($plugin, $url);
                    $plugin_path = 'motopress-content-editor/motopress-content-editor.php';
                    $plugin_name = __('MotoPress Content Editor', 'profit');
                    echo '<p>' . sprintf(__('Activating %s plugin...', 'profit'), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("motopress_activate", $array)) {
                    $plugin_path = 'motopress-content-editor/motopress-content-editor.php';
                    $plugin_name = __('MotoPress Content Editor', 'profit');
                    echo '<p>' . sprintf(__('Activating %s plugin...', 'profit'), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                
                if (array_key_exists("woocommerce_install", $array) || array_key_exists("woocommerce_activate", $array)) {
                    _e('<h4>WooCommerce</h4>',  'profit' );
                }
                if (array_key_exists("woocommerce_install", $array)) {
                    $plugin = 'woocommerce';
                    $url = 'http://downloads.wordpress.org/plugin/woocommerce.zip';
                    $this->install_plugin($plugin, $url);
                    $plugin_path = 'woocommerce/woocommerce.php';
                    $plugin_name = __('WooCommerce',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("woocommerce_activate", $array)) {
                    $plugin_path = 'woocommerce/woocommerce.php';
                    $plugin_name = __('WooCommerce',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("stock_ticker_install", $array) || array_key_exists("stock_ticker_activate", $array)) {
                    _e('<h4>Stock Ticker</h4>',  'profit' );
                }
                if (array_key_exists("stock_ticker_install", $array)) {
                    $plugin = 'stock-ticker';
                    $url = 'https://downloads.wordpress.org/plugin/stock-ticker.0.1.7.zip';
                    $this->install_plugin($plugin, $url);
                    $plugin_path = 'stock-ticker/stock-ticker.php';
                    $plugin_name = __('Stock Ticker',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("stock_ticker_activate", $array)) {
                    $plugin_path = 'stock-ticker/stock-ticker.php';
                    $plugin_name = __('Stock Ticker',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("regenerate_thumbnails_install", $array) || array_key_exists("regenerate_thumbnails_activate", $array)) {
                    _e('<h4>Regenerate Thumbnails</h4>',  'profit' );
                }
                if (array_key_exists("regenerate_thumbnails_install", $array)) {
                    $plugin = 'regenerate-thumbnails';
                    $url = 'https://downloads.wordpress.org/plugin/regenerate-thumbnails.zip';
                    $this->install_plugin($plugin, $url);
                    $plugin_path = 'regenerate-thumbnails/regenerate-thumbnails.php';
                    $plugin_name = __('Regenerate Thumbnails',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
                if (array_key_exists("regenerate_thumbnails_activate", $array)) {
                    $plugin_path = 'regenerate-thumbnails/regenerate-thumbnails.php';
                    $plugin_name = __('Regenerate Thumbnails',  'profit' );
                    echo '<p>' . sprintf(__('Activating %s plugin...',  'profit' ), $plugin_name) . '</p>';
                    $this->activate_plugin($plugin_name, $plugin_path);
                }
            }
        endif;
        ?>
        <br/>
        <hr/>
        <p class="theme_setup-actions step text-right" style="float:right; margin-top: 0.5em;">
            <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button button-primary button-large"><?php _e('Continue',  'profit' ); ?></a>
        </p>
        <p class="theme_setup-actions step text-right">
            <a href="<?php echo esc_url(admin_url('themes.php')); ?>" class="button button-large" ><?php _e('Exit',  'profit' ); ?></a>
        </p>
        <?php
    }

    public function install_plugin($plugin, $url) {
        $title = '';
        $upgrader = new Plugin_Upgrader(
                $skin = new Plugin_Upgrader_Skin(
                compact('url', 'plugin', '', 'title')
                )
        );
        // Perform plugin insatallation from source url
        $upgrader->install($url);
        //Flush plugins cache so we can make sure that the installed plugins list is always up to date
        wp_cache_flush();
    }

    public function activate_plugin($plugin_name, $plugin_path) {
        $result = activate_plugin($plugin_path);
        if (is_wp_error($result)) {
            echo '<p>' . $plugin_name . ' ' . __('plugin is not activated',  'profit' ) . '</p>';
        } else {
            echo '<p>' . $plugin_name . ' ' . __('plugin is activated',  'profit' ) . '</p>';
        }
    }

}

new MP_Profit_Admin_Setup_Wizard();


