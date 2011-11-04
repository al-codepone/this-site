<?php

require_once('./constants.php');
require_once(THIS_SITE_PHP . 'database/ThisSiteDatabaseApiFactory.php');

$databaseApi = ThisSiteDatabaseApiFactory::getDatabaseApi();
$databaseApi->install();

printf('Install successful. <a href="%s">Visit CMS</a>.', NEW_SECTION);

?>
