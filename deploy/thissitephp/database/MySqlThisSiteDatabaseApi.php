<?php

require_once(CITY_PHP . 'database/MySqlDatabaseHandle.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');
require_once(THIS_SITE_PHP . 'database/ThisSiteDatabaseApi.php');

class MySqlThisSiteDatabaseApi extends ThisSiteDatabaseApi {
    public function __construct(MySqlDatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle);
    }

    public function install() {
        $query = sprintf('CREATE TABLE %s (
            section_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            url_id VARCHAR(64) NOT NULL DEFAULT "",
            link_title VARCHAR(64) NOT NULL DEFAULT "",
            html_title VARCHAR(128) NOT NULL DEFAULT "",
            html_description TEXT NOT NULL DEFAULT "",
            content TEXT NOT NULL DEFAULT "",
            link_order MEDIUMINT SIGNED NOT NULL DEFAULT 1,
            display_mode ENUM("showall", "hidelink", "hideall") NOT NULL,
            PRIMARY KEY (section_id),
            KEY (url_id))',
            self::TABLE_SECTIONS);

        $this->writeQuery($query);
    }

    public function getMaxLinkOrder() {
        $query = sprintf('SELECT MAX(link_order) AS max FROM %s', self::TABLE_SECTIONS);
        $queryData = $this->readQuery($query);
        return intval($queryData[0]['max']);
    }

    public function getSectionWithSID($sectionID) {
        $query = sprintf('SELECT section_id, url_id, link_title, html_title,
            html_description, content, link_order, display_mode + 0 AS display_mode
            FROM %s WHERE section_id = %d',
            self::TABLE_SECTIONS,
            $sectionID);

        return $this->getSectionWithQuery($query);
    }

    public function getSectionWithUID($urlID) {
        $query = sprintf('SELECT section_id, url_id, link_title, html_title,
            html_description, content, link_order, display_mode + 0 AS display_mode
            FROM %s WHERE url_id = "%s"',
            self::TABLE_SECTIONS,
            $this->escapeString($urlID));

        return $this->getSectionWithQuery($query);
    }

    public function getSections() {
        $query = sprintf('SELECT section_id, url_id, link_title, display_mode + 0 AS display_mode
            FROM %s ORDER BY link_order, link_title',
            self::TABLE_SECTIONS);

        $queryData = $this->readQuery($query);
        $sections = array();
        foreach($queryData as $data) {
            $sections[] = new SectionData($data['section_id'], $data['url_id'], $data['link_title'], '', '', '', 1, $data['display_mode']);
        }

        return $sections;
    }

    public function addSection(SectionData $sectionData) {
        $query = sprintf('INSERT INTO %s
            (section_id, url_id, link_title, html_title, html_description, content, link_order, display_mode)
            VALUES(NULL, "%s", "%s", "%s", "%s", "%s", %d, %d)',
            self::TABLE_SECTIONS,
            $this->escapeString($sectionData->url_id),
            $this->escapeString($sectionData->link_title),
            $this->escapeString($sectionData->html_title),
            $this->escapeString($sectionData->html_description),
            $this->escapeString($sectionData->content),
            $sectionData->link_order,
            $sectionData->display_mode);

        $this->writeQuery($query);
        return $this->getConn()->insert_id;
    }

    public function editSection(SectionData $sectionData) {
        $query = sprintf('UPDATE %s SET url_id = "%s", link_title = "%s", html_title = "%s",
            html_description = "%s", content = "%s", link_order = %d, display_mode = %d WHERE section_id = %d',
            self::TABLE_SECTIONS,
            $this->escapeString($sectionData->url_id),
            $this->escapeString($sectionData->link_title),
            $this->escapeString($sectionData->html_title),
            $this->escapeString($sectionData->html_description),
            $this->escapeString($sectionData->content),
            $sectionData->link_order,
            $sectionData->display_mode,
            $sectionData->section_id);

        $this->writeQuery($query);
    }

    public function deleteSection($sectionID) {
        $query = sprintf('DELETE FROM %s WHERE section_id = %d',
            self::TABLE_SECTIONS,
            $sectionID);

        $this->writeQuery($query);
    }
}

?>
