<?php require "config.php"; ?>
<?php require "include/head.php"; ?>
<style>
    * {
        box-sizing: border-box;
    }

    .filterDiv {
        /*    !*float: left;*!*/
        /*    width: 250px;*/
        /*    height: auto;*/
        /*    background-color: #2196F3;*/
        /*    color: #ffffff;*/
        /*    !*line-height: 100px;*!*/
        /*    text-align: center;*/
        /*    !*margin: 10px;*!*/
        display: none;
    }

    .show {
        display: block;
    }

    .container {
        /*margin-top: 20px;*/
        /*overflow: hidden;*/
    }

    /* Style the buttons */
    .btn {
        border: none;
        outline: none;
        /*padding: 12px 16px;*/
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #ddd;
    }

    .btn.active {
        background-color: #666;
        color: white;
    }

    .column1 {
        float: left;
        /*width: 33.33%;*/
        /*height: 300px; !* Should be removed. Only for demonstration *!*/
    }

    .row1:after {
        content: "";
        display: table;
        clear: both;
    }

    .brandName {
        font-size: 24px;
    }
</style>
<body>

<h2>Laptop merk filter</h2>

<form class="justify-content-center">
    <input class="col-md-8" type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Zoek...">
    <input class="col-md-auto btn btn-primary btn-lg" type="submit" value="Search">
</form>

<div id="filtertnContainer">
	<button class="btn active" onclick="filterSelection('all')"> Show all</button>
	<button class="btn" onclick="filterSelection('Lenovo')"> Lenovo</button>
	<button class="btn" onclick="filterSelection('Asus')"> Asus</button>
	<button class="btn" onclick="filterSelection('Acer')"> Acer</button>
	<button class="btn" onclick="filterSelection('HP')"> HP</button>
	<button class="btn" onclick="filterSelection('Dell')"> Dell</button>
	<button class="btn" onclick="filterSelection('Gigabyte')"> Gigabyte</button>
</div>

<div class="row1" style="background-color: gray">
	<?php
    $sql = "";

    $filterList = ["search", "price", "storagetype", "brand", "cpu", "gpu"];
    $filters = array_keys_exists($filterList, $_GET);

    if ($filters) {
        $sql = "SELECT * FROM `laptop` WHERE ";
        $queries = [];
        foreach ($filters as $key => $value) {
            $val = htmlspecialchars($value);
            switch (htmlspecialchars($key)) {
                case "search":
                    array_push($queries, "( `name` LIKE '%{$val}%' OR `identifier` LIKE '%{$val}%')");
                    break;
                case "price":
                    array_push($queries, "`price` <= {$val}");
                    break;
                case "storagetype":
                    array_push($queries, "`storagetype` = '{$val}'");
                    break;
                case "brand":
                    array_push($queries, "`brand` = {$val}");
                    break;
                case "cpu":
                    array_push($queries, "`cpu` = {$val}");
                    break;
                case "gpu":
                    array_push($queries, "`gpu` = {$val}");
                    break;
            }
        }
        $sql .= implode(" AND ", $queries);
    } else
        $sql = "SELECT * FROM `laptop`";

	$result = $con->query($sql);

	while($row = $result->fetch_assoc()) {
		$sql2 = "SELECT * FROM `brand` WHERE `id` = " . $row["brand"];
		$sql3 = "SELECT * FROM `gpu` WHERE `id` = " . $row["gpu"];
		$sql4 = "SELECT * FROM `laptop` WHERE `id` = " . $row["brand"];

		$brand = $con->query($sql2);
		$gpu = $con->query($sql3);
		$identifier = $con->query($sql4);

		$brandName = $brand->fetch_assoc();
		$gpuName = $gpu->fetch_assoc();
		$identifierName = $identifier->fetch_assoc();

		echo "<div style=\" background-color: lightgray; width: 250px;\" class=\" column1\"><div class='filterDiv ".$brandName["name"]."'>";
		echo "<div class='col-md-12 '><img class='mx-auto' style='width: 100%' src=\"./images/".$row["thumbnail"]."\" /></div>";
		echo "<div class='col-md-12 brandName'>
				<a href='template.php?id=".$row["identifier"]."'>".$brandName["name"]." ".$row["name"]."</a>
			</div>";
		echo "<div class='col-md-12 '><p>".$gpuName["name"]."</p></div>";
		echo "<div class='col-md-6 '><p>".$row["storagesize"]."</p></div>";
		echo "<div class='col-md-6 '><p>".$row["storagetype"]."</p></div>";
		echo "</div></div>";
	}
    if ($result->num_rows == 0) {
        /* TODO: add a formatted message */
        echo "No search results";
    }

    function array_keys_exists(array $keys, array $arr) {
        return array_intersect_key($arr, array_flip($keys));
    }
	?>
</div>

<script>
    filterSelection("all")
    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c == "all") c = "";
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
    }

    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
        }
    }

    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }

    var btnContainer = document.getElementById("filterBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function(){
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>

</body>
</html>
