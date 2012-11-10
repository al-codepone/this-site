<?php

require_once(THIS_SITE . 'forms/EditSectionValidator.php');
require_once(THIS_SITE . 'html/editSection.php');

$sectionID = $_GET['id'];
$section = $sectionModel->getSectionWithSID($sectionID);
$head = '<script src="' . JS . 'edit-section.js"></script>';

if($section) {
    $validator = new EditSectionValidator();

    if(list($formData, $errors) = $validator->validate()) {
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
                $content = editSection($formData, $section, urlDupError($formData['url_id']));
            }
            else {
                $sectionModel->updateSection($sectionID, $formData);
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
