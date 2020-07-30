<?php

namespace Brain\Games\Games\BrainPrime;

const MIN_NUMBER = 1;
const MAX_NUMBER = 200;

use function Brain\Games\Lib\question;
use function Brain\Games\Lib\runGames;

function isPrime(int $number)
{
    if ($number === 1) {
        return false;
    }
    if ($number % 2 === 0) {
        return $number === 2;
    }

    $d = 3;
    while ($d * $d <= $number and $number % $d !== 0) {
        $d += 2;
    }
    return $d * $d > $number;
}

function getNumber()
{
    $number = rand(MIN_NUMBER, MAX_NUMBER);

    return $number % 2 === 0 ? ++$number : $number;
}

function brainPrime()
{
    $primeQuestion = function () {

        $number = getNumber();

        $correct_answer = isPrime($number) ? "yes" : "no";

        $answer = question($number);

        return ['answer' => $answer, 'correct_answer' => $correct_answer];
    };

    $task = "Answer \"yes\" if given number is prime. Otherwise answer \"no\".\n";
    runGames($task, $primeQuestion);
}
