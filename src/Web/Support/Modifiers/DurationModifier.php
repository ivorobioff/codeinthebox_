<?php
namespace ImmediateSolutions\CodeInTheBox\Web\Support\Modifiers;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DurationModifier
{
    public function __invoke($hours)
    {
        if ($hours == 0 ) {
            return '0h';
        }

        $days  = 0;
        $weeks = 0;
        $months = 0;
        $years = 0;

        // calculations

        if ($hours >= 8 ) {
            $days = (int)($hours / 8);
            $hours = $hours % 8;
        }

        if ($days >= 5 ) {
            $weeks = (int)($days / 5);
            $days = $days % 5;
        }

        if ($weeks >= 4 ) {
            $months = (int)($weeks / 4);
            $weeks = $weeks % 4;
        }

        if ($months >= 12 ) {
            $years = (int)($months / 12);
            $months = $months % 12;
        }

        $result = '';

        if ($years) {
            $result .= $years.'y ';
        }

        if ($months) {
            $result .= $months.'m ';
        }

        if ($weeks) {
            $result .= $weeks.'w ';
        }

        if ($days) {
            $result .= $days.'d ';
        }

        if ($hours) {
            $result .= $hours.'h';
        }

        $result = rtrim($result);

        return $result;
    }
}