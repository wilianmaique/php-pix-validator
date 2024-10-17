<?php

namespace WilianMaique\PixValidator;

class Random
{
  public function validate(string $random): bool
  {
    $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/';
    $random = strtolower(trim($random));

    return preg_match($pattern, $random) === 1;
  }
}
