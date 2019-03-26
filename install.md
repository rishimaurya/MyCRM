# MyCRM
My CRM is Customer Relationship Management Software developed using PHP and Codeigniter Framework.
Customer relationship management (CRM) is an approach to manage a company's interaction with current and potential customers. It uses data analysis about customers' history with a company to improve business relationships with customers, specifically focusing on customer retention and ultimately driving sales growth.

Installation
------------

MyCRM is written in PHP using the CodeIgniter framework. You
should find it easy to install provided you have access to a webserver and a
database.

The code generally expects to be running under an Apache webserver with a
mySQL database. It may be possible change these things if your system
is different -- see the installation documentation:



Quickstart
----------

If you're familiar with PHP CodeIgniter (or possibly just PHP!) you might be
able to get things going just by dropping the repository somewhere under your
server root. (In fact, for a super quickstart, set up your webserver so that
`web/` *is* the server root).

In the 'application/config/config.php' change the '$config['base_url']' as :
$config['base_url'] = 'http://localhost/mydirectory/'; or
$config['base_url'] = 'http://example.com/';

In the 'application/config/databse.php' change the credentials as :
'username' : 'myUsername',
'password' : 'myPassword',

After modifying the above files open the http://localhost/mydirectory/' or 
'http://example.com/' in your browser and login with the following credentials.

  * username: `admin`
  * password: `password`

You must to change these values as soon as you're logged in! The root page 
will tell you how (until you've done it).
