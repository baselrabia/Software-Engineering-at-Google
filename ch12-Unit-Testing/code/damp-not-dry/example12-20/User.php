<?php

declare(strict_types=1);

require_once __DIR__ . "/State.php";

final class User {

    private State $state;

    public function setState(State $state): User {
        $this->state = $state;
        return $this;
    }

    public function getState(): State {
        return $this->state;
    }

}