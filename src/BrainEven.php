<?php

/**
 * CLI game - "Parity check"
 *
 * @author Dmitriy Vasilkov <d.vasilckoff@yandex.ru>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */

namespace Brain\Games\BrainEven;

use function cli\line;
use function cli\prompt;

/**
 * Checks the received number for evenness
 *
 * @param int $number - checked number
 * @return bool result of checking
 */

function checkEven(int $number): bool
{
    return $number % 2 === 0;
}

/**
 * Winning message
 *
 * @param string $name - player name
 * @return void
 */

function win(string $name)
{
    line("Congratulations, %s", $name);
}

/**
 * Loss message
 *
 * @param string $name - player name
 * @param string $answer - player answer
 * @param string $correct_answer
 * @return void
 */

function loss(string $name, string $answer, string $correct_answer)
{
    line("'$answer' is wrong answer ;(. Correct answer was '$correct_answer'.");
    line("Let's try again, %s", $name);
}

/**
 * Input filter
 *
 * @param string input string
 */

function clearInput(string $str)
{
    return trim(strtolower($str));
}

/**
 * The main logic of the game "parity check"
 *
 * @return void
 */

function brainEven()
{
    line("Welcome to Brain Games!");
    line("Answer \"yes\" if the number is even, otherwise answer \"no\".\n");

    $name = prompt("May I have your name?");
    line("Hello, %s\n", $name);

    $count_correct_answer = 0;

    while (true) {
        $number = rand(1, 99);
        line("Question: %d", $number);

        $answer = clearInput(prompt("Your answer"));

        $is_even = checkEven($number);
        $correct_answer = $is_even ? "yes" : "no";
        
        if (!preg_match("/^yes$|^no$/", $answer)) {
            loss($name, $answer, $correct_answer);
            break;
        }

        if ($answer === $correct_answer) {
            $count_correct_answer++;
        } else {
            loss($name, $answer, $correct_answer);
            break;
        }

        if ($count_correct_answer === 3) {
            win($name);
            break;
        }
    }
}
