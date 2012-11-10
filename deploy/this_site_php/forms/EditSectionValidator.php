<?php

require_once(THIS_SITE_PHP . 'forms/SectionValidator.php');

class EditSectionValidator extends SectionValidator {
    public function __construct() {
        parent::__construct();
        $this->addValues(array('delete_flag' => 0));
    }
}

?>
