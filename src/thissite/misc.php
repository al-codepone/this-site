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
    return $url_id == ''
        ? 'empty URL ID already in use'
        : "URL ID \"$url_id\" already in use";
}
