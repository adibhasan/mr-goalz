<?php
session_start();
session_unset($_SESSION['vaiuugroup']);
header("Location:admin.php?adminroute=login");

