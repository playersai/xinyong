
$(function(){
	//榛樿
	var winheight = $(window).height();
	var winwidth = $(window).width();
	$("#menu").height(winheight-72);
	//$("#menu_con").height(winheight-140);
	$("#ifmain").height(winheight-72);
	$("#ifmain").width(winwidth-220);
	$("#closs_menu").click(function(){
		if($(this).attr("class")=="show"){
			//alert(1);
			$(".show").text("显示左边");
			$(".show").removeClass("show").addClass("hide");
			$('#menu').hide();
			$("#ifmain").width(winwidth);
		}else{
			$(".hide").text("关闭左边");
			$(".hide").removeClass("hide").addClass("show");
			$('#menu').show();
			$("#ifmain").width(winwidth-220);
		}
	});

	$(window).resize(function(){
		var winheight = $(window).height();
		var winwidth = $(window).width();
		$("#menu").height(winheight-72);
		//$("#menu_con").height(winheight-140);
		$("#ifmain").height(winheight-72);
		$("#ifmain").width(winwidth-220);
		$("#closs_menu").text("脳 鍏抽棴宸︽爮");
		$('#menu').show();
		$("#closs_menu").click(function(){
			if($(this).attr("class")=="show"){
				$(".show").text("脳 鍏抽棴宸︽爮");
				$(".show").removeClass("show").addClass("hide");
				$('#menu').hide();
				$("#ifmain").width(winwidth);
			}else{
				$(".hide").text("鈭� 鎵撳紑宸︽爮");
				$(".hide").removeClass("hide").addClass("show");
				$('#menu').show();
				$("#ifmain").width(winwidth-220);
			}
		});
	});
});
