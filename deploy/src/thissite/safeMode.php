<?php

function safeMode($string) {
    return str_ireplace(
        array('&lt;p&gt;', '&lt;/p&gt;'),
        array('<p>', '</p>'),
        htmlspecialchars($string));
}
