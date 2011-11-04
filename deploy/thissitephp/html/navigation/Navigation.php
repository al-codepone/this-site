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

        if($this->isCurrent($sectionData)) {
            return $title;
        }

        return sprintf('<a href="%s">%s</a>', $this->getSectionUrl($sectionData), $title);
    }

    protected function isCurrent(SectionData $sectionData) {
        return $this->getCurrentSection()->section_id == $sectionData->section_id;
    }

    protected function getSections() {
        return $this->sections;
    }

    protected function getCurrentSection() {
        return $this->currentSection;
    }
}

?>
