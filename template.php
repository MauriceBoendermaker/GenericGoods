<?php
// Database login
require "config.php";

// <head/> elements, for stylesheets, scripts and meta tags
require "include/head.php";

// Navigation bar
//require "include/nav.php";

// Get identifier id from URL
$id = $_GET['id'];

$sql = "SELECT * FROM `laptop` WHERE `identifier` = " . $id;
$result = $con->query($sql);

while($row = $result->fetch_assoc()) {
	$sql2 = "SELECT * FROM `brand` WHERE `id` = " . $row["brand"];
	$sql3 = "SELECT * FROM `gpu` WHERE `id` = " . $row["gpu"];
	$sql4 = "SELECT * FROM `cpu` WHERE `id` = " . $row["cpu"];
	$sql5 = "SELECT * FROM `resolution` WHERE `id` = " . $row["resolution"];

	$brand = $con->query($sql2);
	$gpu = $con->query($sql3);
	$cpu = $con->query($sql4);
	$resolution = $con->query($sql5);

	$brandName = $brand->fetch_assoc();
	$gpuName = $gpu->fetch_assoc();
	$cpuName = $cpu->fetch_assoc();
	$resolutionAmount = $resolution->fetch_assoc();
?>


		<div class="wrapper">
			<div class="side-space">
				<!-- side space -->
			</div>
			<div class="main-container">
				<h1><?php echo $brandName["name"]." ".$row["name"]; ?></h1>
				<img class="productImage" width="640" height="360" src="./images/<?php echo $row["thumbnail"]; ?>">
			</div>
			<div class="spec-container">
				<h3>Specificaties:</h3>
				<table>
					<tr>
						<td>Merk:</td>
						<td><?php echo $brandName["name"]; ?></td>
					</tr>
					<tr>
						<td>Type:</td>
						<td><?php echo $row["name"]; ?></td>
					</tr>
					<tr>
						<td>Processor:</td>
						<td><?php echo $cpuName["name"]; ?></td>
					</tr>
					<tr>
						<td>Videokaart:</td>
						<td><?php echo $gpuName["name"]; ?></td>
					</tr>
					<tr>
						<td>Intern werkgeheugen (RAM):</td>
						<td><?php echo $row["ram"]; ?></td>
					</tr>
					<tr>
						<td>Schermdiagonaal:</td>
						<td><?php echo $row["diagonal"]; ?></td>
					</tr>
					<tr>
						<td>Resolutie:</td>
						<td><?php echo $resolutionAmount["resolution"]; ?></td>
					</tr>
					<tr>
						<td>Refreshrate:</td>
						<td><?php echo $row["refreshrate"] . "Hz"; ?></td>
					</tr>
					<tr>
						<td>Totale opslagcapaciteit:</td>
						<td><?php echo $row["storagesize"]; ?></td>
					</tr>
					<tr>
						<td>Type opslag:</td>
						<td><?php echo $row["storagetype"]; ?></td>
					</tr>
				</table>
			</div>
			<div class="side-space">
				<!-- side space -->
			</div>
		</div>

	<br/>
	<br/>
	<br/>
	<br/>

	<div style="background-color: lightgray; width: 250px;" class="column1">
		<div class="<?php echo $brandName["name"]; ?>">
			<div class='col-md-12'>
				<img class='mx-auto' style='width: 100%' src="./images/<?php echo $row["thumbnail"]; ?>">
			</div>
			<div class='col-md-12 brandName'>
				<a href="template.php?id=<?php echo $row["identifier"]; ?>"><?php echo $brandName["name"]." ".$row["name"]; ?></a>
			</div>
			<div class='col-md-12'><p><?php echo $gpuName["name"]; ?></p></div>
			<div class='col-md-6'><p><?php echo $row["storagesize"]; ?></p></div>
			<div class='col-md-6'><p><?php echo $row["storagetype"]; ?></p></div>
		</div>
	</div>

<?php
}
?>