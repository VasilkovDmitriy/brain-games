<?php

namespace Brain\Games\BrainCalc;

const MIN_NUMBER_1 = 1;
const MAX_NUMBER_1 = 10;
const MIN_NUMBER_2 = 1;
const MAX_NUMBER_2 = 10;

use function Brain\Games\Lib\question;
use function Brain\Games\Lib\runGames;
use function cli\line;

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
        $op = $operations[rand(0, 2)];
        $expression = "$number1 $op $number2";

        $answer = (int) question($expression);
        $correct_answer = calculate($number1, $number2, $op);

        if ($answer === $correct_answer) {
            $right = true;
            line("Correct!\n");
        } else {
            $right = false;
        }
        return [ 'right' => $right, 'answer' => $answer, 'correct_answer' => $correct_answer];
    };

    $task = "Answer \"yes\" if the number is even, otherwise answer \"no\".\n";
    runGames($task, $calcQuestion);
}
