<?php

require_once(THIS_SITE . 'forms/EditSectionValidator.php');
require_once(THIS_SITE . 'html/editSection.php');
require_once(THIS_SITE . 'html/sectionUpdated.php');

$sectionID = $_GET['id'];
$section = $sectionModel->getSectionWithSID($sectionID);
$head = '<script src="' . JS . 'edit-section.js"></script>';

if($section) {
    $validator = new EditSectionValidator();

    if(list($formData, $errors) = $validator->validate()) {
        if($errors) {
            $content = editSection($formData, $section, current($errors));
        }
        else if($formData['delete_flag']) {
            $sectionModel->deleteSection($sectionID);
            $content = '<div class="success">Section deleted</div>';
        }
        else {
            $content = ($error = $sectionModel->updateSection($sectionID, $formData))
                ? editSection($formData, $section, $error)
                : sectionUpdated($sectionID, $formData['url_id']);
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
