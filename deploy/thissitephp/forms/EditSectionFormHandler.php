<?php

require_once(THIS_SITE_PHP . 'forms/NewSectionFormHandler.php');

class EditSectionFormHandler extends NewSectionFormHandler {
    public function __construct() {
        parent::__construct();
        $this->addElement('delete_flag', 0);
    }
}

?>
