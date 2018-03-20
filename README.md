<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Walla shorten url admin and rest server</h1>
    <br>
</p>


REQUIREMENTS
------------

To run the php Yii2 admin and rest API:

1. Clone this repo into a stack such as XAMP LAMP AMPPS or any web server which runs PHP.

2. Run composer install. (requires php 7.1.* and up)

3. Set up MySQL server and import the provided .sql file.

4. In the config/db.php file change the 'dsn', 'username', and 'password' to your database credentials

5. Point your browser to http://localhost/shorten-url-admin/web/admin. (in reall world we will point it to http://example.com/admin)

WHAT WE GET
-----------
If all went well..

1. You should see the Walla urls dashboard with all the CRUD operations as well as sorting and filtering.

2. This server is also an REST API server with the following endpoints (can use postman)

  GET http://localhost/shorten-url-admin/web/urls.................... lists all urls data;

  POST http://localhost/shorten-url-admin/web/urls................... creates a new url;

       data can be sent as raw JSON string
       {
           "original_url": "http://www.yiiframework.com/doc-2.0/yii-web-jsonparser.html",
           "short_url": "qaqws",
           "date_created": "12",
           "counter": "2"
       }


  GET http://localhost/shorten-url-admin/web/urls/123................... returns the details of the url 123;

  PATCH http://localhost/shorten-url-admin/web/urls/123 and PUT......... updates url 123;

  DELETE http://localhost/shorten-url-admin/web/urls/123................ deletes the url 123;



