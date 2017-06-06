<?php

/**
 Created By: Jayson Barino
 Created Date: 2016/07/16
 Description: file manipulation

**/

require_once(__DIR__."../../library/CSV_Load.php");
require_once(__DIR__."../../library/constants.php");

class Vote_Model{
	
	var $csv_path;
	function __construct(){
		$this->csv_path = $GLOBALS['CSV_PATH']; //data source
	}

	function get_candidates(){
		$filename = __DIR__."../../".$this->csv_path."candidates.csv"; //candidate list
		$csv = new CSV_Load();
		$candidate_arr = array();
		
		foreach($csv->read($filename) as $content){
			if($content[0] == 1){ //position
				$pos = $content[1];
				$candidate_arr[$pos] = array();
			}
			if($content[0] == 2){ //candidate details
				array_push($candidate_arr[$pos],$content);
			}
		}
		return $candidate_arr;
	}
	
	function get_result(){
		$filename = __DIR__."../../".$this->csv_path."result.csv"; //vote results
		$csv = new CSV_Load();
		$vote_arr = array();
		
		foreach($csv->read($filename) as $content){
			if($content[0] == 1){ //position
				$pos = $content[1];
				$vote_arr[$pos] = array();
			}
			if($content[0] == 2){ // candidate details
				array_push($vote_arr[$pos],$content);
			}
		}
		return $vote_arr;
	}
	
	function record_vote($data=null){
		$filename = __DIR__."../../".$this->csv_path."result.csv";
		
		$csv = new CSV_Load();
		$csv->write($filename, $data);
	}
}

?>