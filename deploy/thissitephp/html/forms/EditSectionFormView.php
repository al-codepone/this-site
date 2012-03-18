<?php

require_once(THIS_SITE_PHP . 'html/forms/SectionFormView.php');

class EditSectionFormView extends SectionFormView {
    protected function getActionUrl() {
        return sprintf('%s?sid=%s', EDIT_SECTION, $this->getCurrentSection()->section_id);
    }

    protected function getFormTop() {
        return '<input type="hidden" name="x7n" value="0"/>';
    }

    protected function getFormBottom() {
        return sprintf('<div><input type="submit" value="Save"/> <input
            type="button" value="Delete" onClick="deleteSection();"/></div>
            <div><a href="%s%s">View Section</a></div>',
            ROOT, $this->getCurrentSection()->url_id);
    }
}

?>
