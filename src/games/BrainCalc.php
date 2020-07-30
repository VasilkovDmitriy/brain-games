<?php

namespace Brain\Games\Games\BrainCalc;

const MIN_NUMBER_1 = 1;
const MAX_NUMBER_1 = 10;
const MIN_NUMBER_2 = 1;
const MAX_NUMBER_2 = 10;

use function Brain\Games\Lib\question;
use function Brain\Games\Lib\runGames;

function calculate($num1, $num2, $op)
{
    $output = 0;

    switch ($op) {
        case '+':
            $output = $num1 + $num2;
            break;
        case '-':
            $output = $num1 - $num2;
            break;
        case '*':
            $output = $num1 * $num2;
            break;
        default:
            return false;
    }
    return $output;
}

function brainCalc()
{
    $operations = ['+', '-', '*'];

    $calcQuestion = function () use ($operations) {
        [$number1, $number2] = [rand(MIN_NUMBER_1, MAX_NUMBER_1), rand(MIN_NUMBER_2, MAX_NUMBER_2)];
        $count_operations = count($operations);
        $op = $operations[rand(0, $count_operations - 1)];
        $expression = "$number1 $op $number2";

        $answer = question($expression);
        $correct_answer = (string) calculate($number1, $number2, $op);

        return [ 'answer' => $answer, 'correct_answer' => $correct_answer];
    };

    $task = "What is the result of the expression?\n";
    runGames($task, $calcQuestion);
}
