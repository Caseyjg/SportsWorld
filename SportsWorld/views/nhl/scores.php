<?php
?>

<h2>NHL Playoffs</h2> <br>
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

			<td><h5>
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

<h3> Stat Leaders: </h3> 

<table border="1" cellpadding="10" >
	<thead> <th> No. </th> <th> Player </th> <th> Team </th> <th> Goals </th></thead>
	<tbody>
	<?php for($i = 0; $i < count($goals); $i++) { ?>
		<tr>
			<td align="center"><h5>
			<?php echo $i+1?>
			</h5></td>

			<td><h5>
			<?php echo $goals[$i]['player']['FirstName'] . ' ' . $goals[$i]['player']['LastName']  ?>
			</h5></td>

			<td><h5>
			<?php echo $goals[$i]['team']['City'] . ' ' . $goals[$i]['team']['Name'] ?>
			</h5></td>

			<td align="center"><h5>
			<?php echo $goals[$i]['stats']['stats']['Goals']['#text'] ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<br>

<table border="1" cellpadding="10" >
	<thead> <th> No. </th> <th> Player </th> <th> Team </th> <th> Assists </th></thead>
	<tbody>
	<?php for($i = 0; $i < count($assists); $i++) { ?>
		<tr>
			<td align="center"><h5>
			<?php echo $i+1?>
			</h5></td>

			<td><h5>
			<?php echo $assists[$i]['player']['FirstName'] . ' ' . $assists[$i]['player']['LastName']  ?>
			</h5></td>

			<td><h5>
			<?php echo $assists[$i]['team']['City'] . ' ' . $assists[$i]['team']['Name'] ?>
			</h5></td>

			<td align="center"><h5>
			<?php echo $assists[$i]['stats']['stats']['Assists']['#text'] ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<br>

<table border="1" cellpadding="10" >
	<thead> <th> No. </th> <th> Player </th> <th> Team </th> <th> Points </th></thead>
	<tbody>
	<?php for($i = 0; $i < count($points); $i++) { ?>
		<tr>
			<td align="center"><h5>
			<?php echo $i+1?>
			</h5></td>

			<td><h5>
			<?php echo $points[$i]['player']['FirstName'] . ' ' . $points[$i]['player']['LastName']  ?>
			</h5></td>

			<td><h5>
			<?php echo $points[$i]['team']['City'] . ' ' . $points[$i]['team']['Name'] ?>
			</h5></td>

			<td align="center"><h5>
			<?php echo $points[$i]['stats']['stats']['Points']['#text'] ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>