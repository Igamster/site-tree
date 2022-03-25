<?php

function userAvthorizatoin(): bool
{
    if (isset($_SESSION['Autorized']) && $_SESSION['Autorized']['authorization']) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
