<?php

use Alura\Mvc\Repository\VideoRepository;

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = $_GET['id'];
$repository = new VideoRepository($pdo);

if($repository->remove($id) === false) :
  header('location: /?sucess=0');
else:
  header('location: /?sucess=1');
endif;
