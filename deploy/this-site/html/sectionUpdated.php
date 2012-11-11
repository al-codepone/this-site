<?php

function sectionUpdated($sectionID, $urlID) {
    return sprintf('<div class="success">Section updated</div>'
        . '<ul><li><a href="%s%s">View Section</a></li>'
        . '<li><a href="%s%d">Edit Section</a></li></ul>',
        ROOT, $urlID, EDIT_SECTION, $sectionID);
}

?>
