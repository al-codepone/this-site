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

## LICENSE

MIT <http://ryf.mit-license.org/>
