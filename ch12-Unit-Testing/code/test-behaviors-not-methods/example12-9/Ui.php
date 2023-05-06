<?php

declare(strict_types=1);

final class Ui {

    private string $text;
    private static $instance = null;

    public function __construct() {
        $this->text = "";
    }

    public function showMessage(string $message): void {
        $this->text .= "\n" . $message;
    }

    public function getText(): string {
        return $this->text;
    }


    public static function getInstance() : Ui {
        if (self::$instance == null) {
            self::$instance = new Ui();
        }

        return self::$instance;
    }

}