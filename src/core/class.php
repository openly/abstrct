<?php 


/**
* Module Name: AbstrctClass 
* Package Name: Abstrct
* Author: Abhilash Hebbar
* Description: This class implements generic function call methods which can call 2 additional method on_before and on_after
*/

/**
* 
*/
class AbstrctClass
{
	public function __call($function,$args){
		if(method_exists($this, "_$function")){
			if(method_exists($this, "on_before_$function"))
				$args = call_user_func_array(array($this,"on_before_$function"),$args);
			ArrayUtil::toArrayIfNot($args);
			$retval = call_user_func_array(array($this,"_$function"),$args);
			if(method_exists($this, "on_after_$function")){
				ArrayUtil::toArrayIfNot($retval);
				$retval = call_user_func_array(array($this,"on_after_$function"),$retval);
			}
			return $retval;
		}else if(method_exists($this, 'on_function_call')){
			return call_user_func(array($this,'on_function_call'),$function,$args);
		}
	}
}
