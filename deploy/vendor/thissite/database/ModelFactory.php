<?php

namespace thissite\database;

use cityphp\database\AdapterFactory;
use cityphp\database\MySqlDatabaseHandle;

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
