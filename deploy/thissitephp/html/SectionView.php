<?php

require_once(CITY_PHP . 'IView.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');

class SectionView implements IView {
    private $sectionData;

    public function __construct(SectionData $sectionData) {
        $this->sectionData = $sectionData;
    }

    public function draw() {
        return str_replace("\r\n", '<br/>', $this->sectionData->content);
    }
}

?>
