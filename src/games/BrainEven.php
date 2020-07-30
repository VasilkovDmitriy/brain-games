<?php

namespace Brain\Games\Games\BrainEven;

const START_INTERVAL = 1;
const END_INTERVAL = 99;

use function Brain\Games\Lib\question;
use function Brain\Games\Lib\runGames;

/**
 * Checks whether the number is even
 * @param int $number Checked number
 * @return bool True if the number is even, otherwise false
 */
function checkEven(int $number): bool
{
    return $number % 2 === 0;
}

/**
 *The function implements the logic of one question in the game and starts the game engine
 */
function brainEven()
{
    $evenQuestion = function () {
        $number = rand(START_INTERVAL, END_INTERVAL);
        $answer = question($number);

        $is_even = checkEven($number);
        $correct_answer = $is_even ? "yes" : "no";

        return ['answer' => $answer, 'correct_answer' => $correct_answer];
    };

    $task = "Answer \"yes\" if the number is even, otherwise answer \"no\".\n";
    runGames($task, $evenQuestion);
}
