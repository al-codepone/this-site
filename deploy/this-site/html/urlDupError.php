<?php

function urlDupError($urlID) {
    return $urlID == ''
        ? 'empty URL ID already in use'
        : "URL ID \"$urlID\" already in use";
}

?>
