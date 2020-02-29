<?php
class A
{
    static $test = 12;

    public function getTest()
    {
        return self::$test; //12
        //return static::$test; //13
    }
}

class B extends A
{
    static $test = 13;
}

$b = new B();

echo $b->getTest();