<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Lib\runGame;

const MIN_NUMBER_1 = 1;
const MAX_NUMBER_1 = 10;
const MIN_NUMBER_2 = 1;
const MAX_NUMBER_2 = 10;

/**
 * Calculates the input expression
 * @param int $number1 first number
 * @param int $number2 second number
 * @param string $mathematicalOperation mathematical operation
 * @return bool|float|int expression result or false in case of failure
 * @throws \Exception unknown operator
 */
function calculate(int $number1, int $number2, string $mathematicalOperation)
{
    switch ($mathematicalOperation) {
        case '+':
            return $number1 + $number2;
        case '-':
            return $number1 - $number2;
        case '*':
            return$number1 * $number2;
        default:
            throw new \Exception("unknown operator $mathematicalOperation");
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

        $question = "$number1 $op $number2";
        $correctAnswer = (string)calculate($number1, $number2, $op);

        return ['question' => $question, 'correctAnswer' => $correctAnswer];
    };

    $task = "What is the result of the expression?";
    runGame($task, $generateCalcQuestion);
}
