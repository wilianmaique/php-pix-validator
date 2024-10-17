<?php

require __DIR__ . '/../vendor/autoload.php';

use WilianMaique\PixValidator\Cnpj;
use WilianMaique\PixValidator\Cpf;
use WilianMaique\PixValidator\Email;
use WilianMaique\PixValidator\Phone;
use WilianMaique\PixValidator\Random;
use WilianMaique\PixValidator\Type;

$cnpjValidator = new Cnpj();
$cnpj = "12345678000195";

if ($cnpjValidator->validate($cnpj)) {
  echo "CNPJ válido: " . $cnpjValidator->mask($cnpj);
} else {
  echo "CNPJ inválido.";
}

echo "<br>";

$cpfValidator = new Cpf();
$cpf = "503.287.690-96";

if ($cpfValidator->validate($cpf)) {
  echo "CPF válido: " . $cpfValidator->mask($cpf);
} else {
  echo "CPF inválido.";
}

echo "<br>";

$emailValidator = new Email();
$email = "blabla@dominio.com";

if ($emailValidator->validate($email)) {
  echo "Email válido. " . $email;
} else {
  echo "Email inválido.";
}

echo "<br>";

$phoneValidator = new Phone();
$phone = "15 99637 5720";

if ($phoneValidator->validate($phone)) {
  echo "Número válido: " . $phoneValidator->mask($phone);
} else {
  echo "Número inválido.";
}

echo "<br>";

$randomValidator = new Random();
$randomKey = "feb43f3f-7889-4f35-8a44-af7c83f3eb76";

if ($randomValidator->validate($randomKey)) {
  echo "Chave PIX válida. " . $randomKey;
} else {
  echo "Chave PIX inválida.";
}

echo "<br><br><br>";

$value = "blabla@gmail.com"; // CPF, telefone, email, CNPJ ou chave PIX
$result = (new Type())->validate($value);

if ($result !== false) {
  $type = $result['type'];
  $mask = $result['masked'];

  echo "Tipo: $type\n";

  if (isset($result['masked'])) {
    echo "Valor valido: $mask\n";
  } else {
    echo "Valor: $mask\n";
  }
} else {
  echo "Valor inválido.\n";
}
