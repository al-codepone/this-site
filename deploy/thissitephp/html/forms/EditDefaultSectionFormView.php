<?php

require_once(THIS_SITE_PHP . 'html/forms/DefaultSectionFormView.php');

class EditDefaultSectionFormView extends DefaultSectionFormView {
    protected function getActionUrl() {
        return sprintf('%s?sid=%s', EDIT_SECTION, $this->getCurrentSection()->section_id);
    }

    protected function getFormTop() {
        return '<input type="hidden" name="x7n" value="0"/>';
    }

    protected function getFormBottom() {
        return '<div><input type="submit" value="Save"/> '
            . '<input type="button" value="Delete" onClick="deleteSection();"/></div>'
            . sprintf('<div><a href="%s%s">View Section</a></div>', ROOT, $this->getCurrentSection()->url_id);
    }
}

?>
