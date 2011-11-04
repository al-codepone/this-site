<?php

require_once(THIS_SITE_PHP . 'database/SectionData.php');
require_once(THIS_SITE_PHP . 'html/navigation/CmsNavigation.php');

class DefaultCmsNavigation extends CmsNavigation {
    public function draw() {
        $ob .= sprintf('<ul><li id="newsection">%s</li>', $this->getNewLink());

        foreach($this->getSections() as $section) {
            $ob .= sprintf('<li>%s</li>', $this->getSectionLink($section));
        }

        $ob .= '</ul>';
        return $ob;
    }

    protected function getSectionUrl(SectionData $sectionData) {
        return EDIT_SECTION . '?sid=' . $sectionData->section_id;
    }
}

?>
