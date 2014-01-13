<?php

namespace thissite\forms;

class EditPageValidator extends PageValidator {
    public function __construct() {
        parent::__construct();
        $this->addInputs(array('delete_flag' => 0));
    }
}

?>
