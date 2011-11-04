<?php

require_once(THIS_SITE_PHP . 'database/SectionData.php');

interface IThisSiteDatabaseApi {
    const TABLE_SECTIONS = 'sections';

    public function install();
    public function getMaxLinkOrder();
    public function getSectionWithSID($sectionID);
    public function getSectionWithUID($urlID);
    public function getSections();
    public function addSection(SectionData $sectionData);
    public function editSection(SectionData $sectionData);
    public function deleteSection($sectionID);
}

?>
