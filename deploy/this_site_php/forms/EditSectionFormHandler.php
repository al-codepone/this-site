<?php

require_once(THIS_SITE_PHP . 'forms/SectionFormHandler.php');

class EditSectionFormHandler extends SectionFormHandler {
    public function __construct() {
        parent::__construct();
        $this->addElement('delete_flag', 0);
    }
}

?>
