<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class SectionFormHandler extends FormHandler {
    public function __construct() {
        parent::__construct(array(
            'url_id' => '',
            'link_title' => '',
            'html_title' => '',
            'html_description' => '',
            'page_content' => '',
            'link_order' => 1,
            'display_mode' => 1));
    }

    protected function validate_url_id($value) {
        if(!preg_match('/^[a-z0-9_-]{0,48}$/i', $value)) {
            return 'Invalid URL ID';
        }
    }

    protected function validate_link_title($value) {
        if(!preg_match('/^.{1,48}$/', trim($value))) {
            return 'Invalid link title';
        }
    }

    protected function validate_html_title($value) {
        if(!preg_match('/^.{0,96}$/', $value)) {
            return 'Invalid HTML title';
        }
    }

    protected function validate_page_content($value) {
        if(trim($value) == '') {
            return 'Invalid page content';
        }
    }
}

?>
