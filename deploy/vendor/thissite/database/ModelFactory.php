<?php

namespace thissite\database;

use cityphp\db\AdapterFactory;
use cityphp\db\Mysql;

class ModelFactory extends AdapterFactory {
    protected static function getDatabaseHandle() {
        return new Mysql(
            DATABASE_HOST,
            DATABASE_USERNAME,
            DATABASE_PASSWORD,
            DATABASE_NAME);
    }
}

?>
