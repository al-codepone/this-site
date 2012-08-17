<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class NewSectionFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('url_id' => '',
            'link_title' => '',
            'html_title' => '',
            'html_description' => '',
            'content' => '',
            'link_order' => 1,
            'display_mode' => 1);

        parent::__construct($elementValues);
    }

    protected function validate_url_id($value) {
        if($value == '' || preg_match("/^[a-z0-9_-]{1,40}$/i", $value) == 1) {
            return '';
        }

        return 'Invalid URL ID';
    }

    protected function validate_link_title($value) {
        if(preg_match("/^.{1,50}$/", trim($value)) == 1) {
            return '';
        }

        return 'Invalid link title';
    }

    protected function validate_html_title($value) {
        if(trim($value) == '' || preg_match("/^.{1,65}$/", trim($value)) == 1) {
            return '';
        }

        return 'Invalid HTML title';
    }

    protected function validate_content($value) {
        if(trim($value) != '') {
            return '';
        }

        return 'Invalid content';
    }
}

?>
