<?php

require_once(CITY_PHP . 'IView.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');

abstract class Navigation implements IView {
    private $sections;
    private $currentSection;

    public function __construct(array $sections, SectionData $currentSection = null) {
        $this->sections = $sections;
        $this->currentSection = $currentSection ? $currentSection : new SectionData();
    }

    abstract protected function getSectionUrl(SectionData $sectionData);

    protected function getSectionLink(SectionData $sectionData) {
        $title = htmlspecialchars($sectionData->link_title);
        $id = $this->getAnchorID($this->isCurrentSection($sectionData));
        return sprintf('<a%s href="%s">%s</a>', $id, $this->getSectionUrl($sectionData), $title);
    }

    protected function isCurrentSection(SectionData $sectionData) {
        return $this->currentSection->section_id == $sectionData->section_id;
    }

    protected function getAnchorID($isCurrentAnchor) {
        return $isCurrentAnchor ? ' id="currentlink"' : '';
    }

    protected function getSections() {
        return $this->sections;
    }
}

?>
