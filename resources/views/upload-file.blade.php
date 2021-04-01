<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upload File</title>

    </head>
    <body class="antialiased">

        <form action="/upload" method="post" enctype="multipart/form-data">
        @csrf
          <input type="file" name="myJsonRecord" id="myJsonRecord"/>
          <input type="submit" value="Upload File"/>
        </form>
    </body>
</html>
