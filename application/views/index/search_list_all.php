  <div class="breadcrumb">您所在的位置：<a href="/index.php">首页</a> &gt;&gt;
    <span class="active">搜索结果</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="full_list">
    <div class="news_list2">
      <ul class="tab_conbox">
      <div class="search_info"><font>找到&nbsp;</font><span style="color:#f00;"><?php echo htmlspecialchars($query);?></span><font>&nbsp;相关信息&nbsp;&nbsp;共</font><span style="color:#f00;">&nbsp;<?php echo $totalRows;?>&nbsp;</span><font>条</font></div>
        <div class="clear"></div>
        <li class="tab_con">
        <?php foreach ($rows as $row_item): ?>
        <span>
        	<font><?php echo date("Y-m-d",$row_item->addtime);?></font>
        	<a href="
        	<?php 
        		$arr_zwgk = array(4,8,72,120,150);
        		$arr_ssbf = array(3,48);
        		$arr_jlhd = array(127);
        		switch ($row_item->cat_type_id){
        			case 1:
        				echo $row_item->page_url;
        				break;
        			case 2:
        				if(in_array($row_item->parent_id, $arr_zwgk))
        					echo "/index.php/open_goverment/view/article/".$row_item->aid;
        				else if (in_array($row_item->parent_id, $arr_ssbf))
        					echo "/index.php/landscape/article/".$row_item->aid.'/'.$row_item->parent_id;
        				else if (in_array($row_item->parent_id, $arr_jlhd))
        					echo "/index.php/interaction/article/".$row_item->aid.'/'.$row_item->parent_id;
        				break;
        			case 3:
        				break;
        		}
        	?>
        	" target="_blank">
        		<?php echo str_replace($query, '<sapn style="color:red">'.$query.'</sapn>', $row_item->title);?>
        	</a>
        </span>
        <?php endforeach;?>
        <div class="clear"></div>
        <div class="page">共<span style="color:#f00;"><?php echo $totalRows;?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages;?></span>页显示 <?php echo $pageLink; ?></div>
        </li>
      </ul>
    </div>
  </div>
</div>

