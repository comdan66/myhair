<div class='picture'>
  <div class='img'>
    <img src='<?php echo $picture->file_name->url ();?>' />
  </div>
  <div class='user'>
    <div class='avatar'>
      <img src='<?php echo $picture->user->avatar->url ();?>' />
    </div>
    <div class='name'><?php echo $picture->user->name;?></div>
  </div>
  <div class='introduction'><?php echo $picture->introduction;?></div>
  <div class='info'>
    <div class='l'>人氣 <?php echo $picture->pageview;?></div>
    <div class='r'>留言 <?php echo $picture->pageview;?></div>
  </div>
</div>