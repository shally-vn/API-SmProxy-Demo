<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<caption></caption>
		<thead>
			<tr>
				<th></th>
			</tr>
		</thead>
		<tbody>
<?php
$start = 1;
$end = 120;
for ($i=$start; $i<=$end; $i++) { 
	if($i < 10) $number = strval('0'.$i);
	else $number = strval($i);
	// echo "SW<->MD $number \t MD<->USB $number \t MODEM $number \n";
	// echo "SW<->MD $number \t MD<->USB $number \t MODEM $number \n";
	echo "<tr>
	<td>SW<->MD $number</td>
	<td>MD<->USB $number</td>
	<td>MODEM $number</td>
	</tr>";
}


?>
		</tbody>
	</table>

</body>
</html>
