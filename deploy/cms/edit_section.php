<?php

require_once(THIS_SITE_PHP . 'forms/EditSectionFormHandler.php');
require_once(THIS_SITE_PHP . 'html/editSection.php');

$sectionID = $_GET['id'];
$section = $sectionModel->getSectionWithSID($sectionID);
$head .= '<script src="' . JAVASCRIPT . 'edit_section.js"></script>';

if($section) {
    $formHandler = new EditSectionFormHandler();

    if($formHandler->isReady()) {
        $errors = $formHandler->validate();
        $formData = $formHandler->getValues();

        if($formData['delete_flag']) {
            $sectionModel->deleteSection($sectionID);
            $content = '<div class="success">Section deleted</div>';
        }
        else if(count($errors) > 0) {
            $content = editSection($formData, $section, current($errors));
        }
        else {
            $duplicateCheck = $sectionModel->getSectionWithUID($formData['url_id']);

            if($duplicateCheck && $duplicateCheck['section_id'] != $section['section_id']) {
                $content = editSection($formData, $section, 'URL ID already in use');
            }
            else {
                $sectionModel->editSection($sectionID, $formData);
                $content = sprintf('<div class="success">Section updated</div>'
                    . '<ul><li><a href="%s%s">View Section</a></li>'
                    . '<li><a href="%s%d">Edit Section</a></li></ul>',
                    ROOT, $formData['url_id'], EDIT_SECTION, $sectionID);
            }
        }
    }
    else {
        $content = editSection($section, $section);
    }
}
else {
   $content = 'This section is invalid.';
}

?>
