<?php
require_once("PHP/DatabaseConfig.php");

$con = mysqli_connect($hostname, $username, $password, $dbname)
or die("Kan niet verbinden met de database!");
mysqli_set_charset($con, 'utf8');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laptop</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body class="w-90 px-5">
    <div class="w-50 mx-auto row">
        <form class="justify-content-center">
            <input class="col-md-8" type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Zoek...">
            <input class="col-md-auto btn btn-primary btn-lg" type="submit" value="Search">
        </form>
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

        //echo $sql; /* Shows the search query */

        $result = $con->query($sql);

        if (!$result) {
            echo "Query failed";
            return;
        }
        while($row = $result->fetch_assoc()) {
            $sql2 = "SELECT * FROM `brand` WHERE `id` = ".$row["brand"];
            $sql3 = "SELECT * FROM `gpu` WHERE `id` = ".$row["gpu"];
            $brand = $con->query($sql2);
            $gpu = $con->query($sql3);

            $brandName = $brand->fetch_assoc();
            $gpuName = $gpu->fetch_assoc();

            echo "<div class=\"container col-md-3 m-1 ratio-9x16 laptopContainer\"><div class='row'>";
                echo "<div class='col-md-12'><img class='mt-3 mx-auto thumbnail' src=\"./images/".$row["thumbnail"]."\" /></div>";
                echo "<div class='col-md-12 text-center'><a href='./".$row["id"]."'>".$brandName["name"]." ".$row["name"]."</a></div>";
                echo "<div class='col-md-12 text-center text-secondary'><p>".$gpuName["name"]."</p></div>";
                echo "<div class='col-md-6 text-center text-secondary'><p>".$row["storagesize"]."</p></div>";
                echo "<div class='col-md-6 text-center text-secondary'><p>".$row["storagetype"]."</p></div>";
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
</body>
</html>
