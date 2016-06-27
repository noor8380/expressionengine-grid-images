<?php

$plugin_info = array(
    'pi_name' => 'Thotbox: Grid Images',
    'pi_author' =>'Shane Woodward',
    'pi_description' => 'Grid based responsive image support for text fields in ExpressionEngine',
    'pi_version' =>'1.0',
    'pi_usage' => grid_images::usage()
);

class grid_images {

    public function __construct() {
        $this->return_data = $this->output();
    }

    public function output() {
        $this->EE =& get_instance();
        $data = $this->EE->TMPL->tagdata;
        $data = preg_replace('/<p>\[image-(.*?)\]<\/p>/', '<div id="grid_image_$1" class="grid_image"></div>', $data);
        $data = preg_replace('/\[image-(.*?)\]/', '<div id="grid_image_$1" class="grid_image"></div>', $data);
        return $data;
    }

    public static function usage() {
        ob_start();
    ?>
        Use {exp:grid_images} ... {/exp:grid_images} around your editor output to replace image shortcodes with image containers.
    <?php
        $text = ob_get_contents();
        ob_end_clean();
        return $text;
    }

}

?>