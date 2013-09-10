<?php

function newPageCreated($pageID, $urlID) {
    return sprintf('<div class="success">New page created</div>'
        . '<ul><li><a href="%s%s">View Page</a></li>'
        . '<li><a href="%s%d">Edit Page</a></li>'
        . '<li><a href="%s">%s</a></li></ul>',
        ROOT, $urlID, EDIT_PAGE, $pageID, NEW_PAGE, NEW_PAGE_TITLE);
}

?>
