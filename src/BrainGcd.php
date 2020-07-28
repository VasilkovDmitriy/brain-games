<?php

namespace Brain\Games\BrainGcd;

const MIN_NUMBER_1 = 1;
const MAX_NUMBER_1 = 100;
const MIN_NUMBER_2 = 1;
const MAX_NUMBER_2 = 100;

use function Brain\Games\Lib\question;
use function Brain\Games\Lib\runGames;

function findGcd(int $a, int $b): int
{
    while ($a !== 0 and $b !== 0) {
        if ($a > $b) {
            $a %= $b;
        } else {
            $b %= $a;
        }
    }
    return $a + $b;
}

function brainGcd()
{
    $gcdQuestion = function () {
        $number1 = rand(MIN_NUMBER_1, MAX_NUMBER_1);
        $number2 = rand(MIN_NUMBER_2, MAX_NUMBER_2);
        $answer = question("$number1 $number2");

        $correct_answer = (string) findGcd($number1, $number2);

        return ['answer' => $answer, 'correct_answer' => $correct_answer];
    };

    $task = "Find the greatest common divisor of given numbers..\n";
    runGames($task, $gcdQuestion);
}
