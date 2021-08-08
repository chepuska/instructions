<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="/assets/css/iconsfonts.css">
    <link rel="stylesheet" href="/assets/css/headers.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <?php $this->renderSection('styles')?>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        .bord{
            border: 1px solid silver;
            box-shadow: 2px 2px 5px #2e3436;
            border-radius: 10px;
        }
        a{
            cursor:pointer;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    <title> <?php $this->renderSection('title');?></title>

    <script></script>
</head>
<body class="flex-wrapper">
<!--header-->
<div class="container">
    <?= $this->include('templates/header') ?>
</div>

<!--content-->
<div class="container">
    <div class="row">
        <div class="col-8 "><?php $this->renderSection('content');?></div>
        <div class="col-4"><?= $this->include('templates/aside') ?></div>
    </div>
</div>
<!--footer-->
<div class="container">
    <?= $this->include('templates/footer') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<?=$this->renderSection('scripts');?>

</body>
</html>
