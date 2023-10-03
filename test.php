<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script type="module">
        import { fetchJSON } from './client-functions.js'

        var url = window.location.href;
        //var url = window.location.href + 'Server Config/main-config.json';
        //var path = url + '../';

        console.log(url);

        // file = fetchJSON(path, function(data) {
        //     console.log(data);
        // });
        
    </script>
</body>
</html>