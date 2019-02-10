<?php
/**
 * Created by PhpStorm.
 * User: Proga
 * Date: 06.02.2019
 * Time: 17:21
 */

include "Extra.php";
session_start(); //ПЕРВЫМ ДЕЛОМ ОТПРАВЛЯЮ СЮДА, ДЛЯ ПРОВЕРКИ ЕСТЬ ЛИ СЕССИЯ
if (empty($_SESSION['name'])) {
    if (isset($_POST['dataExtra'])) { //dataEtra - число экстрасенсов
        for ($i = 0; $i < $_POST['dataExtra']; $i++) {
            /* 1. ключ 'name' у переменной $name не нужен. /++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            2.не критично, но лучше писать "Экстрасенс - $i" или "Экстрасенс - ".$i*/  //+++++++++++++++++++++++++++++++
            $name[] = new Extra("экстрасенс " . "$i");
            /*лучше вынести за цикл и сохранить сразу переменную $name*/ //+++++++++++++++++++++++++++++++++++++++++++++
        }
        $_SESSION['name'] = $name; // В СЕССИЮ СОХРАНИЛ ЭКЗЭМПЛЯР КЛАССА
        /*тут у тебя на выходе останется только последнее имя, остальные просто перезатрутся в переменной $nameDate*/
        for ($i = 0; $i < count($_SESSION['name']); $i++) { // В ПЕРЕМЕННУЮ ЗАПИСЫВАЮ ИМЕНА ИЗ ЭКЗЭМПЛЯРА
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
    // если есть в сессии и число и имена , тогда просто перебираю их и отправляю клиенту
    if (isset($_SESSION['name']) && isset($_SESSION['user'])) {
        for ($i = 0; $i < count($_SESSION['name']); $i++) {// В ПЕРЕМЕННУЮ ЗАПИСЫВАЮ ИМЕНА ИЗ ЭКЗЭМПЛЯРА
            $extra['name'][] = $_SESSION['name'][$i]->name;
        }
        $extra['numberExtraArray'] = $_SESSION['name'];
        $extra['numberUser'] = $_SESSION['user'];
        echo json_encode($extra);
//        echo (json_encode($extraArra));
    } else if (isset($_SESSION['name'])) { // ЕСЛИ ЕСТЬ ИМЯ БЕЗ ДАННЫХ, ТО ОТПРАВЛЯЕМ ИХ
        for ($i = 0; $i < count($_SESSION['name']); $i++) {// В ПЕРЕМЕННУЮ ЗАПИСЫВАЮ ИМЕНА ИЗ ЭКЗЭМПЛЯРА
            $extra['name'][] = $_SESSION['name'][$i]->name;
        }
        echo json_encode($extra);
    }
}