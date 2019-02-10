<?php
/**
 * Created by PhpStorm.
 * User: Proga
 * Date: 07.02.2019
 * Time: 17:33
 */

if(empty($_SESSION['name'])) {
    echo 'пустой';
    for($i=0;$i < $_POST['dataExtra']; $i++) {
        $name['name'][] = new extra("Экстрасенс - " ."$i");
        $_SESSION['name'][] = $name['name'][$i]->name;
    }
    $nameDate = $_SESSION['name'];
    var_dump(json_encode($nameDate));
}
else {
    $nameDate = $_SESSION['name'];
    var_dump(json_encode($nameDate));
}