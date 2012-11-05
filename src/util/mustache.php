<?php 

/**
* Module Name: MustacheUtil 
* Package Name: Abstrct Utilities
* Author: Abhilash Hebbar
* Description: Utilities for playing around Mustache.
*/

class MustacheUtil{

	public static function getReqData($template){
		preg_match_all('/{{{?([^}}]*)/', $template, $tags, PREG_PATTERN_ORDER);
		return self::nestTags($tags[1]);
	}

	private static function nestTags($tags){
		if(count($tags) == 1 && $tags[0] == '.') return array();
		$curIdx = 0;
		$data = array();
		for($curIdx = 0;$curIdx<count($tags);$curIdx++){
			$tag=$tags[$curIdx];
			if(preg_match('/^#/',$tag)){
				$tabs .= "\t";
				$openTag = substr($tag, 1);
				if(!($closeIdx = array_search("/$openTag", $tags)))
					ExceptionUtil::exception('Mustache tag $openTag not closed properly.');
				$data[$openTag] = self::nestTags(array_splice($tags,$curIdx+1, $closeIdx-$curIdx-1));
				$curIdx++;
				$tabs = substr($tabs,1);
			}else
				$data[$tag] = null;
		}
		return $data;
	}
}