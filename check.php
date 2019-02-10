<?php
/**
 * Created by PhpStorm.
 * User: Proga
 * Date: 06.02.2019
 * Time: 17:21
 * проверка на наличие данных в сессии, если нет, то создаются экстрасенсы
 */

include "Extra.php";
session_start();
if (empty($_SESSION['name'])) {
    // создаем имена
    if (isset($_POST['dataExtra'])) {
        for ($i = 0; $i < $_POST['dataExtra']; $i++) {
            $name[] = new Extra("экстрасенс " .($i+1));
        }
        $_SESSION['name'] = $name;
        for ($i = 0; $i < count($_SESSION['name']); $i++) {
            $extra['name'][] = $_SESSION['name'][$i]->name;
        }
        echo json_encode($extra);
    } else {
        if (isset($_SESSION['name'])) {
            $extra = false;
            echo json_encode($extra);
        }
    }
} else {
    // отправка данных (имена, значения )
    if (isset($_SESSION['name']) && isset($_SESSION['user'])) {
        for ($i = 0; $i < count($_SESSION['name']); $i++) {
            $extra['name'][] = $_SESSION['name'][$i]->name;
        }
        $extra['numberExtraArray'] = $_SESSION['name'];
        $extra['numberUser'] = $_SESSION['user'];
        echo json_encode($extra);
// отправка клиенту список имен экстрасенсов
    } else if (isset($_SESSION['name'])) {
        for ($i = 0; $i < count($_SESSION['name']); $i++) {
            $extra['name'][] = $_SESSION['name'][$i]->name;
        }
        echo json_encode($extra);
    }
}