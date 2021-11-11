<?php

// template.php
// Maurice Boendermaker
// 11/11/2021

// OOP
declare(strict_types=1);
namespace GenericGoods;

// Import Classes - OOP
require "include/Identifier.php";
require "include/MySQL.php";

// Database login - Procedural
//require "config.php";

// <head/> elements, for stylesheets, scripts and meta tags
require "include/head.php";

// Navigation bar
//require "include/nav.php";

// Get identifier id from URL - OOP
$Identifier = new Identifier($_GET['id']);

// Get identifier id from URL - Procedural
// $id = $_GET['id'];

$result = new MySQL();
$con = $result->connect("localhost" , "root" , "" , "genericlaptop");

$rs = $result->query("SELECT * FROM `laptop` WHERE `identifier` = " . $Identifier->getId());

while ($row = $result->fetch($rs)) {
	$sql2 = "SELECT * FROM `brand` WHERE `id` = " . $row["brand"];
	$sql3 = "SELECT * FROM `gpu` WHERE `id` = " . $row["gpu"];
	$sql4 = "SELECT * FROM `cpu` WHERE `id` = " . $row["cpu"];
	$sql5 = "SELECT * FROM `resolution` WHERE `id` = " . $row["resolution"];

	$brand = $result->query($sql2);
	$gpu = $result->query($sql3);
	$cpu = $result->query($sql4);
	$resolution = $result->query($sql5);

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
				<div class="prijs">
					<h3>Prijs: &euro;<?php echo $row["price"]; ?></h3>
				</div>
				<div class="spec-list">
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
							<td><?php echo $row["diagonal"] . "\""; ?></td>
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
			</div>
			<div class="side-space">
				<!-- side space -->
			</div>
		</div>

<?php
}
?>