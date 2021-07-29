<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/headers.css">
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
<!--    <script src="https://www.google.com/recaptcha/api.js"></script>-->
    <script></script>
</head>
<body>
<!--header-->
<?= $this->include('templates/header') ?>

<!--content-->
<div class="container ">
    <div class="row">
        <div class="col-8 "><?php $this->renderSection('content');?></div>
        <div class="col-4"><?= $this->include('templates/aside') ?></div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<?=$this->renderSection('scripts');?>

</body>
</html>
