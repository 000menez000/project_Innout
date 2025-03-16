<?php

class ValidationException extends AppException {

    private $errors = [];
    
    public function __construct(
        array $errors = [],
        string $message = 'Erros de Validação', 
        int $code = 0, 
        $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function __get($att) {
        return $this->errors[$att];
    }
}