<?php

namespace thissite\db;

class PageModel extends \pjsql\DatabaseAdapter {
    public function install() {
        $this->exec('
            CREATE TABLE
                tpage(
                page_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                url_id VARCHAR(64),
                link_title VARCHAR(64),
                html_title VARCHAR(128),
                html_description TEXT,
                html_keywords TEXT,
                page_content TEXT,
                link_order MEDIUMINT SIGNED,
                display_mode ENUM("show_all", "hide_link", "hide_all"),
                KEY(url_id))
            ENGINE = MYISAM');
    }

    public function create($data) {

        //
        $data = normalize_page_form_data($data);

        //
        if($this->getWithUID($data['url_id'])) {
            return url_taken($data['url_id']);
        }

        $this->exec('
            INSERT INTO
                tpage(url_id, link_title, html_title,
                html_description, html_keywords,
                page_content, link_order, display_mode)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, ?)',
            $data['url_id'],
            $data['link_title'],
            $data['html_title'],
            $data['html_description'],
            $data['html_keywords'],
            $data['page_content'],
            $data['link_order'],
            $data['display_mode']);

        return $this->conn()->insert_id;
    }

    public function getMaxLinkOrder() {
        $data = $this->query('
            SELECT
                MAX(link_order) AS max
            FROM
                tpage');

        return intval($data[0]['max']);
    }

    public function getWithPID($pageID) {
        $data = $this->query("
            SELECT
                page_id, url_id, link_title, html_title,
                html_description, html_keywords, page_content,
                link_order, display_mode + 0 AS display_mode
            FROM
                tpage
            WHERE
                page_id = ?",
            $pageID);

        return $data[0];
    }

    public function getWithUID($urlID) {
        $data = $this->query("
            SELECT
                page_id, url_id, link_title, html_title,
                html_description, html_keywords, page_content,
                link_order, display_mode + 0 AS display_mode
            FROM
                tpage
            WHERE
                if(isnull(?), isnull(url_id), url_id = ?)",
            $urlID, $urlID);

        return $data[0];
    }

    public function getPages() {
        return $this->query('
            SELECT
                page_id,
                url_id,
                link_title,
                display_mode + 0 AS display_mode
            FROM
                tpage
            ORDER BY
                link_order,
                link_title');
    }

    public function update($pageID, $data) {

        //
        $data = normalize_page_form_data($data);

        //
        $duplicateCheck = $this->getWithUID($data['url_id']);

        if($duplicateCheck && $duplicateCheck['page_id'] != $pageID) {
            return url_taken($data['url_id']);
        }

        $this->exec('
            UPDATE
                tpage
            SET
                url_id = ?,
                link_title = ?,
                html_title = ?,
                html_description = ?,
                html_keywords = ?,
                page_content = ?,
                link_order = ?,
                display_mode = ?
            WHERE
                page_id = ?',
            $data['url_id'],
            $data['link_title'],
            $data['html_title'],
            $data['html_description'],
            $data['html_keywords'],
            $data['page_content'],
            $data['link_order'],
            $data['display_mode'],
            $pageID);
    }

    public function delete($pageID) {
        $this->exec('
            DELETE FROM
                tpage
            WHERE
                page_id = ?',
            $pageID);
    }
}
