<?php

function databaseError($e) {
    if($e instanceof \pjsql\DatabaseException) {
        die('database error');
    }
    else {
        throw $e;
    }
}
