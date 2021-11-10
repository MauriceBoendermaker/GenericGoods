<?php require "config.php"; ?>
<?php require "include/head.php"; ?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

<nav class="navbar navbar-expand-md navbar-dark justify-content-between" style="background-color: rgb(205, 0, 0);">
    <a class="navbar-brand" href="./">Generic Goods</a>
    <div>
        <form class="form-inline justify-content-center" style="text-align: center;">
            <div class="input-group">
                <input class="form-control" type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Zoeken..." aria-label="Search">
                <div class="input-group-append">
                    <button class="input-group-text" type="submit"><img src="https://www.svgrepo.com/show/14071/search.svg" height="128" width="128" style="width: 20px; height: 20px;"></button>
                </div>
            </div>
        </form>
    </div>
    <div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item active">
                    <a class="nav-link" href="#" style="margin-right: 5px;">Basket</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" style="margin-right: 5px;">User</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container" style="padding-top: 15px;">
    <div class="jumbotron row">
        <div class="col-lg-3 pt-3" style="background-color: #f6f6f6; border-radius: 5px">
            <h4>Quick Filters</h4>
            <hr>
            <h6>Laptop merk filter</h6>
            <div id="filtertnContainer" class="mb-5">
                <button class="btn active" onclick="filterSelection('all')"> Show all</button>
                <button class="btn" onclick="filterSelection('Lenovo')"> Lenovo</button>
                <button class="btn" onclick="filterSelection('Asus')"> Asus</button>
                <button class="btn" onclick="filterSelection('Acer')"> Acer</button>
                <button class="btn" onclick="filterSelection('HP')"> HP</button>
                <button class="btn" onclick="filterSelection('Dell')"> Dell</button>
                <button class="btn" onclick="filterSelection('Gigabyte')"> Gigabyte</button>
            </div>
            <h4>Filters</h4>
            <form>
                <hr>
                <fieldset>
                    <h6>CPU</h6>
                    <label class="btn">
                        <input type="radio" name="cpu" value=""> None
                    </label>
                    <label class="btn">
                        <input type="radio" name="cpu" value="1"> Intel Core i3
                    </label>
                    <label class="btn">
                        <input type="radio" name="cpu" value="2"> Intel Core i5
                    </label>
                    <label class="btn">
                        <input type="radio" name="cpu" value="3"> Intel Core i7
                    </label>
                    <label class="btn">
                        <input type="radio" name="cpu" value="4"> Intel Core i9
                    </label>
                    <label class="btn">
                        <input type="radio" name="cpu" value="5"> AMZ Ryzen 5
                    </label>
                </fieldset>
                <hr>
                <fieldset>
                    <h6>GPU</h6>
                    <label class="btn">
                        <input type="radio" name="gpu" value=""> None
                    </label>
                    <label class="btn">
                        <input type="radio" name="gpu" value="1"> NVIDIA GeForce GTX 1650
                    </label>
                    <label class="btn">
                        <input type="radio" name="gpu" value="2"> NVIDIA GeForce GTX 1660 ti
                    </label>
                    <label class="btn">
                        <input type="radio" name="gpu" value="3"> NVIDIA GeForce RTX 2060
                    </label>
                    <label class="btn">
                        <input type="radio" name="gpu" value="4"> NVIDIA GeForce RTX 2080 Super
                    </label>
                    <label class="btn">
                        <input type="radio" name="gpu" value="5"> NVIDIA GeForce RTX 3070
                    </label>
                    <label class="btn">
                        <input type="radio" name="gpu" value="6"> NVIDIA GeForce RTX 3080
                    </label>
                </fieldset>
                <hr>
                <fieldset>
                    <h6>Storage</h6>
                    <label class="btn">
                        <input type="radio" name="storagetype" value=""> None
                    </label>
                    <label class="btn">
                        <input type="radio" name="storagetype" value="HDD"> HDD
                    </label>
                    <label class="btn">
                        <input type="radio" name="storagetype" value="SSD"> SSD
                    </label>
                    <label class="btn">
                        <input type="radio" name="storagetype" value="SHDD"> SHDD
                    </label>
                </fieldset>
                <hr>
                <button class="btn" type="submit">Apply</button>
            </form>
        </div>
        <div class="col-lg-9 row mx-auto">
        <?php
        $sql = "";

        $filterList = ["search", "price", "storagetype", "brand", "cpu", "gpu"];
        $filters = array_keys_exists($filterList, $_GET);

        if ($filters) {
            $sql = "SELECT * FROM `laptop` WHERE ";
            $queries = [];
            foreach ($filters as $key => $value) {
                $val = htmlspecialchars($value);

                if (empty($val)) continue;

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
            if (count($queries) > 0)
                $sql .= implode(" AND ", $queries);
            else
                $sql = "SELECT * FROM `laptop`";
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


            echo "<div style=\" background-color: lightgray; width: 250px;\" class=\"m-1 column1 filterDiv ".$brandName["name"]."\"><div class='row'>";
            echo "<div class='justify-content-md-center col-md-12'><img class='mx-auto' style='width: 100%' src=\"./images/".$row["thumbnail"]."\" /></div>";
            echo "<div class='col-md-12 brandName text-center'>
				<a href='template.php?id=".$row["identifier"]."'>".$brandName["name"]." ".$row["name"]."</a>
			</div>";
            echo "<div class='col-md-12 text-center text-secondary'><p>".$gpuName["name"]."</p></div>";
            echo "<div class='col-md-12 text-center text-muted'><p>".$row["storagesize"]. " ". $row["storagetype"]."</p></div>";
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
    </div>

    <footer class="footer">
        <p>© GenericGoods 2021</p>
    </footer>

</div> <!-- /container -->

<script>
    filterSelection("all")
    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c == "all") c = "";
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
            if (x[i].className.indexOf(c) > -1) x[i].style.display = "inline";
            //w3RemoveClass(x[i], "show");
            //if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
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
