<?php

namespace WilianMaique\PixValidator;

class Cpf
{
  public function validate(string $cpf): bool
  {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) !== 11 || !ctype_digit($cpf))
      return false;

    if (in_array($cpf, array_map(fn($n) => str_repeat((string)$n, 11), range(0, 9)), true))
      return false;

    $calc = range(1, 9);
    $d1 = array_sum(array_map(fn($a, $b) => (int)$a * $b, str_split(substr($cpf, 0, 9)), $calc)) % 11 % 10;
    $d2 = array_sum(array_map(fn($a, $b) => (int)$a * $b, str_split(strrev(substr($cpf, 0, 9))), $calc)) % 11 % 10;

    return $cpf[-2] == (string)$d1 && $cpf[-1] == (string)$d2;
  }

  public function mask(string $cpf): string|false
  {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (!$this->validate($cpf))
      return false;

    return sprintf('%s.%s.%s-%s', substr($cpf, 0, 3), substr($cpf, 3, 3), substr($cpf, 6, 3), substr($cpf, 9, 2));
  }
}
