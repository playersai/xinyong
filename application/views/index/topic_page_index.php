
  <div class="clear"></div>
  
  <div style="background: #FFF;width: 1098px;border: 1px solid #ddd;border-top: 2px solid #0067ad;
padding: 20px;margin-top:20px;height:auto;min-height:500px;">
  <ul style="width:100%">
  <?php foreach($rows as $aval):?>
    <li style="display: block;float:left;width:100%;border-bottom:1px #ddd dashed;height:40px;line-height:40px;font-size:16px;color: #555;">
	  <a href="/index.php/topic_page/index/<?php echo $aval->cat_id;?>" target="_blank"><span style="float:right;wdith:80px;padding:0;"><?php echo date("Y-m-d",$aval->addtime); ?></span><span style="float:left;width:80%"><?php echo $aval->name; ?></span>
    </a></li>
  <?php endforeach;?>
  </ul>

    <div class="clear"></div>
  <div class="page">
      
      共<span style="color:#f00;"><?php echo $totalRows; ?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages; ?></span>页显示
      
      <?php echo $pageLink; ?>
      
      </div>    
  <div>
  
  </div>  </div>
  
  </div>

