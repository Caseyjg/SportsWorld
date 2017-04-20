<?php
?>

<h2>Playoff Hoops</h2> <br>
<h3> Daily Matchups: </h3> 

<table border="1" cellpadding="10" >
	<thead> <th> Matchup </th> <th> Time (ET) </th> <th> Arena </th></thead>
	<tbody>
	<?php for($i = 0; $i < count($data); $i++) { ?>
		<tr>
			<td><h5>
			<?php echo $data[$i]->awayTeam->Name . ' @ ' . $data[$i]->homeTeam->Name; ?>
			</h5></td>
			<td><h5>
			<?php echo $data[$i]->time ?>
			</h5></td>
			<td><h5>
			<?php echo $data[$i]->location ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<h3>Stats</h3>

<table border="1" cellpadding="10" >
	<thead> </thead>
	<tbody>
	<?php for($i = 0; $i < count($stats); $i++) { ?>
		<tr>
			<td><h5>
			<?php echo $stats[$i]->player->FirstName . ' ' . $stats[$i]->player->LastName ?>
			</h5></td>
			<td><h5>
			<?php echo $stats[$i]->team->City . ' ' . $stats[$i]->team->Name ?>
			</h5></td>
			<td><h5>
			<?php //echo $stats[$i]->stats->GamesPlayed ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

