<?php $this->extend('base');
$this->section('content');

echo "<article>";
if(isset($complaint)):?>
    <h3 class='mb-4 text-center'><?=$complaint['title']?></h3>

    <div><?=$complaint['content']?></div>

<?  endif; ?>

</article>
<?php if(session()->get('id_category')==1):?>
<form action="/listComplaint" method="post" class="mt-5">
    <input class="btn btn-primary" type="submit" name="send" value="К списку отзывов">
</form>
<?php endif;

if(session()->get('id_category')==2):?>
<form action="/listActiveComplaints" method="post" class="mt-5">
    <input class="btn btn-primary" type="submit" name="send" value="К списку отзывов">
</form>
<?php endif;
$this->endSection();?>
