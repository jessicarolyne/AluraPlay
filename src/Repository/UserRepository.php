<?php

declare(strict_types=1);

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\User;
use PDO;

class UserRepository
{
  public function __construct(private PDO $pdo) {}

  public function add(User $user): bool
  {
    $hash = password_hash($user->password, PASSWORD_ARGON2ID);
    $sql = 'INSERT INTO users (email, password) VALUES (?, ?);';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $user->email);
    $statement->bindValue(2, $hash);
    $result = $statement->execute();
    $id = $this->pdo->lastInsertId();

    $user->setId(intval($id));
    return $result;
  }

  public function find(string $email, string $password)
  {
    $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = ?;');
    $statement->bindValue(1, $email, \PDO::PARAM_INT);
    $statement->execute();

    $UserData =  $this->hydrateUser($statement->fetch(\PDO::FETCH_ASSOC));
    $correctPassword = password_verify($password, $UserData['password'] ?? '');
    return $correctPassword;
  }

  private function hydrateUser(array $UserData): User
  {
    $user = new User($UserData['email'], $UserData['password']);
    $user->setId($UserData['id']);

    return $user;
  }
}
