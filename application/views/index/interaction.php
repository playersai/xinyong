 <div class="clear"></div>
  <div class="complaint_online">
    <div class="complaint_online_btn">
      <img src="/public/index/images/complaint_online .png" />
      <ul>
        <li><a class="mayor_mail_btn1" href="/index.php/interaction/Mayor_mail" target="_blank">镇长信箱</a></li>
        <li><a class="mayor_mail_btn2" href="/index.php/interaction/complaint_form" target="_blank">我要投诉</a></li>
        <li><a class="mayor_mail_btn3" href="/index.php/interaction/Consulting_work" target="_blank">我要咨询</a></li>
      </ul>
      <div class="more"><a href="/index.php/interaction/complaint_list" target="_blank" >更多&gt;&gt;</a></div>
    </div>
    <!--complaint_online_btn end-->
    <div class="complaint_online_tab">
      <form id="searchForm" name="myform" method="post" action="/index.php/interaction/search/" target="_blank">
        <label>受理编号：</label>
        <input id="ipt_hid" type="text" name="handle_id" maxlength="13" value="" class="mayor_mail_input" placeholder="请输入13位受理编号">
        <label>查询密码：</label>
        <input id="ipt_pwd" type="password" name="password" maxlength="6" value="" class="mayor_mail_input" placeholder="请输入6位查询密码">
        <label>关键字：</label>
        <input id="ipt_kwd" type="text" name="keyword" class="mayor_mail_input" value="<?php echo htmlspecialchars($keyword);?>" placeholder="请输入关键字">
        <label>类别：</label>
        	<select id="sel_type" class="select">
              <option value="0" <?php if($type_id==0) echo 'selected="selected"';?>>所有</option>
              <option value="1" <?php if($type_id==1) echo 'selected="selected"';?>>投诉监督</option>
              <option value="2" <?php if($type_id==2) echo 'selected="selected"';?>>办事咨询</option>
              <option value="3" <?php if($type_id==3) echo 'selected="selected"';?>>镇长信箱</option>
            </select>
        <input id="btn_search" type="button" value="查询" class="mayor_mail_submit">
      </form>
      <script src="/public/index/js/base64.js" type="text/javascript"></script>
      <script type="text/javascript">
      $("#btn_search").click(function() {
          if($('#ipt_hid').val()!="" && $('#ipt_pwd').val().length==6){
        	  document.getElementById("searchForm").submit();
          }else if($('#ipt_hid').val()!="" && $('#ipt_pwd').val().length!=6){
              alert("请输入6位的查询密码！");
              document.myform.password.focus();
          }else if($('#ipt_hid').val()=="" && $('#ipt_pwd').val()!=""){
        	  alert("请输入受理编号！");
        	  document.myform.handle_id.focus();
          }else if($('#ipt_hid').val()=="" && $('#ipt_pwd').val()==""){
              var base64 = new Base64();
              var queryStr = $('#ipt_kwd').val() + "@" + $('#sel_type').val();
              queryStr = base64.encode(queryStr);  
              queryStr = queryStr.replace(/\+/g, "-");
              queryStr = queryStr.replace(/\//g, "_");
              //window.open("/index.php/interaction/" + queryStr);
              location.href="/index.php/interaction/index/" + queryStr;
          }
      });
      </script>
      <div class="con">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="c8c8c8">
          <tr bgcolor="e1e1e1" height="45">
            <th width="130" scope="col">受理编号</th>
            <th scope="col">来件标题</th>
            <th width="100" align="center" scope="col">类别</th>
            <th width="130" align="center" scope="col">受理日期</th>
            <th width="100" align="center" scope="col">状态</th>
          </tr>
          <?php if($fcrows){?>
          <?php foreach($fcrows as $fcval):?>
          <tr bgcolor="ffffff" height="50">
            <td width="130" align="center"><a href="/index.php/interaction/view/<?php echo $fcval->f_c_id; ?>" target="_blank"><?php echo $fcval->handle_id; ?></a></td>
            <td><a href="/index.php/interaction/view/<?php echo $fcval->f_c_id; ?>" target="_blank"><?php echo htmlspecialchars($fcval->title); ?></a></td>
            <td width="100" align="center"><?php echo htmlspecialchars($fcval->name); ?></td>
            <td width="130" align="center"><?php echo $fcval->adddate; ?></td>
            <td width="100" align="center" style="color:#F00;">
            <?php if($fcval->status=='2'):?>
            	<strong>已办结</strong>
            <?php else:?>
            	<strong>处理中</strong>
            <?php endif;?></td>
          </tr>
          <?php endforeach;?>
          <?php }else{?>
          <tr bgcolor="ffffff" height="250"><td colspan="5" align="center">暂无数据</td></tr>
          <?php }?>
        </table>
      </div>
      <!--complaint_online_con end-->
      <div class="page">
      
      共<span style="color:#f00;"><?php echo $totalRows; ?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages; ?></span>页显示
      <?php echo $pageLink; ?>
       <!--  --a class="first" href="">首页</a> <a class="prev" href="">上一页</a> <a href="">1</a> <span class="page_now">2</span> <a href="">3</a> <a href="">4</a> <a class="next" href="">下一页</a><a class="last" href="">尾页</a--></div>
    </div>
    <!--complaint_online_tab end--> 
  </div>
  <!--complaint_online end-->
  <div class="in_gov_weibo">
    <div class="tit">政务微博<a href="http://www.zs.gov.cn/main/zmhd/weibo/index.action" target="_blank">进入政务微博广场&gt;&gt;</a> </div>
    <div class="con">
      <iframe width="100%" height="415" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=415&fansRow=2&ptype=1&speed=100&skin=1&isTitle=0&noborder=0&isWeibo=1&isFans=0&uid=3506393293&verifier=c1806245&colors=ffffff,ffffff,666666,0082cb,ecfbfd&dpc=1"></iframe>
    </div>
  </div>
  <!--in_gov_weibo end-->
  <div class="survey_online online_list">
    <div class="tit">网上调查<a href="/index.php/interaction/type5/105/22/1" target="_blank">更多&gt;&gt;</a></div>
    <div class="con">
      <ul>
        <?php if(isset($vtrows) and is_array($vtrows)):?>
        <?php foreach($vtrows as $vtval):?>
          <li><font><?php echo date("Y-m-d",$vtval->addtime); ?></font><a href="/index.php/interaction/vote/<?php echo $vtval->vote_id.'/'.$vtval->cat_id; ?>" target="_blank"><i>&middot;</i><?php echo htmlspecialchars($vtval->title); ?></a></li>
        <?php endforeach;?>
        <?php else:?>
          <li>暂无数据</li>
        <?php endif; ?>
      </ul>
    </div>
    <!--con end--> 
  </div>
  <!--survey_online end-->
  
  <div class="collect_online online_list">
    <div class="tit">网上征集<a href="/index.php/interaction/type6/37/24/1" target="_blank">更多&gt;&gt;</a></div>
    <div class="con">
      <ul>
        <?php if(isset($fbrows) and is_array($fbrows)):?>
        <?php foreach($fbrows as $fbval):?>
          <li><font><?php echo date("Y-m-d",$fbval->addtime); ?></font><a target="_blank" href="/index.php/interaction/feedback/<?php echo $fbval->f_id.'/'.$fbval->cat_id; ?>"><i>&middot;</i><?php echo htmlspecialchars($fbval->title); ?></a></li>
        <?php endforeach;?>
        <?php else:?>
          <li>暂无数据</li>
        <?php endif; ?>
      </ul>
    </div>
    <!--con end--> 
  </div>
  <!--collect_online end-->
  <div class="common_problem">
    <div class="tit">常见问题<a href="/index.php/interaction/type2/129/127/1" target="_blank">更多&gt;&gt;</a> </div>
    <div class="con">
      <ul>
	  <?php foreach($cjwt_rows as $wtval):?>
        <li><a href="/index.php/interaction/article/<?php echo $wtval->aid.'/'.$wtval->cat_id; ?>" target="_blank"><i>&middot;</i><?php echo htmlspecialchars($wtval->title); ?></a></li>
	  <?php endforeach;?>
      </ul>
    </div>
    <!--con end-->
  </div><!--common_problem end-->
  <div class="online_interview"><a href="/index.php/interaction/type1/148" target="_blank"><img src="/public/index/images/online_interview.jpg" /></a></div>
</div>
<!--warper end-->
