<?php

namespace thissite\forms;

use cityphp\forms\FormValidator;

class PageValidator extends FormValidator {
    public function __construct() {
        parent::__construct(array(
            'link_title' => '',
            'url_id' => '',
            'html_title' => '',
            'html_description' => '',
            'html_keywords' => '',
            'page_content' => '',
            'link_order' => 1,
            'display_mode' => 1));
    }

    protected function validate_link_title($value) {
        if(!preg_match('/^.{1,48}$/', trim($value))) {
            return 'Link Title must be 1-48 characters';
        }
    }

    protected function validate_url_id($value) {
        if(!preg_match('/^[a-z0-9-]{0,48}$/i', $value)) {
            return 'URL ID must be 0-48 characters and use '
                . 'numbers, letters and dashes only';
        }
    }

    protected function validate_html_title($value) {
        if(!preg_match('/^.{0,96}$/', $value)) {
            return 'HTML Head Title must be 0-96 characters';
        }
    }

    protected function validate_page_content($value) {
        if(trim($value) == '') {
            return 'Page Content must be at least 1 character';
        }
    }
}

?>
