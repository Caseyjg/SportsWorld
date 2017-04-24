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

<h3>Stat Leaders</h3>
<table border="1" cellpadding="10" >
	<thead> <th> Player </th> <th> Points/Game </th> </thead>
	<tbody>
	<?php for($i = 0; $i < count($ppgLeaders); $i++) { ?>
		<tr>
			<td><h5>
			<?php echo $ppgLeaders[$i]['player']['FirstName'] . ' ' .  $ppgLeaders[$i]['player']['LastName'] ?>
			</h5></td>
			<td bgcolor="lightgray"><h5>
			<?php echo $ppgLeaders[$i]['stats']['PtsPerGame']['#text'] ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<br>

<table border="1" cellpadding="10" >
	<thead> <th> Player </th> <th> Assist/Game </th> </thead>
	<tbody>
	<?php for($i = 0; $i < count($astLeaders); $i++) { ?>
		<tr>
			<td><h5>
			<?php echo $astLeaders[$i]['player']['FirstName'] . ' ' .  $astLeaders[$i]['player']['LastName'] ?>
			</h5></td>
			<td bgcolor="lightgray"><h5>
			<?php echo $astLeaders[$i]['stats']['AstPerGame']['#text'] ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<br>

<table border="1" cellpadding="10" >
	<thead> <th> Player </th> <th> Rebounds/Game </th> </thead>
	<tbody>
	<?php for($i = 0; $i < count($rebLeaders); $i++) { ?>
		<tr>
			<td><h5>
			<?php echo $rebLeaders[$i]['player']['FirstName'] . ' ' .  $rebLeaders[$i]['player']['LastName'] ?>
			</h5></td>
			<td bgcolor="lightgray"><h5>
			<?php echo $rebLeaders[$i]['stats']['RebPerGame']['#text'] ?>
			</h5></td>
		</tr>
	<?php } ?>
	</tbody>
</table>




