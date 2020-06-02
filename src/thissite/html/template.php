<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="<?=CSS_FILE?>"/>
        <?=$t_head?>
    </head>
    <body>
        <div id="main">
            <div id="logo"><a href="<?=ROOT?>"><img src="<?=IMG?>logo.png" width="<?=LOGO_WIDTH?>" height="<?=LOGO_HEIGHT?>"/></a></div>
            <div id="alt-logo"><a href="<?=ROOT?>"><img src="<?=IMG?>alt-logo.png" width="<?=ALT_LOGO_WIDTH?>" height="<?=ALT_LOGO_HEIGHT?>"/></a></div>
            <?=$t_select_nav?>
            <?=$t_list_nav?>
            <div id="content"><?=$t_content?></div>
            <div id="floor"></div>
        </div>
        <?=$t_last?>
    </body>
</html>
