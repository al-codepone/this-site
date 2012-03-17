<?php

require_once(CITY_PHP . 'IView.php');
require_once(THIS_SITE_PHP . 'html/navigation/Navigation.php');

abstract class ThisSiteHtmlBody implements IView {
    private $navigation;
    private $view;
    private $isAutofocus;

    public function __construct(Navigation $navigation, IView $view, $isAutofocus = false) {
        $this->navigation = $navigation;
        $this->view = $view;
        $this->isAutofocus = false;
    }

    protected function getNavigation() {
        return $this->navigation;
    }

    protected function getView() {
        return $this->view;
    }

    protected function getIsAutofocus() {
        return $this->isAutofocus;
    }
}

?>
