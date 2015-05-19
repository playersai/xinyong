
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/interaction">交流互动</a> &gt;&gt;  <a href="/index.php/interaction/type<?php echo $now_nav2->cat_type_id; ?>/<?php echo $now_nav2->cat_id; ?>/<?php echo $now_nav2->parent_id; ?>/1"><?php echo $now_nav2->name; ?></a> &gt;&gt; 
    <span class="active"><?php echo $feedback->title; ?></span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_interaction.png" />
      <ul>
       <?php
	  if(isset($left_navs)){
	
	  foreach($left_navs as $lnkey=>$lnval){
	  
	  if(is_array($lnval)){
	  foreach($lnval as $lnnkey=>$lnnval){
	  ?>
        <li><a  <?php if($lnnkey==$left_navs_selected){?>style="background: #0067ad;color: #FFF;";<?php }?> href="<?php echo $lnnval['url']; ?>"><?php echo $lnnval['name']; ?></a></li>
		
		<?php 
		}
		}
		}
		}
		?>
      </ul>
    </div>
    <div class="clear2"></div>
    <a href="/index.php/interaction/type1/148/"><img src="/public/index/images/online_interview.jpg" /></a> 
  </div>
  <!--left_side end--> 
  <div class="right_side">
    <div class="border_box">
      <h1><?php echo htmlspecialchars($feedback->title); ?></h1>
      <div class="content_info">开始时间：<?php echo date("Y-m-d",$feedback->start_time); ?>&nbsp;&nbsp;&nbsp;&nbsp;结束时间：<?php echo date("Y-m-d",$feedback->exp_time); ?></div>
     <?php echo $feedback->content; ?>
	 <p style="height:30px;"></p>
      <div class="advice_input">
        <div class="tit"> 我要建言献策</div>
        <div class="con">
        <script charset="utf-8" src="/public/formvalid/valid.js"></script>
        <script type="text/javascript">
			function checkdata(){
				document.myform.nickname.value = trim(document.myform.nickname.value);
				if(document.myform.nickname.value=="") {
					alert("姓名不能为空！");
					document.myform.nickname.focus();
					return false;
				}

				document.myform.content.value = trim(document.myform.content.value);
				if(document.myform.content.value=="") {
					alert("我要说不能为空！");
					document.myform.content.focus();
					return false;
				}

				document.myform.f_code.value = trim(document.myform.f_code.value);
				if(document.myform.f_code.value=="") {
					alert("验证码不能为空！");
					document.myform.f_code.focus();
					return false;
				}

				var yzm = document.myform.f_code.value;
				var status = true;
				$.ajax({
					url: '/index.php/ajax/checkYZM',
					type: 'POST',
					data:{f_code:yzm},
					dataType: 'text',
					timeout: 2000,
					error: function(){
						alert('连接超时，请稍后再次尝试！');
					},
					success: function(result){
						if(result=="true"){
							$("form").submit();
						}else{
							alert("验证码验证错误，请重新填写验证码！");
							$("#img_code").attr("src","/public/ValidateCode.php?"+new Date().getTime()); 
						}
					}
				});
			}
        </script>
        
        <form name="myform" action="/index.php/interaction/feedback_handle/<?php echo $feedback->f_id; ?>/<?php echo $feedback->cat_id; ?>" method="post">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <?php 
		  if(time() > $feedback->exp_time){ 
		  	  echo "<tr><td>本活动已结束！不能留言反馈了</td></tr>";
		  }elseif(time() < $feedback->start_time){
			  echo "<tr><td>本活动还没开始，请稍候留言!</td></tr>";
	      }else{ ?>
		    <?php /* foreach($fv_rows as $fvval): ?>
            <tr>
              <td width="100" height="50" align="right" valign="middle"><em class="asterisk">*</em><?php echo $fvval->value; ?>：</td>
              <td colspan="2">
			  <?php if($fvval->type=='text'):?>
			  <input type="text" name="<?php echo $fvval->vkey; ?>" maxlength="20" class="text" style="width:150px;" />
			  <?php endif;?>
			  
			  <?php if($fvval->type=='textarea'):?>
			  <textarea name="<?php echo $fvval->vkey; ?>" class="textarea"></textarea>
			  <?php endif;?>
			  </td>
            </tr>
		    <?php endforeach; */ ?>
		    
		    <tr>
              <td width="100" height="50" align="right" valign="middle"><em class="asterisk">*</em>姓名：</td>
              <td colspan="2">
			    <input type="text" name="nickname" maxlength="20" class="text" style="width:150px;" title="请输入姓名，输入长度不能超过20个字符" />
			  </td>
            </tr>
            
		    <tr>
              <td width="100" height="50" align="right" valign="middle"><em class="asterisk">*</em>我要说：</td>
              <td colspan="2"><textarea name="content" maxlength="1000" class="textarea" title="请输入您要表达的内容，输入长度不能超过1000个字符"></textarea></td>
            </tr>
		    
            <tr>
              <td width="100" height="50" align="right" valign="middle"><em class="asterisk">*</em>验证码：</td>
              <td width="250">
                <input name="f_code" maxlength="4" type="text" id="f_code" class="text" style=" float:left;" size="8" title="请输入验证码"> 
                <img id="img_code" class="f_code" title="看不清楚？点击图片刷新" src="/public/ValidateCode.php" onclick="this.src='/public/ValidateCode.php?'+new Date().getTime()">
              </td>
              <td width="476"><input type="button" value="提&nbsp;&nbsp;交" class="submit1" onclick="checkdata()"></td>
            </tr>
		  <?php } ?>
          </table>
        </form>
        </div>
      </div>
      <p>&nbsp;</p>
      <div class="advice_list">
	  <?php if(!empty($fc_rows) and is_array($fc_rows)){?>
        <div class="tit">留言评论</div>
	    <?php foreach($fc_rows as $fcval){ ?>	
        <div class="con">
          <div class="active_name">
            <span>发布于<?php echo date("Y-m-d H:i",$fcval->addtime); ?></span>
            <b>网友：<?php echo htmlspecialchars($fcval->nickname); ?></b></div>
          <div class="active_con"><?php echo htmlspecialchars($fcval->content); ?></div>
        </div>
	    <?php }?>
        
		<?php if(!empty($pages)){ ?>   
		<div class="advice_list_foot">
		  <div class="page">
		    共<span style="color:#f00;"><?php echo $page_info['nums']; ?></span>
            条记录，分<span style="color:#f00;"><?php echo $page_info['page_nums']; ?></span>
            页显示，当前为第 <span style="color:#f00;"><?php echo $page_info['now_page']; ?></span>页<?php echo $pages; ?>	
		  </div> 
		</div>
		<?php } ?>
		
	  <?php } ?>
      </div>
    </div>
  </div>
</div>
<!--warper end-->

