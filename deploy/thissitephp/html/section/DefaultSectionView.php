<?php

require_once(THIS_SITE_PHP . 'html/section/SectionView.php');

class DefaultSectionView extends SectionView {
    public function draw() {
        return str_replace("\r\n", '<br/>', $this->getSectionData()->content);
    }
}

?>
