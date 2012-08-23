<?php

function error($error) {
    return $error
        ? sprintf('<div class="error">%s</div>', $error)
        : '';
}

?>
