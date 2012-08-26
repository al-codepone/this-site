<?php

require_once(CITYPHP . 'database/ModelFactory.php');
require_once(CITYPHP . 'database/MySqlDatabaseHandle.php');
require_once(THIS_SITE_PHP . 'database/SectionModel.php');

class MyModelFactory extends ModelFactory {
    protected static function getDatabaseHandle() {
        return new MySqlDatabaseHandle(
            DATABASE_HOST,
            DATABASE_USERNAME,
            DATABASE_PASSWORD,
            DATABASE_NAME);
    }
}

?>
