## About Customer Uploader

This project helps users upload their json file into the database using a background job

## How to use

-   SetUp the laravel project locally, install mongodb on your machine and add the credentials to your env file

-   Start the project

-   Your file will be uploaded through an html form access the form on "/" route
    after the file is uploaded.

-   Call "/store-data" to start the uploading process, make sure your queue worker is up.

## License

MIT
