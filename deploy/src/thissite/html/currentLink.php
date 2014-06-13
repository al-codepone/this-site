<?php

function currentLink($isCurrent) {
    return $isCurrent ?  array('id' => 'current_link') : array();
}
