
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-4 border-bottom ">
    <a class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none"></a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-5 link-dark">Главная</a></li>
        <li>
            <?php

                if(session()->get('id_category') == 1){
                    echo "<a href='/listCategory' class='nav-link px-2 link-dark'>Инструкции</a>";
                } elseif( ((session()->get('id_category') == 2 && session()->get('status') == 1) )|| session()->get('is_logged')!=='true') {
                echo "<a href='/listActive' class='nav-link px-2 link-dark'>Инструкции</a>";
            }
             ?>
                    </li>

        <li><a href="/about" class="nav-link px-2 link-dark">О нас</a></li>
    </ul>

    <div class="col-md-3 text-end">

        <?php if(session()->get('id')==null): ?>
            <a href="/login" class="btn btn-outline-primary me-2">Login</a>
        <?php else:?>
            <a href="/profile" class="btn btn-outline-primary me-2">Profile</a>
        <?php endif; ?>


        <?php if(session()->get('status')==1){
            echo "<a href='/logout' class='btn btn-primary'>Logout</a>";
        }else{
            echo "<a href='/register' class='btn btn-primary'>Sign-up</a";
        }
        ?>

    </div>
</header>

