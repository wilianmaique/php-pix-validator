<?php

namespace WilianMaique\PixValidator;

class Cnpj
{
  private function calculateDigit(string $cnpj, $isFirstDigit = true)
  {
    if ($isFirstDigit) {
      $factories = [6, 7, 8, 9, 2, 3, 4, 5, 6, 7, 8, 9];
    } else {
      $factories = [5, 6, 7, 8, 9, 2, 3, 4, 5, 6, 7, 8, 9];
    }

    $resultSum = 0;

    foreach ($factories as $index => $factory)
      $resultSum += $factory * (int)$cnpj[$index];

    $rest = $resultSum % 11;
    return $rest >= 10 ? 0 : $rest;
  }

  public function validate(string $cnpj): bool
  {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    if (strlen($cnpj) != 14 || !ctype_digit($cnpj))
      return false;

    if (!ctype_digit($cnpj) || count(array_unique(str_split($cnpj))) == 1)
      return false;

    $firstVerificationDigit = $this->calculateDigit($cnpj);
    $lastVerificationDigit = $this->calculateDigit($cnpj, false);

    return substr($cnpj, -2) === "{$firstVerificationDigit}{$lastVerificationDigit}";
  }

  public function mask(string $cnpj): string|bool
  {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    if (!$this->validate($cnpj))
      return false;

    return sprintf('%s.%s.%s/%s-%s', substr($cnpj, 0, 2), substr($cnpj, 2, 3), substr($cnpj, 5, 3), substr($cnpj, 8, 4), substr($cnpj, 12, 2));
  }
}
