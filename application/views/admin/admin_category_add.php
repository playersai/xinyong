<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>cms</title>
<link rel="stylesheet" href="/public/manage/css/style.css" type="text/css" />
<link rel="stylesheet" path="/public/manage/css/" type="text/css" id="skinCss" />
<script type="text/javascript" src="/public/manage/js/jquery.js"></script>
<script type="text/javascript" src="/public/manage/js/panel.js"></script>
<script type="text/javascript" src="/public/manage/js/artDialog/plugins/iframeTools.js"></script>
<script charset="utf-8" src="/public/formvalid/valid.js"></script>
<script language="javascript">
    function checkdata() {
        document.myform.name.value = trim(document.myform.name.value);
        if (document.myform.name.value == "") {
            alert("分类名称不能为空！");
            document.myform.name.focus();
            return false;
        }

        document.myform.cat_thumb.value = trim(document.myform.cat_thumb.value);
        if (document.myform.cat_thumb.value != "") {
            var url = document.myform.cat_thumb.value;
            if (!check_isRelativePath(url) && !check_isURL(url)) {
                alert("分类图标填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
                document.myform.cat_thumb.focus();
                return false;
            }
        }

        <?php if($select_type_id=='7'){?>
    	document.myform.banner_thumb.value = trim(document.myform.banner_thumb.value);	
    	if(document.myform.banner_thumb.value!="") {
    		var url = document.myform.banner_thumb.value;
    		if(!check_isRelativePath(url) && !check_isURL(url)) {
    			alert("头部BANANE大图填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
    			document.myform.banner_thumb.focus();
    			return false;
    		}
    	}

    	if(document.myform.topic_ad1.value!="") {
    		var url = document.myform.topic_ad1.value;
    		if(!check_isRelativePath(url) && !check_isURL(url)) {
    			alert("中间右侧广告图填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
    			document.myform.topic_ad1.focus();
    			return false;
    		}
    	}

    	if(document.myform.topic_ad1_link.value!="") {
    		var url = document.myform.topic_ad1_link.value;
    		if(!check_isURL(url)){ 
    			alert("中间右侧广告链接地址输入的URL无效，填写的路径必需以 http:// 开头!");
    			document.myform.topic_ad1_link.focus(); 
    			return false; 
    		}
    	}

    	if(document.myform.topic_ad2.value!="") {
    		var url = document.myform.topic_ad2.value;
    		if(!check_isRelativePath(url) && !check_isURL(url)) {
    			alert("中间通栏广告图填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
    			document.myform.topic_ad2.focus();
    			return false;
    		}
    	}

    	if(document.myform.topic_ad2_link.value!="") {
    		var url = document.myform.topic_ad2_link.value;
    		if(!check_isURL(url)){ 
    			alert("中间通栏广告链接地址输入的URL无效!");
    			document.myform.topic_ad2_link.focus(); 
    			return false; 
    		}
    	}
    	<?php }?>

        if (document.myform.is_redirect.checked) {
            var url = document.myform.redirect_url.value;
            if (!check_isURL(url)) {
                alert("转向连接输入的URL无效!");
                document.myform.redirect_url.focus();
                return false;
            }
        }

        if (document.myform.sort.value != "") {
            if (!check_isIntger(document.myform.sort.value) || document.myform.sort.value < 0) {
                alert("排序必需填写大于或等于0的整数!");
                document.myform.sort.focus();
                return false;
            }
        }
    }
</script>
</head>
<body>
<div class="wrap">
<form method="post" action="/index.php/admin_category/add_handle/<?php echo $select_type_id; ?>" class="ajax_form" name="myform" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">添加分类</th>
    </tr>
    <tr>
      <td align="right">上级分类：</td>
      <td>
        <select name="parent_id">
	    <?php if(isset($category) and is_array($category) ){?>
		  <option value="<?php echo $category['0']->cat_id; ?>"><?php echo $category['0']->name; ?></option>
        <?php }else{?>
          <option value="0">顶级分类</option>
		<?php }?>
        </select> &nbsp;<a href="/index.php/admin_category/">重选分类</a>
		
		<?php if(isset($category)){?>
		<input type="hidden" name="level" value="<?php echo $category[0]->level=='2' ? '3' : '2'; ?>">
		<? }else{ ?>
		<input type="hidden" name="level" value="1">
		<?php } ?>
	  </td>
    </tr>
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>分类名称：</td>
      <td><input type="text" name="name" maxlength="20" size="25" class="input" dataType="require" title="请输入分类名称，输入长度不能超过20个字符" /></td>
    </tr>
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>分类属性：</td>
      <td>
        <select name="cat_type_id">
        <?php if($select_type_id=='7'){?>
          <option value="3" >图片集</option>
          <option value="7" selected>专题</option>
        <?php }else{ ?>
          <?php foreach($cat_type as $row_item): ?>
          <option value="<?php echo $row_item->id; ?>" <?php if($select_type_id==$row_item->id){ echo 'selected'; }	?>><?php echo $row_item->name; ?></option>
          <?php endforeach; ?>
        <?php }?>
        </select>&nbsp;<font color="red">选定后将不能进行修改，请慎重选择</font></td>
    </tr>
	
	
    <tr>
      <td align="right">分类图标：
	    <?php if($select_type_id=='7'){?>	
	    <br><small style="color:red;font-size:10px;">(建议尺寸228*100px)
	    <?php } ?>
	  </td>
      <td><input type="text" name="cat_thumb" class="input" dataType="require" title="请上传分类图标或输入分类图标地址" value="" style="width:300px;height:32px;" />
	 
      <iframe frameborder="0" src="/public/upload.php?upname=cat_thumb&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> </td>
    </tr>
	

	
	<?php if($select_type_id=='7' && $cats->level=='1'){ ?>	
	<tr>
      <td align="right">头部BANANE大图：<br ><small style="color:red;font-size:10px;">(建议尺寸1140*240px)</small></td>
      <td>
        <input type="text" name="banner_thumb" class="input" dataType="require" title="请输入名称" value="" style="width:300px;" />
	    <iframe frameborder="0" src="/public/upload.php?upname=banner_thumb&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
	  </td>
    </tr>
    
	<tr>
      <td align="right">中间右侧广告图：<br ><small style="color:red;font-size:10px;">(建议尺寸390*265px)</small></td>
      <td>
        <input type="text" name="topic_ad1" class="input" dataType="require" title="请输入名称" value="" style="width:300px;" />
	    <iframe frameborder="0" src="/public/upload.php?upname=topic_ad1&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
	  </td>
    </tr>
    
	<tr>
      <td align="right">中间右侧广告链接地址：</td>
	  <td><input type="text" name="topic_ad1_link" class="input" dataType="require" title="请输入名称" value="" style="width:606px;" /></td>
	</tr>
	
	<tr>
      <td align="right">中间通栏广告图：<br >
	  <small style="color:red;font-size:10px;">(建议尺寸1140*80px)</small></td>
      <td>
        <input type="text" name="topic_ad2" class="input" dataType="require" title="请输入名称" value="" style="width:300px;" />
	    <iframe frameborder="0" src="/public/upload.php?upname=topic_ad2&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
	  </td>
    </tr>
	
	<tr>
      <td align="right">中间通栏广告链接地址：</td>
	  <td><input type="text" name="topic_ad2_link" class="input" dataType="require" title="请输入名称" value="" style="width:606px;height:32px;" /></td>
	</tr>
	<?php } ?>
	
	
    <tr>
      <td align="right">分类简介：</td>
      <td><textarea name="content" cols="98" rows="5"></textarea></td>
    </tr>
    
    <!--  
	<tr>
      <td align="right">是否作为导航菜单：</td>
      <td>
        <input type="radio" name="is_menu" value="1" style="vertical-align: middle;margin-right:3px;" checked><label>是</label>
	    &nbsp;&nbsp;
	    <input type="radio" name="is_menu" value="0" style="vertical-align: middle;margin-right:3px;"><label>否</label>&nbsp;<font color="#FF0000"></font>
	  </td>
    </tr>
    -->
	
	<tr>
      <td align="right">转向连接：</td>
      <td>
        <label>启用</label>
	<input type="checkbox" name="is_redirect" value="1" class="input" style="vertical-align: middle;margin-right:3px;">
	    <input type="text" name="redirect_url" size="50" class="input" value="" />&nbsp;<font color="red">可跳转到指定地址（不允许发布内容）,如专题或外站链接</font>
	  </td>
    </tr>
    
    <tr>
      <td align="right"><font color="#FF0000">*&nbsp;</font>排 序：</td>
      <td><input type="text" name="sort" size="6" class="input" value="0" />&nbsp;<font color="red">数值越大越靠前</font></td>
    </tr>
    
    <!-- 
	<tr>
      <td align="right">是否需要审核：</td>
      <td>
        <input type="radio" name="shenhe" value="1" style="vertical-align: middle;margin-right:3px;"><label>需要</label>
	    &nbsp;&nbsp;
	    <input type="radio" name="shenhe" value="0" style="vertical-align: middle;margin-right:3px;" checked><label>不需要</label>
	  </td>
    </tr>
    -->
   
    <tr>
      <td align="right">状 态：</td>
      <td>        
        <input type="radio" name="status" value="1" style="vertical-align: middle;margin-right:3px;" checked>
        <label>显示</label> &nbsp;&nbsp;
        <input type="radio" name="status" value="2" style="vertical-align: middle;margin-right:3px;">
        <label>隐藏</label>
      </td>
    </tr>
    
    <tr>
      <td align="right"></td>
      <td>
        <input type="submit" value="提 交" class="btn ajax_btn" />
		<input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" />
      </td>
    </tr>
    
  </table>
</form>
</div>
</body>


</html>

