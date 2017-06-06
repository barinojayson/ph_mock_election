<!DOCTYPE html>
<html>

<head>
<title>Philippines Mock Election - Cast Your Vote</title>

<link rel="stylesheet" type="text/css" href="style/election_style.css">

</head>

<body>

	<?php require_once("menu.php");?>
	
	<div class = "main_container">
		<form method="POST" action="controller/vote.php" onsubmit="return validateBallot();">
		<?php
			foreach($candidate_list as $pos => $candidate){
				$position = $pos;
				if($pos == "Councilors"){
					$position .= " (Select 8 Candidates)";
				}
				elseif($pos == "Captain"){
					$position = "Barangay Captain";
				}?>
				
					<div class = "vote_set">
						<div class = "vote_position">
							<?php echo $position; ?>
						</div>
						
						
					<?php
						foreach($candidate as $name => $detail){ ?>
						
						<label>	
							<div class = "vote_candidates">
							
								<div class = "vote_radio">
										<?php if($pos == "Councilors"){?>
										<input type="checkbox" name='Councilors[]' value="<?php echo $detail[1];?>" />
										<?php } else{?>

										<input type="radio" name='<?php echo $pos;?>' value="<?php echo $detail[1];?>" />
										<?php }?>
								</div>
								
								<div class = "vote_cand_details">
									<div class = "vote_name"> <?php echo $detail[2]; ?> </div>
								</div>

							</div>
						</label>	
							
						<?php } ?>
						
						
							
						<div class = "clear"></div>
					</div>
				
			<?php } ?>
			
			<div class = "vote_button">
				
				<input type = "submit" class = "button" value = "Vote!">
				
			</div>
		</form>
	</div>
	
	<?php require_once("footer.php"); ?>

</body>

</html>


<script>
function validateBallot(){
	var frm = document.forms[0];
	var count_all_votes = frm.querySelectorAll(':checked').length;
	
	var councilorElem = document.getElementsByTagName("input");
	var count_councilors = 0;
	
	for(var i=0; i<councilorElem.length; i++){
		if(councilorElem[i].type == "checkbox" && councilorElem[i].checked == true){
			count_councilors++;
		}
    }
	
	if(count_all_votes == 0){
		alert("Ballot is empty.");
		return false;
	}
	if(count_councilors > 8){
		alert("You may vote up to 8 councilors only.");
		return false;
	}
}

</script>