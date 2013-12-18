<?php

namespace thissite\db;

use cityphp\db\AdapterFactory;
use cityphp\db\Mysql;

class ModelFactory extends AdapterFactory {
    protected static function databaseHandle() {
        return new Mysql(
            MYSQL_HOST,
            MYSQL_USERNAME,
            MYSQL_PASSWORD,
            MYSQL_NAME,
            null,
            null,
            'database error',
            MYSQL_DEBUG);
    }
}

?>
