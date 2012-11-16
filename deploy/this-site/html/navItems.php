<?php

require_once(THIS_SITE . 'html/currentLink.php');

function navItems($sections, $currentSectionID, $baseURL, $key, $forceShow = false) {
    ob_start();    

    foreach($sections as $section) {
        if($forceShow || $section['display_mode'] == 1) {
            printf('<a %shref="%s%s">%s</a>',
                currentLink($section['section_id'] == $currentSectionID),
                $baseURL, $section[$key], $section['link_title']);
        }
    }

    return ob_get_clean();
}

?>
