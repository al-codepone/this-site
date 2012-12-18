<?php

require_once(CITYPHP . 'database/AdapterFactory.php');
require_once(CITYPHP . 'database/MySqlDatabaseHandle.php');
require_once(THIS_SITE . 'database/PageModel.php');

class ModelFactory extends AdapterFactory {
    protected static function getDatabaseHandle() {
        return new MySqlDatabaseHandle(
            DATABASE_HOST,
            DATABASE_USERNAME,
            DATABASE_PASSWORD,
            DATABASE_NAME);
    }
}

?>
