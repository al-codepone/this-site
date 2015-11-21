<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="<?=CSS?>styles.css"/>
        <script src="<?=JS?>all.js"></script>
        <?=$head?>
    </head>
    <body>
        <div id="main">
            <div id="logo"><a href="<?=ROOT?>"><img src="<?=IMG?>logo.png" width="94" height="90"/></a></div>
            <div id="alt-logo"><a href="<?=ROOT?>"><img src="<?=IMG?>alt-logo.png" width="78" height="78"/></a></div>
            <div id="alt-nav"><?=$selectNav?></div>
            <div id="nav"><?=$listNav?></div>
            <div id="content"><?=$content?></div>
            <div id="floor"></div>
        </div>
        <?=$autofocus?>
    </body>
</html>
