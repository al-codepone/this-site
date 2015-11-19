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
        htmlspecialchars($string));
}

function url_taken($urlID) {
    return $urlID == ''
        ? 'empty URL ID already in use'
        : "URL ID \"$urlID\" already in use";
}
