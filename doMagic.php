<?php

class doMagic
{
    private int $initNum;

    public function __construct($num)
    {
        //singleton
        $this->initNum = $num;
    }

    public function secondLevel(): static
    {
        //math
        return $this;
    }

    public function __invoke($lastNum): int
    {
        return $this->initNum + $lastNum;
    }

}
