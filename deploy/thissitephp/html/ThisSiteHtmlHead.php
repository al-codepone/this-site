<?php

require_once(CITY_PHP . 'html/HtmlHead.php');

class ThisSiteHtmlHead extends HtmlHead {
    public function draw() {
        return '<head>'
            . $this->getTags()
            . '<meta charset="utf-8"/>'
            . '<link type="text/css" rel="stylesheet" href="' . CSS . 'styles.css"/>'
            . '</head>';
    }
}

?>
