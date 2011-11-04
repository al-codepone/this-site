<?php

require_once(CITY_PHP . 'IView.php');

class Message implements IView {
    private $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function draw() {
        return $this->getMessage();
    }

    protected function getMessage() {
        return $this->message;
    }
}

?>
