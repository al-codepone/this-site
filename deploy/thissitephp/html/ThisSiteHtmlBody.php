<?php

require_once(CITY_PHP . 'html/HtmlBody.php');
require_once(CITY_PHP . 'IView.php');
require_once(THIS_SITE_PHP . 'html/navigation/Navigation.php');

abstract class ThisSiteHtmlBody extends HtmlBody {
    private $navigation;
    private $view;

    public function __construct($bodyTag, Navigation $navigation, IView $view) {
        parent::__construct($bodyTag);
        $this->navigation = $navigation;
        $this->view = $view;
    }

    protected function getNavigation() {
        return $this->navigation;
    }

    protected function getView() {
        return $this->view;
    }
}

?>
