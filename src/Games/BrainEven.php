<?php

namespace Brain\Games\Games\BrainEven;

use function Brain\Games\Lib\runGame;

const START_INTERVAL = 1;
const END_INTERVAL = 99;

/**
 * Checks whether the number is even
 * @param int $number Checked number
 * @return bool True if the number is even, otherwise false
 */
function isEven(int $number): bool
{
    return $number % 2 === 0;
}

/**
 *The function implements the logic of one question in the game and starts the game engine
 */
function runBrainEven()
{
    $generateEvenQuestion = function () {

        $question = rand(START_INTERVAL, END_INTERVAL);
        $correctAnswer = isEven($question) ? "yes" : "no";

        return [ 'question' => $question, 'correctAnswer' => $correctAnswer];
    };

    $task = 'Answer "yes" if the number is even, otherwise answer "no".';
    runGame($task, $generateEvenQuestion);
}
