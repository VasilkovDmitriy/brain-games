<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Lib\runGame;

const PROGRESSION_LENGTH = 10;
const MIN_PROGRESSION_START = 1;
const MAX_PROGRESSION_START = 9;
const MIN_PROGRESSION_STEP = 2;
const MAX_PROGRESSION_STEP = 10;

/**
 *The function implements the logic of one question in the game and starts the game engine
 */
function runBrainProgression()
{
    $generateProgressionQuestion = function () {

        $startOfProgression = rand(MIN_PROGRESSION_START, MAX_PROGRESSION_START);
        $progressionStep = rand(MIN_PROGRESSION_STEP, MAX_PROGRESSION_STEP);
        $endOfProgression = ($startOfProgression + $progressionStep * PROGRESSION_LENGTH) - 1;

        $progression = range($startOfProgression, $endOfProgression, $progressionStep);

        $hiddenElementIndex = array_rand($progression);
        $correctAnswer = (string) $progression[$hiddenElementIndex];
        $progression[$hiddenElementIndex] = '..';

        $question = implode(' ', $progression);

        return [ 'question' => $question, 'correctAnswer' => $correctAnswer];
    };

    $task = "What number is missing in the progression?";
    runGame($task, $generateProgressionQuestion);
}
