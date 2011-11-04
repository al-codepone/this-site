<?php

require_once(CITY_PHP . 'IView.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');

abstract class SectionView implements IView {
    private $sectionData;

    public function __construct(SectionData $sectionData) {
        $this->sectionData = $sectionData;
    }

    protected function getSectionData() {
        return $this->sectionData;
    }
}

?>
