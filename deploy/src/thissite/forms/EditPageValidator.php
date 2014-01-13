<?php

namespace thissite\forms;

class EditPageValidator extends PageValidator {
    public function __construct() {
        parent::__construct();
        $this->addValues(array('delete_flag' => 0));
    }
}

?>
