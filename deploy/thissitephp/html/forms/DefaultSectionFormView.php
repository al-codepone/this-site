<?php

require_once(THIS_SITE_PHP . 'html/forms/SectionFormView.php');

abstract class DefaultSectionFormView extends SectionFormView {
    public function draw() {
        ob_start();

        if($this->getError() != '') {
            printf('<div class="error">%s</div>', $this->getError());
        }

?>
<form action="<?php echo $this->getActionUrl(); ?>" method="post" id="f1i9j">
    <?php echo $this->getFormTop(); ?>
    <div>Link Title<br/><input type="text" name="xlinktitle" id="xlinktitle" value="<?php $this->shrink('link_title'); ?>"/></div>
    <div>URL ID<br/><input type="text" name="xurlid" value="<?php $this->shrink('url_id'); ?>"/></div>
    <div>HTML Title<br/><input type="text" name="xhtmltitle" value="<?php $this->shrink('html_title'); ?>"/></div>
    <div>HTML Description<br/><textarea name="xhtmldescription" id="xhtmldescription"><?php $this->shrink('html_description'); ?></textarea></div>
    <div>Content<br/><textarea name="xcontent" id="xcontent"><?php $this->shrink('content'); ?></textarea></div>
    <div>Link Order<br/><input type="text" name="xlinkorder" value="<?php $this->shrink('link_order'); ?>"/></div>
    <div id="displaymoderadio"><?php echo $this->getDisplayModeRadio(); ?></div>
    <div><?php echo $this->getFormBottom(); ?></div>
</form>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }

    abstract protected function getActionUrl();
    abstract protected function getFormTop();
    abstract protected function getFormBottom();

    protected function getDisplayModeRadio() {
        $ob = '<div>Display Mode:</div>';
        $options = array('Show All', 'Hide Link', 'Hide All');

        for($i = 0; $i < count($options); ++$i) {
            $checked = ($this->getFormSectionData()->display_mode == $i + 1) ? ' checked' : '';
            $ob .= sprintf('<div><input type="radio" name="xdisplaymode" id="radio%d" value="%d"%s/><label for="radio%d">%s</label></div>',
                $i, $i + 1, $checked, $i, $options[$i]);
        }

        return $ob;
    }

    protected function shrink($property) {
        $array = get_object_vars($this->getFormSectionData());
        echo htmlspecialchars($array[$property]);
    }
}

?>
