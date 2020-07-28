<?php

namespace Brain\Games\BrainEven;

const START_INTERVAL = 1;
const END_INTERVAL = 99;

use function Brain\Games\Lib\question;
use function Brain\Games\Lib\runGames;

function checkEven(int $number): bool
{
    return $number % 2 === 0;
}

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
