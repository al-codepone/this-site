# this site

`this site` is a simple webpage CMS. It's built with PHP, MySQL and [cityphp](https://github.com/al-codepone/cityphp). It has three different webpage layouts depending on the browser width: a two column layout, a single column layout with a navigation list and a single column layout with a navigation drop down.

## Installation

`this site` uses [composer](http://getcomposer.org) for installation. Run `composer install` in the `deploy` directory - this will download `cityphp` and create the autoloader. Next create a MySQL database for your application. Then set these variables in `deploy/const.php`:

- `ROOT` - an absolute path pointing to your web application root. For example, if the application is at `http://mysite.com/` then `ROOT` is `/`. As another example, if the application is at `http://mysite.com/myapp/` then `ROOT` is `/myapp/`.
- `MYSQL_HOST` - the MySQL database host
- `MYSQL_USERNAME` - the MySQL database username
- `MYSQL_PASSWORD` - the MySQL database password
- `MYSQL_NAME` - the MySQL database name

Disable magic quotes in the `cms` directory. Upload all the files in the `deploy` directory to the web application root on your web server. Using a web browser visit `install.php`. If the installation is successful, then you'll see a link to the CMS. Delete `install.php` from your web server and password protect the `cms` directory.

## Usage

Here is a description of each CMS field:

- `Link Title` - the navigation link title
- `URL ID` - the identifier used in the URL. This can be blank for one page(usually your first page).
- `HTML Head Title` - the HTML head title
- `HTML Meta Description` - the HTML meta description
- `HTML Meta Keywords` - the HTML meta keywords
- `Page Content` - the webpage content. It's recommended you use simple HTML(see below).
- `Link Order` - an integer for the navigation link order
- `Display Mode` - display mode of the page. `Show All` displays the navigation link and the page. `Hide Link` hides the navigation link but the page still displays. `Hide All` hides both the navigation link and the page.

For the CMS `Page Content` field it is recommended you use simple HTML. For example:

    <p>text here..</p>

Another example:

    <p>text here..</p>
    <img src='my-image.jpg'/>
    <p>another paragraph..</p>

Another example:

    <h1>Title</h1>
    <p>some text..</p>
