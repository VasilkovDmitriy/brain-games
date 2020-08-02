<?php

namespace Brain\Games\BrainCalc;

use function Brain\Games\Lib\runGames;

const MIN_NUMBER_1 = 1;
const MAX_NUMBER_1 = 10;
const MIN_NUMBER_2 = 1;
const MAX_NUMBER_2 = 10;

/**
 * Calculates the input expression
 * @param int $num1 first number
 * @param int $num2 second number
 * @param string $op mathematic operation
 * @return bool|float|int expression result or false in case of failure
 * @throws \Exception unknown operator
 */
function calculate(int $num1, int $num2, string $op)
{
    switch ($op) {
        case '+':
            return $num1 + $num2;
        case '-':
            return $num1 - $num2;
        case '*':
            return$num1 * $num2;
        default:
            throw new \Exception("unknown operator $op");
    }
}

/**
 *The function implements the logic of one question in the game and starts the game engine
 */
function runBrainCalc()
{
    $operations = ['+', '-', '*'];

    $generateCalcQuestion = function () use ($operations) {
        $number1 = rand(MIN_NUMBER_1, MAX_NUMBER_1);
        $number2 = rand(MIN_NUMBER_2, MAX_NUMBER_2);
        $op = $operations[array_rand($operations)];

        $questionParameter = "$number1 $op $number2";
        $correctAnswer = (string)calculate($number1, $number2, $op);

        return ['questionParameter' => $questionParameter, 'correctAnswer' => $correctAnswer];
    };

    $task = "What is the result of the expression?";
    runGames($task, $generateCalcQuestion);
}
