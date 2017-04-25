<?php
?>

<h2>MLB Regular Season</h2> <br>
<h3> Daily Matchups: </h3> 

<?php if($games != -1) { ?>
<table border="1" cellpadding="10" >
	<thead> <th> Matchup </th> <th> Time (ET) </th> <th> Location </th></thead>
	<tbody>
	<?php for($i = 0; $i < count($games); $i++) { ?>
		<tr>
			<td><h5>
			<?php echo $games[$i]['awayTeam']['Name'] . ' @ ' . $games[$i]['homeTeam']['Name']; ?>
			</h5></td>
			<td align="center"><h5>
			<?php echo $games[$i]['time'] ?>
			</h5></td>
			<td><h5>
			<?php echo $games[$i]['location'] ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php } else { ?>
<h3>No games today!</h3><?php } ?>

<br/>

<h3> Divison Standings: </h3> 

<?php for($x = 0; $x < count($standings); $x++) { ?>
<h4><?php echo $standings[$x]['@name']  ?></h4>
<table border="1" cellpadding="10" >
	<thead> <th> No. </th> <th> Team </th> <th> Wins </th> <th> Losses </th> </thead>
	<tbody>
	<?php for($i = 0; $i < count($standings[$x]['teamentry']); $i++) { ?>
		<tr>
			<td align="center"><h5>
			<?php echo $i+1 ?>
			</h5></td>

			<td><h5>
			<?php echo $standings[$x]['teamentry'][$i]['team']['Name'] ?>
			</h5></td>

			<td align="center"><h5>
			<?php echo $standings[$x]['teamentry'][$i]['stats']['Wins']['#text'] ?>
			</h5></td>

			<td align="center"><h5>
			<?php echo $standings[$x]['teamentry'][$i]['stats']['Losses']['#text'] ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<br/>
<?php } ?>