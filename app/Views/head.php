<head>
    <title>Fitness App</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>
    <?php if (isset($_COOKIE['token']) and $me = \App\Models\Member::me()) : ?>
    <style>
        body {
            background-color: <?php echo $me->color ?>;
        }
    </style>
    <?php endif ?>
</head>
