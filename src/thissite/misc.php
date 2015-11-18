<?php

function databaseError($e) {
    if($e instanceof \pjsql\DatabaseException) {
        die('database error');
    }
    else {
        throw $e;
    }
}

function safeMode($string) {
    return str_ireplace(
        array('&lt;p&gt;', '&lt;/p&gt;'),
        array('<p>', '</p>'),
        htmlspecialchars($string));
}

function urlTaken($urlID) {
    return $urlID == ''
        ? 'empty URL ID already in use'
        : "URL ID \"$urlID\" already in use";
}
