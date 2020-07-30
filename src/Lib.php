<?php

namespace Brain\Games\Lib;

use function cli\line;
use function cli\prompt;

const NUMBER_OF_QUESTIONS = 3;

/**
 * Get a player name
 * @return string a player name
 */
function nameQuery(): string
{
    $name = prompt("May I have your name?");
    line("Hello, %s\n", $name);
    return $name;
}

/**
 * Displays a task for the player
 * @param string $task the task for the player
 */
function taskPrint(string $task)
{
    line("Welcome to Brain Games!");
    line($task);
}

/**
 * Displays a message about the player's victory
 * @param string $name player name
 */
function win(string $name)
{
    line("Congratulations, %s", $name);
}

/**
 * Displays a message on the player's loss
 * @param string $name player name
 * @param string $answer player answer
 * @param string $correct_answer correct answer
 */
function loss(string $name, string $answer, string $correct_answer)
{
    line("'$answer' is wrong answer ;(. Correct answer was '$correct_answer'.");
    line("Let's try again, %s", $name);
}

/**
 * Filtering input
 * @param string $str
 * @return string
 */
function clearInput(string $str)
{
    return trim(strtolower($str));
}

/**
 * Asks a question to the player and gets an answer
 * @param string $expression expression for question
 * @return string player answer
 */
function question(string $expression)
{
    line("Question: %s", $expression);
    return clearInput(prompt("Your answer"));
}

/**
 * Game engine
 * @param string $task task for the player
 * @param callable $callback callback must implement the logic of one question of the game,
 * return an associative array with the keys 'answer' and 'correct_answer',
 * to get the player's answer and the correct answer to one question
 */
function runGames(string $task, callable $callback)
{
    taskPrint($task);
    $name = nameQuery();

    $count_correct_answer = 0;
    $result = [];

    for ($i = 0; $i < NUMBER_OF_QUESTIONS; $i++) {
        $result = $callback();

        if ($result['answer'] === $result['correct_answer']) {
            $count_correct_answer++;
            line("Correct!\n");
        } else {
            break;
        }
    }

    $count_correct_answer === NUMBER_OF_QUESTIONS
        ? win($name)
        : loss($name, $result['answer'], $result['correct_answer']);
}
