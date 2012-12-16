<?php

require_once(THIS_SITE . 'html/currentLink.php');
require_once(THIS_SITE . 'html/navItems.php');

function cmsNavItems($sections, $currentSectionID, $isNewSection) {
    return sprintf('<span id="new_section"><a %shref="%s">%s</a></span>%s',
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
