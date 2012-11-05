<?php 

/**
* Module Name: Data List 
* Package Name: Abstrct Interfaces
* Author: Abhilash Hebbar
* Description: This interface is the list data interface. Mainly used for lazy loading of selected data from the model.
*/

interface AbstrctDataListInterface{
	public function addConstraint();
	public function addSort();
	public function addGrouping();
}