<?php

require_once CITYPHP . 'html/blist.php';

function newPageCreated($pageID, $urlID) {
    return '<div class="success">New page created</div>'
        . blist(array(
            sprintf('<a href="%s%s">View Pagess</a>', ROOT, $urlID),
            sprintf('<a href="%s%d">Edit Page</a>', EDIT_PAGE, $pageID),
            sprintf('<a href="%s">%s</a>', NEW_PAGE, NEW_PAGE_TITLE)));
}

?>
