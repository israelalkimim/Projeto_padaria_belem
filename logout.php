<?php
session_start();
session_destroy(); // Destrói a sessão
header("Location: index.php"); // Redireciona para o login
exit;
