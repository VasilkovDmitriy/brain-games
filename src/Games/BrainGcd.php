<?php

namespace BrainGames\Games\BrainGcd;

use function BrainGames\Lib\runGame;

const MIN_NUMBER_1 = 1;
const MAX_NUMBER_1 = 100;
const MIN_NUMBER_2 = 1;
const MAX_NUMBER_2 = 100;

/**
 * Find the greatest common divisor
 * @param int $a first number
 * @param int $b second number
 * @return int a greatest common divisor
 */
function findGcd(int $a, int $b): int
{
    while ($a !== 0 && $b !== 0) {
        if ($a > $b) {
            $a %= $b;
        } else {
            $b %= $a;
        }
    }
    return $a + $b;
}

/**
 *The function implements the logic of one question in the game and starts the game engine
 */
function runBrainGcd()
{
    $generateGcdQuestion = function () {
        $number1 = rand(MIN_NUMBER_1, MAX_NUMBER_1);
        $number2 = rand(MIN_NUMBER_2, MAX_NUMBER_2);

        $question = "$number1 $number2";
        $correctAnswer = (string) findGcd($number1, $number2);

        return [ 'question' => $question, 'correctAnswer' => $correctAnswer];
    };

    $task = "Find the greatest common divisor of given numbers...";
    runGame($task, $generateGcdQuestion);
}
