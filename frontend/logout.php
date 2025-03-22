<?php
// filepath: c:\wamp64\www\lor_repo\backend\logout.php

session_start();
session_unset();
session_destroy();

header('Location: ../frontend/Login.php');
exit;