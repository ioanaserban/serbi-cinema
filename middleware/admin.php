<?php

if (!User::isAdmin()) {
    header('Location: /');
}