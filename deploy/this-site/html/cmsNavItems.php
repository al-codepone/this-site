<?php

require_once(THIS_SITE . 'html/currentLink.php');
require_once(THIS_SITE . 'html/navItems.php');

function cmsNavItems($sections, $currentSectionID, $isNewSection) {
    return sprintf('<a class="new_section" %shref="%s">%s</a>%s',
        currentLink($isNewSection),
        NEW_SECTION,
        NEW_SECTION_TITLE,
        navItems($sections,
            $currentSectionID,
            EDIT_SECTION,
            'section_id',
            true));
}

?>
