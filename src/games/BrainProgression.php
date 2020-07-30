<?php

namespace Brain\Games\Games\BrainProgression;

const PROGRESSION_LENGTH = 10;
const MIN_PROGRESSION_START = 1;
const MAX_PROGRESSION_START = 9;
const MIN_PROGRESSION_STEP = 2;
const MAX_PROGRESSION_STEP = 10;

use function Brain\Games\Lib\question;
use function Brain\Games\Lib\runGames;

/**
 * Get a random progression according to the parameters described in constants
 * @return array random progression
 */
function getProgression(): array
{
    $start = rand(MIN_PROGRESSION_START, MAX_PROGRESSION_START);
    $step = rand(MIN_PROGRESSION_STEP, MAX_PROGRESSION_STEP);
    $end = ($start + $step * PROGRESSION_LENGTH) - 1;

    return range($start, $end, $step);
}

/**
 *The function implements the logic of one question in the game and starts the game engine
 */
function brainProgression()
{
    $progressionQuestion = function () {

        $progression = getProgression();

        $hidden_element_index = rand(0, count($progression) - 1);
        $correct_answer = (string) $progression[$hidden_element_index];

        $progression[$hidden_element_index] = '..';

        $answer = question(implode(' ', $progression));

        return ['answer' => $answer, 'correct_answer' => $correct_answer];
    };

    $task = "What number is missing in the progression?\n";
    runGames($task, $progressionQuestion);
}
