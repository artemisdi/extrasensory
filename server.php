<?php
/**
 * Created by PhpStorm.
 * User: Amicum
 * Date: 04.02.2019
 * Time: 19:57
 */
include "Extra.php";
session_start();
// В этом файле генерирую престиж и отгаданные числа
$_SESSION['user'][] = $_POST['number'];
for ($i = 0; $i < count($_SESSION['name']); $i++) {
    $_SESSION['name'][$i]->generationRand($_POST['number']);
}
$extraArra['numberExtraArray'] = $_SESSION['name'];
$extraArra['numberUser'] = $_SESSION['user'];
echo(json_encode($extraArra));






