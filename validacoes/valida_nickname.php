<?php
include_once 'conexoes/Cliente.php';
$cliente = new Cliente();

$nickname = $_POST['nickname'] ?? '';
if ($cliente->existeNickname($nickname)) {
    echo 'Este nickname já está em uso.';
}
?>
