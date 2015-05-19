<?php
if(! function_exists('handle_id')){
	function handle_id(){
        //新时间截定义,基于世界未日2012-12-21的时间戳。
        $endtime=1356019200;//2012-12-21时间戳
        $curtime=time();//当前时间戳
        $newtime=$curtime-$endtime;//新时间戳
        $rand=rand(0,9);//两位随机
        $all=$rand.$newtime;
		$all=substr($all,2,-1); 
        $onlyid=base_convert($all,10,36);//把10进制转为36进制的唯一ID
        return $onlyid;
    }



}





?>