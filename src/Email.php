<?php

namespace WilianMaique\PixValidator;

class Email
{
  public function validate(string $email): bool
  {
    $pattern = '/^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';
    $email = trim(strtolower($email));

    return preg_match($pattern, $email) === 1;
  }
}
