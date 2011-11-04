<?php

class SectionData {
    public $section_id;
    public $url_id;
    public $link_title;
    public $html_title;
    public $html_description;
    public $content;
    public $link_order;
    public $display_mode;

    public function __construct($section_id = -1, 
                                $url_id = '',
                                $link_title = '',
                                $html_title = '',
                                $html_description = '',
                                $content = '',
                                $link_order = 1,
                                $display_mode = 1) {
        $this->section_id = $section_id;
        $this->url_id = $url_id;
        $this->link_title = $link_title;
        $this->html_title = $html_title;
        $this->html_description = $html_description;
        $this->content = $content;
        $this->link_order = $link_order;
        $this->display_mode = $display_mode;
    }
}

?>
