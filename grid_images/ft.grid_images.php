<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class grid_images_ft extends EE_Fieldtype {

    var $info = array(
        'name' => 'Thotbox: Grid Images',
        'author' =>'Shane Woodward',
        'description' => 'Grid based responsive image support for text fields in ExpressionEngine',
        'version' =>'1.0'
    );

    public function display_field($data) {
        return NULL;
    }
    
    public function grid_display_settings($data) {
        return NULL;
    }

    public function accepts_content_type($name) {
        return ($name == 'grid');
    }

    public function grid_display_field($data) {
        if (ee()->session->cache(__CLASS__, __FUNCTION__) === FALSE) {
            ee()->cp->load_package_js('grid_images');
            ee()->session->set_cache(__CLASS__, __FUNCTION__, TRUE);
        }
        $input_properties = array('class' => 'grid_images', 'readonly' => 'true' );
        return form_input( $input_properties );
    }
}