<?php

require_once(CITYPHP . 'database/DatabaseAdapter.php');
require_once(THIS_SITE . 'urlTaken.php');

class PageModel extends DatabaseAdapter {
    public function install() {
        $this->query('CREATE TABLE ' . TABLE_PAGES . ' (
            page_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            url_id VARCHAR(64),
            link_title VARCHAR(64),
            html_title VARCHAR(128),
            html_description TEXT,
            html_keywords TEXT,
            page_content TEXT,
            link_order MEDIUMINT SIGNED,
            display_mode ENUM("show_all", "hide_link", "hide_all"),
            PRIMARY KEY(page_id),
            KEY(url_id))
            ENGINE = MYISAM');
    }

    public function createPage($data) {
        if($this->getPageWithUID($data['url_id'])) {
            return urlTaken($data['url_id']);
        }

        $this->query(sprintf('INSERT INTO %s (url_id, link_title, html_title,
            html_description, html_keywords, page_content, link_order, display_mode)
            VALUES ("%s", "%s", "%s", "%s", "%s", "%s", %d, %d)',
            TABLE_PAGES,
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

    public function getMaxLinkOrder() {
        $queryData = $this->fetchQuery('SELECT MAX(link_order) AS max FROM ' . TABLE_PAGES);
        return intval($queryData[0]['max']);
    }

    public function getPageWithPID($pageID) {
        return $this->getPage(sprintf('page_id = %d', $pageID));
    }

    public function getPageWithUID($urlID) {
        return $this->getPage(sprintf('url_id = "%s"', $this->esc($urlID)));
    }

    public function getPages() {
        return $this->fetchQuery(sprintf(
            'SELECT page_id, url_id, link_title, display_mode + 0 AS display_mode
            FROM %s ORDER BY link_order, link_title',
            TABLE_PAGES));
    }

    public function updatePage($pageID, $data) {
        $duplicateCheck = $this->getPageWithUID($data['url_id']);

        if($duplicateCheck && $duplicateCheck['page_id'] != $pageID) {
            return urlTaken($data['url_id']);
        }

        $this->query(sprintf(
            'UPDATE %s SET url_id = "%s", link_title = "%s", html_title = "%s",
            html_description = "%s", html_keywords = "%s", page_content = "%s",
            link_order = %d, display_mode = %d WHERE page_id = %d',
            TABLE_PAGES,
            $this->esc($data['url_id']),
            $this->esc($data['link_title']),
            $this->esc($data['html_title']),
            $this->esc($data['html_description']),
            $this->esc($data['html_keywords']),
            $this->esc($data['page_content']),
            $data['link_order'],
            $data['display_mode'],
            $pageID));
    }

    public function deletePage($pageID) {
        $this->query(sprintf('DELETE FROM %s WHERE page_id = %d',
            TABLE_PAGES,
            $pageID));
    }

    protected function getPage($condition) {
        $queryData = $this->fetchQuery(sprintf(
            'SELECT page_id, url_id, link_title, html_title, html_description,
            html_keywords, page_content, link_order, display_mode + 0 AS display_mode
            FROM %s WHERE %s',
            TABLE_PAGES,
            $condition));

        return $queryData[0];
    }
}

?>
