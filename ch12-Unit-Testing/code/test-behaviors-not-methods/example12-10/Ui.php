<?php

declare(strict_types=1);

final class Ui {

    private string $text;

    public function __construct() {
        $this->text = "";
    }

    public function showMessage(string $message): void {
        $this->text .= "\n" . $message;
    }

    public function getText(): string {
        return $this->text;
    }

}