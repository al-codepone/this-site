<?php

require_once(THIS_SITE_PHP . 'database/SectionData.php');
require_once(THIS_SITE_PHP . 'html/navigation/Navigation.php');

class CmsNavigation extends Navigation {
    private $isNewSection;

    public function __construct(array $sections, 
                                SectionData $currentSection = null,
                                $isNewSection = true) {
        parent::__construct($sections, $currentSection);
        $this->isNewSection = $isNewSection;
    }

    public function draw() {
        $ob .= sprintf('<ul><li id="newsection">%s</li>', $this->getNewLink());

        foreach($this->getSections() as $section) {
            $ob .= sprintf('<li>%s</li>', $this->getSectionLink($section));
        }

        $ob .= '</ul>';
        return $ob;
    }

    protected function getSectionUrl(SectionData $sectionData) {
        return sprintf('%s?sid=%s', EDIT_SECTION, $sectionData->section_id);
    }

    protected function getNewLink() {
        $id = $this->getAnchorID($this->isNewSection);
        return sprintf('<a%s href="%s">%s</a>', $id, NEW_SECTION, NEW_SECTION_TITLE);
    }
}

?>
