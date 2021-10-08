<?php
    require_once('../classes/LaptopBase.php');

    $pageID = number_format($_GET["id"]);

    //echo var_dump(LaptopBase::GetLaptops(1, 3));
    LaptopBase::GetLaptopList()
?>

