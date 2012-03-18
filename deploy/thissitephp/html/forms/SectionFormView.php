<?php

require_once(CITY_PHP . 'IView.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');

abstract class SectionFormView implements IView {
    private $formSectionData;
    private $error;
    private $currentSection;

    public function __construct(SectionData $formSectionData,
                                $error = '',
                                SectionData $currentSection = null) {
        $this->formSectionData = $formSectionData;
        $this->error = $error;
        $this->currentSection = $currentSection;
    }

    public function draw() {
        ob_start();

        if($this->error != '') {
            printf('<div class="error">%s</div>', $this->error);
        }

?>
<form action="<?=$this->getActionUrl()?>" method="post" id="f1i9j">
    <?=$this->getFormTop()?>
    <div>Link Title<br/><input type="text" name="xlinktitle" id="xlinktitle" value="<?=$this->shrink('link_title')?>"/></div>
    <div>URL ID<br/><input type="text" name="xurlid" value="<?=$this->shrink('url_id')?>"/></div>
    <div>HTML Title<br/><input type="text" name="xhtmltitle" value="<?=$this->shrink('html_title')?>"/></div>
    <div>HTML Description<br/><textarea name="xhtmldescription" id="xhtmldescription"><?=$this->shrink('html_description')?></textarea></div>
    <div>Content<br/><textarea name="xcontent" id="xcontent"><?=$this->shrink('content')?></textarea></div>
    <div>Link Order<br/><input type="text" name="xlinkorder" value="<?=$this->shrink('link_order')?>"/></div>
    <div id="displaymoderadio"><?=$this->getDisplayModeRadio()?></div>
    <div><?=$this->getFormBottom()?></div>
</form>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }

    abstract protected function getActionUrl();
    abstract protected function getFormTop();
    abstract protected function getFormBottom();

    protected function getCurrentSection() {
        return $this->currentSection;
    }

    protected function shrink($property) {
        $array = get_object_vars($this->formSectionData);
        return htmlspecialchars($array[$property]);
    }

    protected function getDisplayModeRadio() {
        $ob = '<div>Display Mode:</div>';
        $options = array('Show All', 'Hide Link', 'Hide All');

        for($i = 0; $i < count($options); ++$i) {
            $checked = ($this->formSectionData->display_mode == $i + 1) ? ' checked' : '';
            $ob .= sprintf('<div><input type="radio" name="xdisplaymode" id="radio%d" value="%d"%s/>
                <label for="radio%d">%s</label></div>',
                $i, $i + 1, $checked, $i, $options[$i]);
        }

        return $ob;
    }
}

?>
