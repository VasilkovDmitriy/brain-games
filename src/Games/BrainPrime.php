<?php

namespace Brain\Games\Games\BrainPrime;

use function Brain\Games\Lib\runGame;

const MIN_NUMBER = 1;
const MAX_NUMBER = 200;

/**
 * Checks if a prime number
 * @param int $number checked number
 * @return bool true if prime, or false
 */
function isPrime(int $number)
{
    if ($number <= 1) {
        return false;
    }
    $end = $number / 2;
    for ($i = 2; $i <= $end; $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

/**
 * Get a random odd number
 * @return int a random odd number
 */
function getOddNumber()
{
    $number = rand(MIN_NUMBER, MAX_NUMBER);

    return $number % 2 === 0 ? ++$number : $number;
}

/**
 *The function implements the logic of one question in the game and starts the game engine
 */
function runBrainPrime()
{
    $generatePrimeQuestion = function () {

        $question = getOddNumber();
        $correctAnswer = isPrime($question) ? "yes" : "no";

        return [ 'question' => $question, 'correctAnswer' => $correctAnswer];
    };

    $task = 'Answer "yes" if given number is prime. Otherwise answer "no".';
    runGame($task, $generatePrimeQuestion);
}
