<?php

namespace Brain\Games\Lib;

use function cli\line;
use function cli\prompt;

const NUMBER_OF_QUESTIONS = 3;

function nameQuery()
{
    $name = prompt("May I have your name?");
    line("Hello, %s\n", $name);
    return $name;
}

function taskPrint(string $task)
{
    line("Welcome to Brain Games!");
    line($task);
}

function win(string $name)
{
    line("Congratulations, %s", $name);
}

function loss(string $name, string $answer, string $correct_answer)
{
    line("'$answer' is wrong answer ;(. Correct answer was '$correct_answer'.");
    line("Let's try again, %s", $name);
}

function clearInput(string $str)
{
    return trim(strtolower($str));
}

function question(string $expression)
{
    line("Question: %s", $expression);
    return clearInput(prompt("Your answer"));
}

function runGames($task, $callback)
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
