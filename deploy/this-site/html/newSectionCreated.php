<?php

function newSectionCreated($sectionID, $urlID) {
    return sprintf('<div class="success">New section created</div>'
        . '<ul><li><a href="%s%s">View Section</a></li>'
        . '<li><a href="%s%d">Edit Section</a></li>'
        . '<li><a href="%s">%s</a></li></ul>',
        ROOT, $urlID, EDIT_SECTION, $sectionID, NEW_SECTION, NEW_SECTION_TITLE);
}

?>
