<?php

require_once(CITY_PHP . 'database/MySqlDatabaseHandle.php');
require_once(THIS_SITE_PHP . 'database/MySqlThisSiteDatabaseApi.php');

class ThisSiteDatabaseApiFactory {
    public static function getDatabaseApi() {
        $databaseHandle = new MySqlDatabaseHandle(MYSQL_DATABASE_HOST,
            MYSQL_DATABASE_USERNAME,
            MYSQL_DATABASE_PASSWORD,
            MYSQL_DATABASE_NAME);
        return new MySqlThisSiteDatabaseApi($databaseHandle);
    }
}

?>
