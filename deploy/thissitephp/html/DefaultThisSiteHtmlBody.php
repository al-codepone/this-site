<?php

require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlBody.php');

class DefaultThisSiteHtmlBody extends ThisSiteHtmlBody {
    public function draw() {
        ob_start();
        echo $this->getBodyTag();

?>
<div class="navigation"><?php echo $this->getNavigation()->draw(); ?></div>
<div class="view"><?php echo $this->getView()->draw(); ?></div></body>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }
}

?>
