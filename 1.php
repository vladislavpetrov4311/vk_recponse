<?php
/**
* Вычисляет Факториал числа
*/
function calculateFactorial(int $number): int {
  if ($number == 0) {
    return 1;
  } else {
    return $number * calculateFactorial($number - 1);
  }
}

/**
* Проверяет, является ли число простым
 */
function isPrime(int $num): bool {
  if ($num <= 1) {
    return false;
  }
  for ($i = 2; $i <= sqrt($num); $i++) {
    if ($num % $i == 0) {
      return false;
    }
  }
  return true;
}

/**
 * Выводит строку
 */
function printr_res($str) {
    echo "$str";
}

echo "Введите число: ";
$number = (int)readline();

echo "Факториал $number is: ".calculateFactorial($number)."\n";

isPrime($number) ? printr_res("$number - это простое число\n") : printr_res("$number - это не простое число.\n");
?>