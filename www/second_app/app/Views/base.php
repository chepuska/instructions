<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="yandex-verification" content="2457f8b6a2233e9e" />

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link  href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" rel="stylesheet">
    <link  href="/assets/css/headers.css" rel="stylesheet">
    <link  href="/assets/css/style.css" rel="stylesheet">
    <?php $this->renderSection('styles')?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(84655660, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/84655660" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->




    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
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

</head>
<body class="flex-wrapper">
<!--header-->
<div class="pt-3">
    <div class="container ">
        <?= $this->include('templates/header') ?>
    </div>

</div>

<!--content-->
<div>
    <div class="container">
        <div class="row pb-5 pt-5">
            <div class="col-8 "><?php $this->renderSection('content');?></div>
            <div class="col-4"><?= $this->include('templates/aside') ?></div>
        </div>
    </div>
</div>

<!--footer-->
<div class="footer-style">
    <div class="container ">
        <?= $this->include('templates/footer') ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<?=$this->renderSection('scripts');?>

</body>
</html>
