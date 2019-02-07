<?php

namespace Molinem\MoliBot;

/**
 *
 */
interface Comparator
{
    /**
     * Method for compare two elements.
     *
     * @param string $a
     * @param string $b
     * @return int -1 if $a is lower than $b, 0 if equal and 1 if $a is greater
     * than $b
     */
    public function compare($a, $b);
}
