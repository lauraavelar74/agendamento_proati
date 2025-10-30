<?php
session_start();
session_destroy(); // Finaliza a sessão
header("Location: google-login.php");
exit;
