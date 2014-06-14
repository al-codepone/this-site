<?php

function newPageCreated($pageID, $urlID) {
    return
        '<div class="success">New page created</div>' .
        c\ulist(
            c\hlink(ROOT . $urlID, 'View Page'),
            c\hlink(EDIT_PAGE . $pageID, 'Edit Page'),
            c\hlink(NEW_PAGE, NEW_PAGE_TITLE));
}
