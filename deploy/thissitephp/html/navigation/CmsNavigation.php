<?php

require_once(THIS_SITE_PHP . 'database/SectionData.php');
require_once(THIS_SITE_PHP . 'html/navigation/Navigation.php');

abstract class CmsNavigation extends Navigation {
    private $isNewSection;

    public function __construct(array $sections, 
                                SectionData $currentSection = null,
                                $isNewSection = true) {
        parent::__construct($sections, $currentSection);
        $this->isNewSection = $isNewSection;
    }

    protected function getNewLink() {
        $id = $this->getAnchorID($this->isNewSection);
        return sprintf('<a%s href="%s">%s</a>', $id, NEW_SECTION, NEW_SECTION_TITLE);
    }
}

?>
