<?php

namespace Brain\Games\Lib;

use function cli\line;
use function cli\prompt;

const NUMBER_OF_QUESTIONS = 3;

/**
 * Game engine
 * @param string $task task for the player
 * @param callable $generateGameData callback must implement the logic of one question of the game,
 * return an associative array with the keys 'answer' and 'correct_answer',
 * to get the player's answer and the correct answer to one question
 */

function runGame(string $task, callable $generateGameData)
{
    try {
        line("Welcome to Brain Games!");
        line($task);

        $name = prompt("May I have your name?");
        line("Hello, %s", $name);

        for ($i = 0; $i < NUMBER_OF_QUESTIONS; $i++) {

            ['question' => $question, 'correctAnswer' => $correctAnswer] = $generateGameData();
            line("Question: %s", $question);
            $playerAnswer = trim(strtolower(prompt("Your answer")));

            if ($playerAnswer === $correctAnswer) {
                line("Correct!");
            } else {
                line("'$playerAnswer' is wrong answer ;(. Correct answer was '$correctAnswer'.");
                line("Let's try again, %s", $name);
                return;
            }
        }
        line("Congratulations, %s", $name);
    } catch (\Exception $e) {
        line($e->getMessage());
    }
}
