<?php

require_once(CITYPHP . 'database/DatabaseAdapter.php');

class SectionModel extends DatabaseAdapter {
    public function install() {
        $this->query('CREATE TABLE ' . TABLE_SECTIONS . ' (
            section_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            url_id VARCHAR(64),
            link_title VARCHAR(64),
            html_title VARCHAR(128),
            html_description TEXT,
            html_keywords TEXT,
            page_content TEXT,
            link_order MEDIUMINT SIGNED,
            display_mode ENUM("show_all", "hide_link", "hide_all"),
            PRIMARY KEY(section_id),
            KEY(url_id))
            ENGINE = MYISAM');
    }

    public function getMaxLinkOrder() {
        $queryData = $this->fetchQuery('SELECT MAX(link_order) AS max FROM ' . TABLE_SECTIONS);
        return intval($queryData[0]['max']);
    }

    public function getSectionWithSID($sectionID) {
        $queryData = $this->fetchQuery(sprintf(
            'SELECT section_id, url_id, link_title, html_title, html_description,
            html_keywords, page_content, link_order, display_mode + 0 AS display_mode
            FROM %s WHERE section_id = %d',
            TABLE_SECTIONS,
            $sectionID));

        return $queryData[0];
    }

    public function getSectionWithUID($urlID) {
        $queryData = $this->fetchQuery(sprintf(
            'SELECT section_id, url_id, link_title, html_title, html_description,
            html_keywords, page_content, link_order, display_mode + 0 AS display_mode
            FROM %s WHERE url_id = "%s"',
            TABLE_SECTIONS,
            $this->esc($urlID)));

        return $queryData[0];
    }

    public function getSections() {
        return $this->fetchQuery(sprintf(
            'SELECT section_id, url_id, link_title, display_mode + 0 AS display_mode
            FROM %s ORDER BY link_order, link_title',
            TABLE_SECTIONS));
    }

    public function addSection(array $data) {
        $this->query(sprintf('INSERT INTO %s (section_id, url_id, link_title, html_title,
            html_description, html_keywords, page_content, link_order, display_mode)
            VALUES(NULL, "%s", "%s", "%s", "%s", "%s", "%s", %d, %d)',
            TABLE_SECTIONS,
            $this->esc($data['url_id']),
            $this->esc($data['link_title']),
            $this->esc($data['html_title']),
            $this->esc($data['html_description']),
            $this->esc($data['html_keywords']),
            $this->esc($data['page_content']),
            $data['link_order'],
            $data['display_mode']));

        return $this->getConn()->insert_id;
    }

    public function editSection($sectionID, array $data) {
        $this->query(sprintf(
            'UPDATE %s SET url_id = "%s", link_title = "%s", html_title = "%s",
            html_description = "%s", html_keywords = "%s", page_content = "%s",
            link_order = %d, display_mode = %d WHERE section_id = %d',
            TABLE_SECTIONS,
            $this->esc($data['url_id']),
            $this->esc($data['link_title']),
            $this->esc($data['html_title']),
            $this->esc($data['html_description']),
            $this->esc($data['html_keywords']),
            $this->esc($data['page_content']),
            $data['link_order'],
            $data['display_mode'],
            $sectionID));
    }

    public function deleteSection($sectionID) {
        $this->query(sprintf('DELETE FROM %s WHERE section_id = %d',
            TABLE_SECTIONS,
            $sectionID));
    }
}

?>
