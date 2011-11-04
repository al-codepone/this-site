<?php

require_once(CITY_PHP . 'database/DatabaseAdapter.php');
require_once(THIS_SITE_PHP . 'database/IThisSiteDatabaseApi.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');

abstract class ThisSiteDatabaseApi extends DatabaseAdapter implements IThisSiteDatabaseApi {
    protected function getSectionWithQuery($query) {
        $queryData = $this->readQuery($query);

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
