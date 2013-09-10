<?php

function pageUpdated($pageID, $urlID) {
    return sprintf('<div class="success">Page updated</div>'
        . '<ul><li><a href="%s%s">View Page</a></li>'
        . '<li><a href="%s%d">Edit Page</a></li></ul>',
        ROOT, $urlID, EDIT_PAGE, $pageID);
}

?>
