<?php

require_once(STD_LIB . 'html/input.php');
require_once(STD_LIB . 'html/textarea.php');
require_once(THIS_SITE . 'html/displayMode.php');

function sectionInputs($data) {
    $input = function($label, $id) use($data) {
        return input($label, $id, $data[$id]);
    };

    $textarea = function($label, $id) use($data) {
        return textarea($label, $id, $data[$id]);
    };

    return $input('Link Title', 'link_title')
        . $input('URL ID', 'url_id')
        . $input('HTML Head Title', 'html_title')
        . $textarea('HTML Meta Description', 'html_description')
        . $textarea('HTML Meta Keywords', 'html_keywords')
        . $textarea('Page Content', 'page_content')
        . $input('Link Order', 'link_order')
        . displayMode($data['display_mode']);
}

?>
