<?php

require_once(CITY_PHP . 'IView.php');
require_once(THIS_SITE_PHP . 'html/navigation/Navigation.php');

class ThisSiteHtmlBody implements IView {
    private $navigation;
    private $view;
    private $isAutofocus;

    public function __construct(Navigation $navigation, IView $view, $isAutofocus = false) {
        $this->navigation = $navigation;
        $this->view = $view;
        $this->isAutofocus = $isAutofocus;
    }

    public function draw() {
        return sprintf('<body><div class="navigation">%s</div>
            <div class="view">%s</div>%s</body>',
            $this->navigation->draw(),
            $this->view->draw(),
            $this->getAutofocusScript());
    }

    protected function getAutofocusScript() {
        return $this->isAutofocus
            ? "<script>document.getElementById('xlinktitle').focus();</script>"
            : '';
    }
}

?>
