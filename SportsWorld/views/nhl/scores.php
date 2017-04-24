<?php
?>

<h2>NHL Regular Season</h2> <br>
<h3> Daily Matchups: </h3> 

<table border="1" cellpadding="10" >
	<thead> <th> Matchup </th> <th> Time (ET) </th> <th> Location </th></thead>
	<tbody>
	<?php for($i = 0; $i < count($games); $i++) { ?>
		<tr>
			<td><h5>
			<?php echo $games[$i]->awayTeam->Name . ' @ ' . $games[$i]->homeTeam->Name; ?>
			</h5></td>
			<td><h5>
			<?php echo $games[$i]->time ?>
			</h5></td>
			<td><h5>
			<?php echo $games[$i]->location ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>