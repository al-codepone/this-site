# This Site

This Site is a small web page CMS written in PHP/MySQL.
For each page you can specify a navigation link, a URL,
content, meta-data, page order and public/private. You
can also set the page content using PHP instead of typing
text into the CMS.

The current release is still in development.
This README is unfinished.

## Documentation

This [README](https://github.com/al-codepone/this-site/blob/master/README.md)
is currently the only documentation.

## Requirements

**PHP 5.3** or higher, [Composer](https://getcomposer.org/)
and [Mysqli](http://www.php.net/manual/en/book.mysqli.php).

## Source Code

The source code for this project is [available on GitHub]
(https://github.com/al-codepone/this-site).

## Installation

Grab all the files using the `composer create-project` command:

    composer create-project this-site/this-site my-dir dev-master

Create a new MySQL database for the application.

Set the following constants in `const.php`:

- `SRC` - absolute path to the `src` directory
- `ROOT` - absolute web path to the directory that the `public` files are in
- `MYSQL_HOST` - the MySQL host
- `MYSQL_USERNAME` - your MySQL username
- `MYSQL_PASSWORD` - your MySQL password
- `MYSQL_DBNAME` - your MySQL database name

In `public/boot.php` change the two paths so that they correctly point to `const.php` and `autoload.php`. Use absolute paths.

Browse to `install.php`. You should see a success message and a link to the CMS.

##Using The CMS

You can use the CMS to create new web pages and edit existing
web pages. Here are all the fields available for each page and
a description of each:

- `Link Title` - The text used for the page's navigation link.
- `URL ID` - The identifier used in the page's URL. This can be blank for one page(usually your first page).
- `HTML Head Title` - The page title. This will show in the browser tab and search engine results.
- `HTML Meta Description` - The page description. This will show in search engine results.
- `HTML Meta Keywords` - The page's keywords. This should be words and phrases separated by commas. Search engines use these keywords.
- `Page Content` - The content that is displayed on the page.
- `Link Order` - An integer for the navigation link order. Pages with a lower value will be first in the navigation.
- `Display Mode` - The display mode of the page. `Show All` displays the navigation link and the page. `Hide Link` hides the navigation link but the page still displays. `Hide All` hides both the navigation link and the page.

When you finish creating a page, finish editing a page or are
editing a page there will be a link to the public page. So it
is always easy to go from the CMS to the public site in order
to see what your pages look like.

##Using PHP To Set The Page Content

You can call a PHP script instead of simply displaying your page content.
This is useful if you want to programmatically generate your page or handle
form submissions.

In the CMS in the `Page Content` box enter only a PHP script, for example
enter something like "my-script.php". Then when the public page displays
this script will be called from the directory indicated by the `PAGE_ROUTES`
constant that is in `const.php`.

In your PHP script you will want to set the `$t_content` variable. You can also
set `$t_head` and `$t_last`. Here's an example script that sets `$t_content`:

```php
$tenk = implode(', ', range(1, 10000));
$t_content = "<p>$tenk</p>";
```

You can see where `$t_content`, `$t_head` and `$t_last` are placed in the HTML
by looking at `src/thissite/html/template.php`.

##Themes

The easiest way to change the theme is to change the colors and the logos. All
the colors are in `public/css/default.css`; you can find them all by searching
for ": #". The logo images that you want to replace are in `public/img/`. When
you replace the logo images be sure to update their dimensions in
`src/thissite/html/template.php` on lines 12 and 13.

## LICENSE

MIT <http://ryf.mit-license.org/>
