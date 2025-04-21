<?php
$errors = [];

if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
} elseif($exception) {
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage(),
    ];

    if(get_class($exception) === 'ValidationException') {
        $errors = $exception->getErrssssssors();
    }
}

$alertType = '';

if ($message) {
    switch($message['type']) {
        case 'error':
            $alertType = 'danger';
            break;
        case 'success':
            $alertType = 'success';
            break;
        case 'warning':
            $alertType = 'warning';
            break;
        default:
            $alertType = 'info';
    }
}
?>

<?php if($message) : ?>
    <div class="alert alert-<?= $alertType ?> my-3" role="alert">
        <?= $message['message'] ?>
    </div>
<?php endif ?>