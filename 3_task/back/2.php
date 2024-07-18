<?php

abstract class Animal {
  protected string $name;

  protected function __construct(?string $name = null) {
    $this->name = $name;
  }

  abstract protected function makeSound(string $lang): string;

}

class Dog extends Animal {
  protected string $breed;

  //порода обязательный параметр, кличка - не обязательный
  public function __construct(string $breed , string $name = null) {
    parent::__construct($name);
    $this->breed = $breed;
  }

  public function getName(): string | null{
    return $this->name;
  }

  public function getBreed(): string{
    return $this->breed;
  }

  public function makeSound($lang): string {
    return $lang === 'ru'
    ? 'Гав' : 'Woof';
  }

  public function getStrDog(): string {
    return $this->containsEnglish($this->getBreed()) 
    ? 'по ТЗ порода не должна содержать английские символы !'
    : $this->getBreed().' '.$this->getName().' говорит '.$this->makeSound('ru');
  }

  public function containsEnglish($string) {
    return preg_match('/[a-zA-Z]/', $string);
  }

  public function containsRussian($string) {
    return preg_match('/[а-яА-ЯёЁ]/u', $string);
  }
  public function getStrDogEn(): string {
    return $this->containsRussian($this->getBreed()) 
    ? 'breed should not have a Russian symbol !' 
    : $this->getBreed().' '.$this->getName().' says '.$this->makeSound('en');
  }

}

class Cat extends Animal {

  public function __construct($name){
    parent::__construct($name);
  }

  public function getName(): string {
    return $this->name;
  }

  public function makeSound($lang): string {
    return $lang === 'ru' ? 'Мяу' : 'Meow';
  }

  public function getStrCat(): string {
    return 'Кошка '.$this->getName().' говорит '.$this->makeSound('ru');
  }

  public function getStrCatEn(): string {
    return 'Cat '.$this->getName().' says '.$this->makeSound('en');
  }

}
?>