<?php

require_once CITYPHP . 'html/input.php';
require_once CITYPHP . 'html/radioButtons.php';
require_once CITYPHP . 'html/textarea.php';

function pageInputs(array $data) {
    return
        input(array(
            'id' => 'link_title',
            'value' => $data['link_title']),
            'Link Title')

        . input(array(
            'id' => 'url_id',
            'value' => $data['url_id']),
            'URL ID')

        . input(array(
            'id' => 'html_title',
            'value' => $data['html_title']),
            'HTML Head Title')

        . textarea(array('id' => 'html_description'),
            $data['html_description'],
            'HTML Meta Description')

        . textarea(array('id' => 'html_keywords'),
            $data['html_keywords'],
            'HTML Meta Keywords')

        . textarea(array('id' => 'page_content'),
            $data['page_content'],
            'Page Content')

        . input(array(
            'id' => 'link_order',
            'value' => $data['link_order']),
            'Link Order')

        . radioButtons(array(1 => 'Show All', 'Hide Link', 'Hide All'),
            'display_mode', $data['display_mode'], 'Display Mode');
}

?>
