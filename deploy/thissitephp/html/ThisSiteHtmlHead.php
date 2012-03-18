<?php

require_once(CITY_PHP . 'html/HtmlHead.php');

class ThisSiteHtmlHead extends HtmlHead {
    public function draw() {
        return sprintf('<head>%s<meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width">
            <link type="text/css" rel="stylesheet" href="%sstyles.css"/></head>',
            $this->getTags(), CSS);
    }
}

?>
