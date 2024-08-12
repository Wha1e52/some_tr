<?php

namespace classes;
class Car
{
    public $color;
    public $brand;
    public $wheels;
    public $speed;
    public static $counter;

    public function __construct($color, $brand, $wheels = 4, $speed = 10)
    {
        $this->color = $color;
        $this->wheels = $wheels;
        $this->speed = $speed;
        $this->brand = $brand;
        self::$counter++;

    }

    public function my_func()
    {
        return $this->color . $this->speed;
    }

}


$car = new Car('red', 'bmw');
echo Car::$counter;