<?php

require_once('./constants.php');
require_once(THIS_SITE_PHP . 'database/DatabaseApi.php');

$databaseApi = new DatabaseApi();
$databaseApi->install();

printf('Install successful. <a href="%s">Visit CMS</a>.', NEW_SECTION);

?>
