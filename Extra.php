<?php
/**
 * Created by PhpStorm.
 * User: Proga
 * Date: 06.02.2019
 * Time: 16:15
 * $name - имя экстрасенса (string)
 * $numberGuessed - предположение экстрасенса (Array[number])
 * $prestige - претсиж экстраскнса (Array[number])
 * $matchId - значение для отоброжения (boolean)
 *
 *
 */

class Extra
{
    public $name;
    public $numberGuessed;
    public $prestige;
    public $matchId;

    /**
     * Extra constructor.
     *
     * входные параматры
     *  name - имя экстрасесна
     * выходные параметры
     *  name - имя экстрасенса
     *  prestige - массив престижа эсктрасенса
     *  numberGuessed - массив догадок экстрасенса
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->prestige = 50;
        $this->numberGuessed = array();
    }

    /**
     * Функция по определнию престижа, предположительного числа и активного значения( отгадал или нет)
     * входные параметры
     *  userNumber - число загаданное пользователем
     * выходные параметры
     *  prestige - добавленное значение в массив престижа
     *  numberGuessed - добавленное значение в массив догадок
     *  $matchId - добавленное булевское значение в массив совпадений
     */
    function generationRand($userNumber)
    {
        if ($userNumber >= 10 && $userNumber <= 99) {
            if ($userNumber >= 10 && $userNumber <= 25) {
                if ($userNumber >= 10 && $userNumber <= 15) {
                    $this->numberGuessed[] = rand(10, 15);
                } else {
                    $this->numberGuessed[] = rand(16, 25);
                }
            } else if ($userNumber >= 26 && $userNumber <= 50) {
                if ($userNumber >= 26 && $userNumber <= 35) {
                    $this->numberGuessed[] = rand(26, 35);
                } else if ($userNumber >= 36 && $userNumber <= 43) {
                    $this->numberGuessed[] = rand(36, 43);
                } else {
                    $this->numberGuessed[] = rand(44, 50);
                }
            } else if ($userNumber >= 51 && $userNumber <= 75) {
                if ($userNumber >= 51 && $userNumber <= 60) {
                    $this->numberGuessed[] = rand(51, 60);
                } else if ($userNumber >= 61 && $userNumber <= 69) {
                    $this->numberGuessed[] = rand(61, 69);
                } else {
                    $this->numberGuessed[] = rand(70, 75);
                }
            } else if ($userNumber >= 76 && $userNumber <= 99) {
                if ($userNumber >= 76 && $userNumber <= 84) {
                    $this->numberGuessed[] = rand(76, 84);
                } else if ($userNumber >= 85 && $userNumber <= 91) {
                    $this->numberGuessed[] = rand(85, 91);
                } else {
                    $this->numberGuessed[] = rand(92, 99);
                }
            }
        }
        switch ($this->numberGuessed) { /*Если делать так, ты будешь брать массив чисел, а тебе надо одно. Лучше перед генерацией объявить переменную, сохранить в нее числе сгенерированное, а потом его использовать здесь и добавлять в массив. И лучше сделать if, switch больше подходит, когда подразумевается несколько вариантов (блоков case больше одного)*/
        }
        $prestigeCheck = $this->numberGuessed;
        if (end($prestigeCheck) == $userNumber) {
            $this->prestige += 50;
            $this->matchId[] = true;
        } else {
            $this->prestige -= 50;
            $this->matchId[] = false;
        }
    }
}

;
