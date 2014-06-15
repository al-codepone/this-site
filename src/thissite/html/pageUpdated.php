<?php

function pageUpdated($pageID, $urlID) {
    return
        '<div class="success">Page updated</div>' .
        c\ulist(
            c\hlink(ROOT . $urlID, 'View Page'),
            c\hlink(EDIT_PAGE . $pageID, 'Edit Page'));
}
