<!doctype html>
<html lang="en">
    <head>
        <title><?= isset($title) ? $title : APP_NAME ?></title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link href="/assets/css/site.css" rel="stylesheet" />
    </head>
    <body>
        <?php include_view('partials/navbar'); ?>
        <div class="container container-fixed content">
            <?php include_view('partials/flash_message'); ?>
            <?php include $view_path; ?>
            <?php include_view('partials/footer'); ?>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="/assets/js/site.js"></script>
    </body>
</html>