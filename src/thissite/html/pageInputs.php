<?php

function pageInputs(array $data) {
    return
    c\dlinput(
        'Link Title',
        array(
            'id' => 'link_title',
            'value' => $data['link_title'])) .

    c\dlinput(
        'URL ID',
        array(
            'id' => 'url_id',
            'value' => $data['url_id'])) .

    c\dlinput(
        'HTML Head Title',
        array(
            'id' => 'html_title',
            'value' => $data['html_title'])) .

    c\dltextarea(
        'HTML Meta Description',
        array('id' => 'html_description'),
        $data['html_description']) .

    c\dltextarea(
        'HTML Meta Keywords',
        array('id' => 'html_keywords'),
        $data['html_keywords']) .

    c\dltextarea(
        'Page Content',
        array('id' => 'page_content'),
        $data['page_content']) .

    c\dlinput(
        'Link Order',
        array(
            'id' => 'link_order',
            'value' => $data['link_order'])) .

    c\dsradio_buttons(
        'Display Mode',
        'display_mode',
        array(1 => 'Show All', 'Hide Link', 'Hide All'),
        $data['display_mode']);
}
