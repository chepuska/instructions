<div class="aside bord p-4">

    <div class="list-group ">
        <?php

        if(session() && session()->get('id_category') == 2 && session()->get('status')==='active'){
            echo "<a class='list-group-item' href='/create'>Загрузить инструкцию</a>";
            echo "<a class='list-group-item' href='/profile'>Личная страница</a>";
            echo "<a class='list-group-item' href='/listActiveComplaints'>Отзывы</a>";
        }
        ?>

        <?php
        if(session() && session()->get('id_category') == 1 && session()->get('status')==='active'){
            echo "<h4>Администрирование</h4>";
            echo "<a class='list-group-item' href='/newUser'>Добавить нового пользователя</a>";
            echo "<a class='list-group-item' href='/users'>Список пользователей</a>";
            echo "<a class='list-group-item' href='/create'>Загрузить инструкцию</a>";
            echo "<a class='list-group-item' href='/listCategory'>Все инструкции по разделам</a>";
            echo "<a class='list-group-item' href='/listComplaint'>Отзывы</a>";
        }
        ?>
    </div>

    <form action="/search" method="post">
        <div class="mb-3 mt-3">
            <label class="form-label" for="search">Поиск инструкции</label>
            <input class="form-control search" type="text" name="search" id="search" placeholder="Введите название прибора">
        </div>
       <div>
           <button class="w-100 btn btn-lg btn-primary send" type="submit" disabled>Поиск</button>
       </div>
    </form>

    <?php $this->section('scripts');?>
    <script src="/assets/js/aside.js"></script>
    <?= $this->endSection()?>

</div>