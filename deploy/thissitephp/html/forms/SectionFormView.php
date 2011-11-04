<?php

require_once(CITY_PHP . 'IView.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');

abstract class SectionFormView implements IView {
    private $formSectionData;
    private $error;
    private $currentSection;

    public function __construct(SectionData $formSectionData,
                                $error = '',
                                SectionData $currentSection = null) {
        $this->formSectionData = $formSectionData;
        $this->error = $error;
        $this->currentSection = $currentSection;
    }

    protected function getFormSectionData() {
        return $this->formSectionData;
    }

    protected function getError() {
        return $this->error;
    }

    protected function getCurrentSection() {
        return $this->currentSection;
    }
}

?>
