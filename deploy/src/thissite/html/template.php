<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width"/>
        <link rel="stylesheet" href="<?=CSS?>styles.css"/>
        <script src="<?=JS?>all.js"></script>
        <?=$head?>
    </head>
    <body>
        <div id="alt-nav"><?=$selectNav?></div>
        <div id="nav"><?=$listNav?></div>
        <div id="content"><?=$content?></div>
        <div id="floor"></div>
        <?=$autofocus?>
    </body>
</html>
