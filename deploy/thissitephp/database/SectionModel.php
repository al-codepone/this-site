<?php

require_once(CITY_PHP . 'database/DatabaseAdapter.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');

class SectionModel extends DatabaseAdapter {
    public function install() {
        $query = 'CREATE TABLE ' . TABLE_SECTIONS . ' (
            section_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            url_id VARCHAR(64),
            link_title VARCHAR(64),
            html_title VARCHAR(128),
            html_description TEXT,
            content TEXT,
            link_order MEDIUMINT SIGNED,
            display_mode ENUM("showall", "hidelink", "hideall"),
            PRIMARY KEY (section_id),
            KEY (url_id))
            ENGINE = MYISAM';

        $this->query($query);
    }

    public function getMaxLinkOrder() {
        $query = sprintf('SELECT MAX(link_order) AS max FROM %s', TABLE_SECTIONS);
        $queryData = $this->fetchQuery($query);
        return intval($queryData[0]['max']);
    }

    public function getSectionWithSID($sectionID) {
        $query = sprintf('SELECT section_id, url_id, link_title, html_title,
            html_description, content, link_order, display_mode + 0 AS display_mode
            FROM %s WHERE section_id = %d',
            TABLE_SECTIONS,
            $sectionID);

        return $this->getSectionWithQuery($query);
    }

    public function getSectionWithUID($urlID) {
        $query = sprintf('SELECT section_id, url_id, link_title, html_title,
            html_description, content, link_order, display_mode + 0 AS display_mode
            FROM %s WHERE url_id = "%s"',
            TABLE_SECTIONS,
            $this->esc($urlID));

        return $this->getSectionWithQuery($query);
    }

    public function getSections() {
        $query = sprintf('SELECT section_id, url_id, link_title, display_mode + 0 AS display_mode
            FROM %s ORDER BY link_order, link_title',
            TABLE_SECTIONS);

        $queryData = $this->fetchQuery($query);
        $sections = array();
        foreach($queryData as $data) {
            $sections[] = new SectionData($data['section_id'], $data['url_id'], $data['link_title'],
                '', '', '', 1, $data['display_mode']);
        }

        return $sections;
    }

    public function addSection(SectionData $sectionData) {
        $query = sprintf('INSERT INTO %s
            (section_id, url_id, link_title, html_title, html_description, content, link_order, display_mode)
            VALUES(NULL, "%s", "%s", "%s", "%s", "%s", %d, %d)',
            TABLE_SECTIONS,
            $this->esc($sectionData->url_id),
            $this->esc($sectionData->link_title),
            $this->esc($sectionData->html_title),
            $this->esc($sectionData->html_description),
            $this->esc($sectionData->content),
            $sectionData->link_order,
            $sectionData->display_mode);

        $this->query($query);
        return $this->getConn()->insert_id;
    }

    public function editSection(SectionData $sectionData) {
        $query = sprintf('UPDATE %s SET url_id = "%s", link_title = "%s", html_title = "%s",
            html_description = "%s", content = "%s", link_order = %d, display_mode = %d WHERE section_id = %d',
            TABLE_SECTIONS,
            $this->esc($sectionData->url_id),
            $this->esc($sectionData->link_title),
            $this->esc($sectionData->html_title),
            $this->esc($sectionData->html_description),
            $this->esc($sectionData->content),
            $sectionData->link_order,
            $sectionData->display_mode,
            $sectionData->section_id);

        $this->query($query);
    }

    public function deleteSection($sectionID) {
        $query = sprintf('DELETE FROM %s WHERE section_id = %d',
            TABLE_SECTIONS,
            $sectionID);

        $this->query($query);
    }

    private function getSectionWithQuery($query) {
        $queryData = $this->fetchQuery($query);

        if(count($queryData) == 1) {
            $data = $queryData[0];
            return new SectionData($data['section_id'],
                $data['url_id'],
                $data['link_title'],
                $data['html_title'],
                $data['html_description'],
                $data['content'],
                $data['link_order'],
                $data['display_mode']);
        }

        return new SectionData();
    }
}

?>
