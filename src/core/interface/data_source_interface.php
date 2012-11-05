<?php 

/**
* Module Name: Data Source Interface 
* Package Name: Abstrct Interfaces
* Author: Abhilash Hebbar
* Description: This interface provides the data for anything needs it. Used to selectivily get data from the remote source and possible use in future for caching.
*/

interface AbstrctDataSourceInterface{
	public function addRequired($data,$addData = null);
	public function getReady($args);
	public function isReady();
}