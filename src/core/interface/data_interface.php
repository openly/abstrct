<?php 
/**
* Module Name: Abstrct Data Interface 
* Package Name: Abstrct Interfaces
* Author: Abhilash Hebbar
* Description: This interface defines the properites of Data Provider mainly used for Persistance.
*/	

interface AbstrctDataInterface{
	public function save($data,$isNew);
	public function delete($data,$id);
	public function search($args);
}