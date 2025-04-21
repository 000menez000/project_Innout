<?php

function addSuccessMsg($msg) {
    $_SESSION['message'] = [
        'type' => 'success',
        'message' => $msg,
    ];

    echo 'deu certo';
}

function addErrorMsg($msg) {
    $_SESSION['message'] = [
        'type' => 'error',
        'message' => $msg,
    ];

    echo 'deu certo!';
}