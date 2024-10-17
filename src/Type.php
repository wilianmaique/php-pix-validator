<?php

namespace WilianMaique\PixValidator;

class Type
{
  public function validate(string $value)
  {
    $value = trim($value);

    $cpfValidator = new Cpf();
    if ($cpfValidator->validate($value))
      return ['type' => 'CPF', 'masked' => $cpfValidator->mask($value), 'value' => $value];

    $phoneValidator = new Phone();
    if ($phoneValidator->validate($value))
      return ['type' => 'Phone', 'masked' => $phoneValidator->mask($value), 'value' => $value];

    $randomValidator = new Random();
    if ($randomValidator->validate($value))
      return ['type' => 'Random', 'masked' => $value, 'value' => $value];

    $emailValidator = new Email();
    if ($emailValidator->validate($value))
      return ['type' => 'Email', 'masked' => $value, 'value' => $value];

    $cnpjValidator = new Cnpj();
    if ($cnpjValidator->validate($value))
      return ['type' => 'CNPJ', 'masked' => $cnpjValidator->mask($value), 'value' => $value];

    return false;
  }
}
