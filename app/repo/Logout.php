<?php
if (isset($_COOKIE['token'])) {
    unset($_COOKIE['token']);
    setcookie('token', '', -1, '/');
    Header('Location: /');
} else {
    Header('Location: /');
}