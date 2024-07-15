<?php

abstract class Animal {
  protected ?string $name;

  protected function __construct(?string $name = null) {
    $this->name = $name;
  }

  abstract protected function makeSound(): string;

}

class Dog extends Animal {
  protected string $breed;

  //Порода обязательный параметр, кличка - не обязательный
  public function __construct(string $breed , ?string $name = null) {
    parent::__construct($name);
    $this->breed = $breed;
  }

  public function getName(): string | null{
    return $this->name;
  }

  public function getBreed(): string{
    return $this->breed;
  }

  public function makeSound(): string {
    return "Woof";
  }

}

class Cat extends Animal {

  public function __construct($name){
    parent::__construct($name);
  }

  public function getName(): string {
    return $this->name;
  }

  public function makeSound(): string {
    return "Meow";
  }

}

$rex = new Dog("Rex", "Labrador");
$stooped = new Dog("Stooped");
$murka = new Cat("Murka");

echo $rex->getName().' '.$rex->getBreed().' says '.$rex->makeSound()."\n";
echo 'Dog '.$stooped->getBreed().' says '.$stooped->makeSound()."\n";
echo "Cat ".$murka->getName().' says '.$murka->makeSound()."\n";

?>