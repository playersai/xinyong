  <div class="clear"></div>
  <div id="landscape_flash">
    <div id="landscapePic"> 
      <?php foreach ($tjbf as $key=>$row_item):?>
	  <a href="/index.php/view/thumb/<?php echo $row_item->photo_id?>/<?php echo $row_item->cat_id ?>" target="_blank" style="<?php if($key==0){?>visibility: visible; display: block;<?php }else{?>visibility: hidden;display: none;<?php } ?>">
        <img class="Picture" src="<?php echo $row_item->thumb_path;?>" style="width: 600px; height: 320px;"/>
      </a> 
      <?php endforeach;?>
	  
	  <div class="subscript_pic"></div>
      <div class="Nav"> <span class="Normal">6</span> <span class="Normal">5</span> <span class="Normal">4</span> <span class="Normal">3</span> <span class="Normal">2</span> <span class="Cur">1</span> </div>
	  
    </div>
  </div>
  <script type="text/javascript" src="/public/index/js/jquery.landscape_flash.js"></script>
  <script type="text/javascript">
	  $('#landscape_flash').liteNav(2000);
  </script> 
  <!--landscape_flash end-->
  <div class="banfu_survey">
    <div class="tit">
      <img src="/public/index//images/banfu_survey_tit.png" />
    </div>
    <div class="con"><?php echo mb_substr($bfrows->content,0,164).'......'; ?><span><a href="/index.php/landscape/view/<?php echo $bfrows->parent_id.'/'.$bfrows->cat_id; ?>" target="_blank">[查看全文]</a></span></div>
    <div class="ect_map"> 
      <!--百度地图容器-->
      <div style="width:266px;height:150px;" id="dituContent"></div>
      <script type="text/javascript">
            //创建和初始化地图函数：
            function initMap(){
                createMap();//创建地图
                setMapEvent();//设置地图事件
                addMapControl();//向地图添加控件
            }
            //创建地图函数：
            function createMap(){
                var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
                var point = new BMap.Point(113.328872,22.422652);//定义一个中心点坐标
                map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
                window.map = map;//将map变量存储在全局
            }
            //地图事件设置函数：
            function setMapEvent(){
                map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
                map.enableScrollWheelZoom();//启用地图滚轮放大缩小
                map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
                map.enableKeyboard();//启用键盘上下左右键移动地图
            }
            //地图控件添加函数：
            function addMapControl(){
                //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_ZOOM});
            map.addControl(ctrl_nav);
                //向地图中添加缩略图控件
            var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:0});
            map.addControl(ctrl_ove);
                }
            initMap();//创建和初始化地图
        </script> 
    </div>
    <!--ect_map end-->
    <div class="banfu_survey_video"><a href="/index.php/landscape/type4/53/54" target="_blank">
      <img src="/public/index/picture/banfu_survey_video.jpg" /></a>
    </div>
    <!--banfu_survey_video end--> 
  </div>
  <!--banfu_survey end-->
  <div class="landscape_list">
  
  <?php foreach($cats['level2'] as $c2val){ ?>
    <div class="tit">
      <img src="<?php echo $c2val->cat_thumb; ?>" width="110" height="39" />
      <a href="/index.php/landscape/view/<?php echo $c2val->cat_id; ?>" target="_blank">更多&gt;&gt;</a> </div>
    <div class="list">
      <ul>
      <?php foreach($cats['level3'][$c2val->cat_id] as $c3key=>$c3val){ ?>
        <li style="<?php if($c3key=='0'){ ?>margin-left:0px;<?php } ?>"><?php if($c3val->cat_type_id==1){?><a href="/index.php/landscape/view/<?php echo $c3val->parent_id.'/'.$c3val->cat_id;?>" target="_blank"><?php }else{?>
          <a href="/index.php/landscape/type<?php echo $c3val->cat_type_id; ?>/<?php echo $c3val->parent_id.'/'.$c3val->cat_id;?>" target="_blank"><?php }?>
		    <img src="<?php echo $c3val->cat_thumb<>''?$c3val->cat_thumb:''; ?>" alt="<?php echo $c3val->name;?>"  width="260" height="160"/>
            <h2><?php echo $c3val->name;?></h2>
            <?php if($c3val->content){ echo mb_substr($c3val->content,0,88).'...'; }?>
          </a>
        </li>
      <?php } ?>
      </ul>
    </div>
  <?php }?>
  
  <!--走进板芙 end-->
    
  </div>
</div>
<!--warper end--> 