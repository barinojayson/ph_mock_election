<html>
	<head>
		<title>Cast Your Vote!</title>
	</head>
	<form method="POST" action="controller/vote.php">
	<table style="margin:auto;">
		<thead>
			<td><h1>Welcome to Mock Election</h1></td>
		</thead>
		<?php
			foreach($candidate_list as $pos => $candidate){
				$position = $pos;
				if($pos == "Councilors"){
					$position .= " (Select 8 Candidates)";
				}
				elseif($pos == "Captain"){
					$position = "Barangay Captain";
				}?>
				<tr>
					<td colspan="2" style="padding:2px;background:green;font-weight:bold;color:white;"><?php echo $position;?></td>
				</tr>
				<?php
				foreach($candidate as $name => $detail){ ?>
					<tr>
						<td><?php echo $detail[2]; ?></td>
						
						
						<?php if($pos == "Councilors"){?>
							<td><input type="checkbox" name='Councilors[]' value="<?php echo $detail[1];?>" /></td>
						<?php } else{?>
						
							<td><input type="radio" name='<?php echo $pos;?>' value="<?php echo $detail[1];?>" /></td>
						<?php }?>
					</tr>
			<?php }
			} ?>
			
		<tr>
			<td><input type="submit" value="VOTE!"></td>
		</tr>
	</table>
	</form>
</html>