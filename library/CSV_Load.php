<?php

/**
 Created By: Jayson Barino
 Created Date: 2016/07/16
 Description: File read/write library

**/

class CSV_Load{

	var $csv_data = null;
	function __construct(){}
	
	function read($filename, $mode = 'r'){
		$file = fopen($filename,$mode);
		$file_contents = array();
		while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
			array_push($file_contents,$data);
		}
		fclose($file);
		return $file_contents;
	}
	
	function write($filename, $data=null, $mode='w'){
		$file = fopen($filename,"w");
		fwrite($file,$data);
		fclose($file);
	}
	

}

?>