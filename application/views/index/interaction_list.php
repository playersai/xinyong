
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="">交流互动</a> &gt;&gt; 
  <span class="active">网上投诉</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_interaction.png" />
      <ul>
	  <?php
	  if(isset($left_navs)){
	
	  foreach($left_navs as $lnval){
	  
	  if(is_array($lnval)){
	  foreach($lnval as $lnnval){
	  ?>
        <li><a href="<?php echo $lnnval['url']; ?>"><?php echo $lnnval['name']; ?></a></li>
		
		<?php 
		}
		}
		}
		}
		?>
       
      </ul>
    </div>
    <div class="clear2"></div>
    <a href=""><img src="/public/index/images/online_interview.jpg" /></a> </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="border_box">
      <div class="alert_box">
        <p>您可对中山市板芙镇管理及服务方面的问题进行投诉、咨询，亦可选择镇长信箱对中山市板芙镇的发展和工作提出建议。<br>
          网上诉求的办理流程为：<br>
          1、填写提交网上诉求内容并获得受理编号与查询密码；<br>
          2、系统自动转有关部门调查处理；<br>
          3、用户可适时根据受理编号与查询密码查询处理情况。</p>
        <p>请您正确填写所有信息，并留下真实的联系方式。对留下真实姓名和联系方式的问题，我们将优先处理，重点反馈；对于填写信息模糊、且未留下联系方式的来件，我们将不予受理。</p>
      </div>
      <div class="complaint_online_tab2">
        <form method="post" action="/index.php/interaction/search/" target="_blank">
        受理编号：
        <input type="text" name="handle_id" id="seria"  value="" class="mayor_mail_input" placeholder="请输入13位受理编号">
        查询密码：
        <input type="password" name="password" id="pwd" value="" class="mayor_mail_input" placeholder="请输入6位查询密码">
        关键字：
        <input type="text" name="keyword" id="keyword" onblur="if (this.value ==''){this.value='请输入关键字'}" onfocus="if (this.value ==this.value){this.value =''}" value="请输入关键字" class="mayor_mail_input">
        <span style=" border: 1px solid #797979; padding: 4px 5px; margin-right: 10px; "> 类别 |  <select name="">
              <option value="0" selected="selected">所有</option>
              <option value="1">投诉监督</option>
              <option value="2">办事咨询</option>
              <option value="3">镇长信箱</option>
            </select>
</span>
        <input type="submit" value="查询" class="mayor_mail_submit">
      </form>
      <div class="con">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="c8c8c8">
          <tr bgcolor="e1e1e1" height="45">
            <th width="130" scope="col">受理编号</th>
            <th scope="col">来件标题</th>
            <th width="100" align="center" scope="col">类别</th>
            <th width="130" align="center" scope="col">受理日期</th>
            <th width="100" align="center" scope="col">状态</th>
          </tr>
          <?php 
          if(isset($fcrows) and is_array($fcrows)){
          	foreach($fcrows as $fcval){
          
          ?>
          <tr bgcolor="ffffff" height="50">
            <td width="130" align="center"><a href="/index.php/interaction/view/<?php echo $fcval->f_c_id; ?>" target="_blank"><?php echo $fcval->handle_id; ?></a></td>
            <td><a href="/index.php/interaction/view/<?php echo $fcval->f_c_id; ?>" target="_blank"><?php echo $fcval->title; ?></a></td>
            <td width="100" align="center"><?php echo $fcval->name; ?></td>
            <td width="130" align="center"><?php echo $fcval->adddate; ?></td>
            <td width="100" align="center" style="color:#F00;">
            <?php if($fcval->status=='2'){?>
            <strong>已办结</strong>
            <?php }else{?>
             <strong>进行中</strong>
            <?php } ?></td>
          </tr>
          
          <?php 
          	}
          	}?>
        </table>
      </div>
      <!--complaint_online_con end-->
      <div class="page">
      
      共<span style="color:#f00;"><?php echo $page_info['nums']; ?></span>条记录，分<span style="color:#f00;"><?php echo $page_info['page_nums']; ?></span>页显示
      <?php echo $pages; ?>
      </div>
    </div>
    <!--complaint_online_tab end--> 
    </div>
  </div>
</div>
<!--warper end-->
