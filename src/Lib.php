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
    line("Hello, %s", $name);
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
 * @param string $correctAnswer correct answer
 */
function loss(string $name, string $answer, string $correctAnswer)
{
    line("'$answer' is wrong answer ;(. Correct answer was '$correctAnswer'.");
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
 * @param callable $generateGameData callback must implement the logic of one question of the game,
 * return an associative array with the keys 'answer' and 'correct_answer',
 * to get the player's answer and the correct answer to one question
 */
function runGames(string $task, callable $generateGameData)
{
    try {
        taskPrint($task);
        $name = nameQuery();

        for ($i = 0; $i < NUMBER_OF_QUESTIONS; $i++) {
            $gameData = $generateGameData();
            $answer = question($gameData['questionParameter']);

            if ($answer === $gameData['correctAnswer']) {
                line("Correct!");
            } else {
                loss($name, $answer, $gameData['correctAnswer']);
                return;
            }
        }
        win($name);
    } catch (\Exception $e) {
        line($e->getMessage());
    }
}
