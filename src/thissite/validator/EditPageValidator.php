<?php

namespace thissite\validator;

class EditPageValidator extends PageValidator {
    public function __construct() {
        parent::__construct();
        $this->add_inputs(array('delete_flag' => 0));
    }
}
