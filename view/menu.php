
<div class = "menu_container">
		<div class = "menu_con2">
		<a href = "http://localhost/mock_election/" >
		<div class = "menu_item <?php if ($location=="vote" || $location=="vote_confirm"){echo 'menu_selected'; }?>">
			<div class = "menu_icon cast_vote"></div>
			<div class = "menu_text">Cast Vote</div>
			<div class = "clear"></div>
		</div>
		</a>
		<a href = "http://localhost/mock_election/controller/vote.php?result=true">
		<div class = "menu_item <?php if ($location=="result"){echo 'menu_selected'; }?>">
			<div class = "menu_icon view_result"></div>
			<div class = "menu_text">View Result</div>
			<div class = "clear"></div>
		</div>
		<div class = "clear"></div>
		</a>
		</div>
</div>