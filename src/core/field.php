<?php 

/**
* Module Name: Abstrct Fields 
* Package Name: Abstrct core
* Author: Raghu, Abhilash Hebbar
* Description: This class is resposible for validation. It happens in 2 ways. With a single field and with multiple fields. We use a expression handler for validation for multiple fields.
*/

abstract class AbstrctField extends AbstrctDataClass implements AbstrctDataSourceInterface{
	public function addRequired($data,$addData = null){}
	public function isReady(){}
}