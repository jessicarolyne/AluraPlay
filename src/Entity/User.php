<?php

declare(strict_types=1);

namespace Alura\Mvc\Entity;

use InvalidArgumentException;

class User
{
  public readonly int $id;
  public readonly string $email;
  public readonly string $password;

  public function __construct(
    string $email,
    string $password,
  ) {}

  private function setEmail(string $email)
  {
    if (filter_input(INPUT_POST, $email, FILTER_VALIDATE_EMAIL) === false) {
      throw new InvalidArgumentException();
    }
    $this->email = $email;
  }

  private function setPassword(string $password)
  {
    if (filter_input(INPUT_POST, $password) === false) {
      throw new InvalidArgumentException();
    }
    $this->password = $password;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }
}
