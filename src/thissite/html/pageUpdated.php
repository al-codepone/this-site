<?php

function pageUpdated($pageID, $urlID) {
    return '<div class="success">Page updated</div>'
        . blist(array(
            sprintf('<a href="%s%s">View Page</a>', ROOT, $urlID),
            sprintf('<a href="%s%d">Edit Page</a>', EDIT_PAGE, $pageID)));
}
