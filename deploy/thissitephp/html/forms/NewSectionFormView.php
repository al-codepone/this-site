<?php

require_once(THIS_SITE_PHP . 'html/forms/SectionFormView.php');

class NewSectionFormView extends SectionFormView {
    protected function getActionUrl() {
        return NEW_SECTION;
    }

    protected function getFormTop() {
        return '';
    }

    protected function getFormBottom() {
        return '<input type="submit" value="Create"/>';
    }
}

?>
