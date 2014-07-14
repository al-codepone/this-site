<?php

namespace thissite\db;

class PageModel extends \pjsql\DatabaseAdapter {
    public function install() {
        $this->exec('CREATE TABLE tpage (
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

    public function create($data) {
        if($this->getWithUID($data['url_id'])) {
            return urlTaken($data['url_id']);
        }

        $this->exec(sprintf(
            'INSERT INTO tpage (url_id, link_title, html_title,
                html_description, html_keywords, page_content, link_order, display_mode)
            VALUES("%s", "%s", "%s", "%s", "%s", "%s", %d, %d)',
            $this->esc($data['url_id']),
            $this->esc($data['link_title']),
            $this->esc($data['html_title']),
            $this->esc($data['html_description']),
            $this->esc($data['html_keywords']),
            $this->esc($data['page_content']),
            $data['link_order'],
            $data['display_mode']));

        return $this->conn()->insert_id;
    }

    public function getMaxLinkOrder() {
        $queryData = $this->query('SELECT MAX(link_order) AS max FROM tpage');
        return intval($queryData[0]['max']);
    }

    public function getWithPID($pageID) {
        return $this->get(sprintf('page_id = %d', $pageID));
    }

    public function getWithUID($urlID) {
        return $this->get(sprintf('url_id = "%s"', $this->esc($urlID)));
    }

    public function getPages() {
        return $this->query(
            'SELECT page_id, url_id, link_title, display_mode + 0 AS display_mode
            FROM tpage
            ORDER BY link_order, link_title');
    }

    public function update($pageID, $data) {
        $duplicateCheck = $this->getWithUID($data['url_id']);

        if($duplicateCheck && $duplicateCheck['page_id'] != $pageID) {
            return urlTaken($data['url_id']);
        }

        $this->exec(sprintf(
            'UPDATE tpage SET url_id = "%s", link_title = "%s", html_title = "%s",
                html_description = "%s", html_keywords = "%s", page_content = "%s",
                link_order = %d, display_mode = %d
            WHERE page_id = %d',
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

    public function delete($pageID) {
        $this->exec(sprintf('DELETE FROM tpage WHERE page_id = %d',
            $pageID));
    }

    protected function get($condition) {
        $queryData = $this->query(sprintf(
            'SELECT page_id, url_id, link_title, html_title, html_description,
                html_keywords, page_content, link_order, display_mode + 0 AS display_mode
            FROM tpage
            WHERE %s',
            $condition));

        return $queryData[0];
    }
}
