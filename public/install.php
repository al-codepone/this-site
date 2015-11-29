<?php

require 'boot.php';

use thissite\db\ModelFactory;

$page_model = ModelFactory::get('thissite\db\PageModel');
$page_model->install();

printf('Install successful. <a href="%s">Visit CMS</a>.', NEW_PAGE);
