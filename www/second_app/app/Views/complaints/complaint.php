<?php $this->extend('base');
$this->section('content');

echo "<article>";
if(isset($complaint)){
    echo "<h3 class='mb-4'>{$complaint['title']}</h3>";
          $text = explode(PHP_EOL,$complaint['content']);
          foreach ($text as $p){
              echo "<p class='mb-3'>{$p}</p>";
          }
}
?>
</article>
<?php if(session()->get('id_category')==1):?>
<form action="/listComplaint" method="post">
    <input class="btn btn-primary" type="submit" name="send" value="К списку отзывов">
</form>
<?php endif;

if(session()->get('id_category')==2):?>
<form action="/listActiveComplaints" method="post">
    <input class="btn btn-primary" type="submit" name="send" value="К списку отзывов">
</form>
<?php endif;
$this->endSection();?>
