<?php
include_once 'conexoes/Cliente.php';
$cliente = new Cliente();

$email = $_POST['email'] ?? '';
if ($cliente->existeEmail($email)) {
    echo 'Este e-mail já está cadastrado.';
}