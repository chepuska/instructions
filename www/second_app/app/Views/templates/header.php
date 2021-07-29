<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/" class="nav-link px-2 link-dark">Главная</a></li>
            <li>
                <?php

                    if(session() && session()->get('id_category') == 1 && session()->get('status')==='active'){
                        echo "<a href='/listCategory' class='nav-link px-2 link-dark'>Инструкции</a>";
                    } elseif( (session()->get('id_category') == 2 && session()->get('status')==='active') || session()->get('is_logged')!=='true') {
                    echo "<a href='/listActive' class='nav-link px-2 link-dark'>Инструкции</a>";
                }
                 ?>
                        </li>

            <li><a href="/about" class="nav-link px-2 link-dark">О нас</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <p class="btn me-2 align-baseline"><? echo session()->get('username')?></p>
            <a href="/login" class="btn btn-outline-primary me-2">Login</a>
            <?php if(session()->get('status')==='active'){
                echo "<a href='/logout' class='btn btn-primary'>Logout</a>";
            }else{
                echo "<a href='/register' class='btn btn-primary'>Sign-up</a";
            }
            ?>

        </div>
    </header>
</div>
