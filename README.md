# this site

this site is a simple webpage CMS. It's built with PHP, MySQL and [cityphp](https://github.com/al-codepone/cityphp).

## Installation

Put the [cityphp directory](https://github.com/al-codepone/cityphp/tree/master/cityphp) on your web server. Create a MySQL database for your application. Set these variables in `deploy/const.php`:

- `VENDOR` - absolute paths pointing to the directories that contain the `cityphp` directory and the `thissite` directory. Separate paths with whitespace. This is for autoloading.
- `CITYPHP` - an absolute path pointing to the `cityphp` directory. This is for manually loading files.
- `THISSITE` - an absolute path pointing to the `thissite` directory. This is for manually loading files.
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
