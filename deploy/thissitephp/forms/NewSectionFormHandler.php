<?php

require_once(CITY_PHP . 'forms/FormHandler.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');

class NewSectionFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('xurlid' => '',
            'xlinktitle' => '',
            'xhtmltitle' => '',
            'xhtmldescription' => '',
            'xcontent' => '',
            'xlinkorder' => 1,
            'xdisplaymode' => 1);
        parent::__construct($elementValues);
    }

    public function getSectionData() {
        return new SectionData(-1,
            $this->getValue('xurlid'),
            $this->getValue('xlinktitle'),
            $this->getValue('xhtmltitle'),
            $this->getValue('xhtmldescription'),
            $this->getValue('xcontent'),
            intval($this->getValue('xlinkorder')),
            intval($this->getValue('xdisplaymode')));
    }

    protected function validate_xurlid($value) {
        if($value == '' || preg_match("/^[a-zA-Z0-9_-]{1,40}$/", $value) == 1) {
            return '';
        }

        return 'Invalid URL ID';
    }

    protected function validate_xlinktitle($value) {
        if(preg_match("/^.{1,50}$/", trim($value)) == 1) {
            return '';
        }

        return 'Invalid link title';
    }

    protected function validate_xhtmltitle($value) {
        if(trim($value) == '' || preg_match("/^.{1,65}$/", trim($value)) == 1) {
            return '';
        }

        return 'Invalid HTML title';
    }

    protected function validate_xcontent($value) {
        if(trim($value) != '') {
            return '';
        }

        return 'Invalid content';
    }
}

?>
