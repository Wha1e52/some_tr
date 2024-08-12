<?php

namespace oop\classes;

class Animal {
    public $name;
    public $old;

    public function __construct($name, $old) {
        $this->name = $name;
        $this->old = $old;
    }

    public function doSmth() {
        echo 'мур-мур';
    }
}



class Cat extends Animal {
}

//$d = new Dog('dog1', 4, 'мудель');
//$c = new Cat('cat1', 2);
//
//$d->doSmth();
//$c->doSmth();

