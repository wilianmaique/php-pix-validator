<?php

namespace WilianMaique\PixValidator;

class Phone
{
  public function validate(string $phone): bool
  {
    $pattern = '/^([1-9]{2})(9[1-9])([0-9]{3})([0-9]{4})$/';
    $number = preg_replace('/[\s\(\)\-]/', '', trim($phone));

    return preg_match($pattern, $number) === 1;
  }

  public function mask(string $phone): string|bool
  {
    $pattern = '/^([1-9]{2})(9[1-9])([0-9]{3})([0-9]{4})$/';
    $number = preg_replace('/[\s\(\)\-]/', '', trim($phone));

    if (!preg_match($pattern, $number))
      return false;

    return sprintf('(%s) %s-%s', substr($number, 0, 2), substr($number, 2, 5), substr($number, 7));
  }
}
