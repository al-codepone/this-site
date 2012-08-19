<?php

function cmsNavItems($sections) {
    ob_start();

    printf('<li id="new_section"><a href="%s">%s</a></li>',
        NEW_SECTION, NEW_SECTION_TITLE);    

    foreach($sections as $section) {
        printf('<li><a href="%s%d">%s</a></li>',
            EDIT_SECTION, $section['section_id'], $section['link_title']);
    }

    return ob_get_clean();
}

?>
