<?php

namespace Brain\Games\BrainProgression;

use function Brain\Games\Lib\runGames;

const PROGRESSION_LENGTH = 10;
const MIN_PROGRESSION_START = 1;
const MAX_PROGRESSION_START = 9;
const MIN_PROGRESSION_STEP = 2;
const MAX_PROGRESSION_STEP = 10;

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
function runBrainProgression()
{
    $generateProgressionQuestion = function () {

        $progression = getProgression();

        $hiddenElementIndex = array_rand($progression);
        $correctAnswer = (string) $progression[$hiddenElementIndex];
        $progression[$hiddenElementIndex] = '..';

        $questionParameter = implode(' ', $progression);

        return [ 'questionParameter' => $questionParameter, 'correctAnswer' => $correctAnswer];
    };

    $task = "What number is missing in the progression?";
    runGames($task, $generateProgressionQuestion);
}
