  <div class="clear"></div>
  
  <div class="topic_pic_list">
    <ul>
    <?php foreach ($rows as $row_item):?>
      <li><a href="/index.php/topic_page/thumb/<?php echo $row_item->photo_id.'/'.$row_item->cat_id; ?>" target="_blank"><img src="<?php echo $row_item->first_thumb;?>" width="180" height="135" border="0"><font><?php echo $row_item->title;?></font></a></li>
    <?php endforeach;?>
    </ul>
  </div>

  <div class="clear"></div>
  <div class="page">共<span style="color:#f00;"><?php echo $totalRows; ?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages; ?></span>页显示 <?php echo $pageLink; ?></div>

