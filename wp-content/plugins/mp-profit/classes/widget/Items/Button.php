<?php
/**
 * Team  widget class
 *
 */
require_once 'Default.php';

class MP_Profit_Plugin_Widget_Button extends MP_Profit_Plugin_Widget_Default {

    public function __construct() {
        $this->setClassName('mp_profit_widget_button');
        $this->setName(__('Button', 'mp-profit'));
        $this->setDescription(__('Button', 'mp-profit'));
        $this->setIdSuffix('mp_profit_button_widget');
        parent::__construct();
    }

    public function widget($args, $instance) {
        extract($args);
        $column_xs = (!empty($instance['column_xs']) ) ? $instance['column_xs'] : '6';
        $column_sm = (!empty($instance['column_sm']) ) ? $instance['column_sm'] : '6';
        $column_md = (!empty($instance['column_md']) ) ? $instance['column_md'] : '3';
        $column_lg = (!empty($instance['column_lg']) ) ? $instance['column_lg'] : '3';
        if ($column_xs === 'none' || $column_sm === 'none' || $column_md === 'none' || $column_lg === 'none') {
            echo $before_widget;
        } else {
            echo '<div class="widget mp_profit_widget_button  col-xs-' . $column_xs . ' col-sm-' . $column_sm . ' col-md-' . $column_md . ' col-lg-' . $column_lg . '">';
        }
        $title = __('view all', 'mp-profit');
        if (!empty($instance['name'])): $title = $instance['name'];
        endif;
        ?>
        <div class="button-wrapper">
            <a href="<?php echo esc_url($instance['uri']); ?> " class="button" title="<?php echo $title; ?>" ><span><?php echo $title; ?></span></a>
        </div>
        <?php
        if ($column_xs === 'none' || $column_sm === 'none' || $column_md === 'none' || $column_lg === 'none') {
            echo $after_widget;
        } else {
            echo '</div>';
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['uri'] = strip_tags($new_instance['uri']);
        $instance['column_xs'] = strip_tags($new_instance['column_xs']);
        $instance['column_sm'] = strip_tags($new_instance['column_sm']);
        $instance['column_md'] = strip_tags($new_instance['column_md']);
        $instance['column_lg'] = strip_tags($new_instance['column_lg']);
        return $instance;
    }

    public function form($instance) {

        $column_xs = (!empty($instance['column_xs']) ) ? $instance['column_xs'] : '6';
        $column_sm = (!empty($instance['column_sm']) ) ? $instance['column_sm'] : '6';
        $column_md = (!empty($instance['column_md']) ) ? $instance['column_md'] : '3';
        $column_lg = (!empty($instance['column_lg']) ) ? $instance['column_lg'] : '3';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('name'); ?>"
                   id="<?php echo $this->get_field_id('name'); ?>" value="<?php
                   if (!empty($instance['name'])): echo $instance['name'];
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('uri'); ?>"><?php _e('Button link:', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('uri'); ?>"
                   id="<?php echo $this->get_field_id('uri'); ?>" value="<?php
                   if (!empty($instance['uri'])): echo $instance['uri'];
                   endif;
                   ?>"
                   class="widefat"/>
        </p>  
        <div style="overflow:hidden;  margin: 0 0 1em;">
            <label for="colums"><?php _e('Widget Size (x of 12):', 'mp-profit'); ?></label><br/>
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo $this->get_field_id('column_xs'); ?>"><?php _e('Phone', 'mp-profit'); ?></label><br/>
                <select name="<?php echo $this->get_field_name('column_xs'); ?>"
                        id="<?php echo $this->get_field_id('column_xs'); ?>">
                    <option value="none" <?php
                    if ($column_xs === 'none'): echo ' selected ';
                    endif;
                    ?>>none</option>
                    <option value="1" <?php
                    if ($column_xs === '1'): echo ' selected ';
                    endif;
                    ?>>1</option>
                    <option value="2" <?php
                    if ($column_xs === '2'): echo ' selected ';
                    endif;
                    ?>>2</option>                
                    <option value="3" <?php
                    if ($column_xs === '3'): echo ' selected ';
                    endif;
                    ?>>3</option>
                    <option value="4" <?php
                    if ($column_xs === '4'): echo ' selected ';
                    endif;
                    ?>>4</option>
                    <option value="6" <?php
                    if ($column_xs === '6'): echo ' selected ';
                    endif;
                    ?>>6</option>
                    <option value="12" <?php
                    if ($column_xs === '12'): echo ' selected ';
                    endif;
                    ?>>12</option>
                </select>
            </p>  
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo $this->get_field_id('column_sm'); ?>"><?php _e('Tablet', 'mp-profit'); ?></label><br/>
                <select name="<?php echo $this->get_field_name('column_sm'); ?>"
                        id="<?php echo $this->get_field_id('column_sm'); ?>">
                    <option value="none" <?php
                    if ($column_sm === 'none'): echo ' selected ';
                    endif;
                    ?>>none</option>
                    <option value="1" <?php
                    if ($column_sm === '1'): echo ' selected ';
                    endif;
                    ?>>1</option>
                    <option value="2" <?php
                    if ($column_sm === '2'): echo ' selected ';
                    endif;
                    ?>>2</option>                
                    <option value="3" <?php
                    if ($column_sm === '3'): echo ' selected ';
                    endif;
                    ?>>3</option>
                    <option value="4" <?php
                    if ($column_sm === '4'): echo ' selected ';
                    endif;
                    ?>>4</option>
                    <option value="6" <?php
                    if ($column_sm === '6'): echo ' selected ';
                    endif;
                    ?>>6</option>
                    <option value="12" <?php
                    if ($column_sm === '12'): echo ' selected ';
                    endif;
                    ?>>12</option>
                </select>
            </p>  
        </div>
        <div style="overflow:hidden;  margin: 0 0 1em;">
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo $this->get_field_id('column_md'); ?>"><?php _e('Desktop', 'mp-profit'); ?></label><br/>
                <select name="<?php echo $this->get_field_name('column_md'); ?>"
                        id="<?php echo $this->get_field_id('column_md'); ?>">
                    <option value="none" <?php
                    if ($column_md === 'none'): echo ' selected ';
                    endif;
                    ?>>none</option>
                    <option value="1" <?php
                    if ($column_md === '1'): echo ' selected ';
                    endif;
                    ?>>1</option>
                    <option value="2" <?php
                    if ($column_md === '2'): echo ' selected ';
                    endif;
                    ?>>2</option>                
                    <option value="3" <?php
                    if ($column_md === '3'): echo ' selected ';
                    endif;
                    ?>>3</option>
                    <option value="4" <?php
                    if ($column_md === '4'): echo ' selected ';
                    endif;
                    ?>>4</option>
                    <option value="6" <?php
                    if ($column_md === '6'): echo ' selected ';
                    endif;
                    ?>>6</option>
                    <option value="12" <?php
                    if ($column_md === '12'): echo ' selected ';
                    endif;
                    ?>>12</option>

                </select>
            </p> 
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo $this->get_field_id('column_lg'); ?>"><?php _e('Large Desktop', 'mp-profit'); ?></label><br/>
                <select name="<?php echo $this->get_field_name('column_lg'); ?>"
                        id="<?php echo $this->get_field_id('column_lg'); ?>">
                    <option value="none" <?php
                    if ($column_lg === 'none'): echo ' selected ';
                    endif;
                    ?>>none</option>
                    <option value="1" <?php
                    if ($column_lg === '1'): echo ' selected ';
                    endif;
                    ?>>1</option>
                    <option value="2" <?php
                    if ($column_lg === '2'): echo ' selected ';
                    endif;
                    ?>>2</option>                
                    <option value="3" <?php
                    if ($column_lg === '3'): echo ' selected ';
                    endif;
                    ?>>3</option>
                    <option value="4" <?php
                    if ($column_lg === '4'): echo ' selected ';
                    endif;
                    ?>>4</option>
                    <option value="6" <?php
                    if ($column_lg === '6'): echo ' selected ';
                    endif;
                    ?>>6</option>
                    <option value="12" <?php
                    if ($column_lg === '12'): echo ' selected ';
                    endif;
                    ?>>12</option>
                </select>
            </p> 
        </div>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget( "MP_Profit_Plugin_Widget_Button" );'));
