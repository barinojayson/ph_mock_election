<?php
/**
 Created By: Jayson Barino
 Created Date: 2016/07/16
 Description: Class for vote manipulation

**/
require_once(__DIR__."../../model/vote_model.php");

$vote = new Vote();
if(!empty($_POST)){	//user has voted
	$location = "vote_confirm";
	$vote->cast_vote($_POST);
	require_once("../view/vote_complete.php");
	//header('Location: ../view/vote_complete.php');
}

if(isset($_GET['result'])){ //view election result
	$vote->display_result();
	//header('Location: ../view/result.php');
}


class Vote{
	
	function index(){
		$vote_model = new Vote_Model();
		$candidate_list = $vote_model->get_candidates(); //displays candidate list
		$initial_res = __DIR__."../../"."data/"."result.csv";
		
		if(!file_exists($initial_res)) {
			$this->create_initial_res($candidate_list); //if result file is not yet created, create csv result based on candidate list
		}												//if new position is added to data/candidates.csv, data/result.csv should be deleted to reflect the new position
		$location = "vote";
		require_once("view/vote.php");
	}
	
	function cast_vote($post){
		$vote_model = new Vote_Model();
		$vote_result = $vote_model->get_result(); //get current result (to be modified based on user's votes)
		$csv_data = "";

		foreach($post as $pos => $candidate){ //collect user votes
			if(count($candidate) > 1){ //in case of voting multiple candidates in one position
				foreach($candidate as $councilor => $council){
					foreach($vote_result as $pos => $data){	
						foreach($data as $index => $item){
							if($council == $item[1]){ //search for candidate voted by user
								$vote_result[$pos][$index][2]++; //record vote 
							}
						}
					}
				}
			}
			else{ // only one candidate is voted for one position
				foreach($vote_result as $pos => $data){	
					foreach($data as $index => $item){
						if($candidate == $item[1]){ //search for candidate voted by user
							$vote_result[$pos][$index][2]++;  //record vote 
						}
					}
				}
			}
		}

		foreach($vote_result as $pos => $data){
			$csv_data .= "1,".$pos."\r\n";
			foreach($data as $item){
				$csv_data .= implode(",",$item)."\r\n";
			}
		}
		$csv_data .= "9,0"; //end of csv
		$vote_model->record_vote($csv_data); //re-write updated result to result.csv
	}
	
	function create_initial_res($candidate_arr = null){
		$vote_model = new Vote_Model();
		$csv_res_data = "";
		foreach($candidate_arr as $pos => $candidate){
			$csv_res_data .= "1,".$pos."\r\n";
			foreach($candidate as $data => $item){
				$csv_res_data .= "2,".$item[1].",0"."\r\n";
			}
		}
		$csv_res_data .= "9,0"; //end of csv
		$vote_model->record_vote($csv_res_data); //create initial result upon page load 	
	}
	
	function display_result(){
		$vote_model = new Vote_Model();
		$vote_result = $vote_model->get_result();
		$candidate_list = $vote_model->get_candidates();
		//echo "<pre>";
		$candidate_summary = array();
		$result_summary = array();
		foreach($candidate_list as $pos => $cd){
			$candidate_summary[$pos] = array();
			foreach($cd as $cd_detail){ //get summary of candidate
				$candidate_summary[$pos][$cd_detail[1]] = array();
				$candidate_summary[$pos][$cd_detail[1]]["name"] = $cd_detail[2];
			}
			
			foreach($vote_result[$pos] as $rs){ //get summary of vote result
				$result_summary[$rs[1]] = $rs[2];
			}
		}
		
		foreach($candidate_summary as $id => $detail){
			$total_vote = 0;
			$candidate_summary[$id]["total_vote"] = 0;
			foreach($detail as $key => $item){
				$candidate_summary[$id][$key]["vote_count"] = $result_summary[$key]; //map vote count of candidate
				$candidate_summary[$id]["total_vote"] += $result_summary[$key]; // total vote per position
			}
			foreach($detail as $key => $item){
				if($candidate_summary[$id]["total_vote"] == 0){
					$candidate_summary[$id][$key]["percentage"] = 0;
				}
				else{
					$candidate_summary[$id][$key]["percentage"] = ROUND(($candidate_summary[$id][$key]["vote_count"]/$candidate_summary[$id]["total_vote"])*100,3);
				}
			}
		}
		
		$location = "result";
		require_once("../view/result.php");
	}
}

?>