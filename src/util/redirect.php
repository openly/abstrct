<?php 

class RedirectUtil{
	public static function ajaxRedirect($loc){
		echo "<script type='text/javascript'>window.location='$loc';</script>";
	}
}