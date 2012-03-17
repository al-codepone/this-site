<?php

require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlBody.php');

class DefaultThisSiteHtmlBody extends ThisSiteHtmlBody {
    public function draw() {
        return sprintf('<body><div class="navigation">%s</div>
            <div class="view">%s</div>%s</body>',
            $this->getNavigation()->draw(),
            $this->getView()->draw(),
            $this->getAutofocusScript());
    }

    protected function getAutofocusScript() {
        return $this->getIsAutoFocus()
            ? "<script>document.getElementById('xlinktitle').focus();</script>"
            : '';
    }
}

?>
