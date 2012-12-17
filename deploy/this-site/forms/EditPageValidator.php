<?php

require_once(THIS_SITE . 'forms/PageValidator.php');

class EditPageValidator extends PageValidator {
    public function __construct() {
        parent::__construct();
        $this->addValues(array('delete_flag' => 0));
    }
}

?>
