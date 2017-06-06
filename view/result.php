<!DOCTYPE html>
<html>

<head>
<title>Philippines Mock Election - View Result</title>

<link rel="stylesheet" type="text/css" href="../style/election_style.css">

</head>

<body>

	<?php require_once("menu.php"); ?>
	
	<div class = "main_container">
	
		<?php foreach($candidate_summary as $position => $detail ):  ?>
	
		<div class = "vote_set">
			<div class = "vote_position">
				<?php echo $position;?>
			</div>
			<?php foreach($detail as $candidate => $item ):  
				if($candidate != "total_vote") :
					$graph_width = $item['percentage']*5;
				?>
			<div class = "vote_result_graph">
				<div class = "vote_result_candidate"><?php echo $item['name']?></div>
				<div class = "vote_result_bar">
					<div class = "votes_earned" style = "width: <?php echo $graph_width."px";?> ; background-color: #c95151;" > </div>
				</div>
				<div class = "vote_result_figure"> <?php echo $item['vote_count']." ".($item['vote_count']>1?"votes":"vote");?> <br/><?php echo $item['percentage']."%";?></div>
				<div class = "clear"></div>
			</div>

			<?php endif; endforeach; ?>

		</div>
		<?php endforeach; ?>
	</div>

	<?php require_once("footer.php"); ?>


</body>

</html>