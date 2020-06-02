<?php

function database_error($e) {
    if($e instanceof \pjsql\DatabaseException) {
        die('database error');
    }
    else {
        throw $e;
    }
}

function safe_mode($string) {
    return str_ireplace(
        array('&lt;p&gt;', '&lt;/p&gt;'),
        array('<p>', '</p>'),
        c\esc($string));
}

function url_taken($url_id) {
    return is_null($url_id)
        ? 'empty URL ID already in use'
        : "URL ID \"$url_id\" already in use";
}

function normalize_page_form_data(array $data) {
    $data['url_id'] = trim($data['url_id']) === ''
            ? null
            : $data['url_id'];

    return $data;
}
