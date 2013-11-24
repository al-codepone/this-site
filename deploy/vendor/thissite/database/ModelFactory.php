<?php

namespace thissite\database;

use cityphp\db\AdapterFactory;
use cityphp\db\Mysql;

class ModelFactory extends AdapterFactory {
    protected static function getDatabaseHandle() {
        return new Mysql(
            DB_HOST,
            DB_USERNAME,
            DB_PASSWORD,
            DB_NAME);
    }
}

?>
