<?php

declare(strict_types=1);

require_once __DIR__ . "/State.php";
require_once __DIR__ . "/BannedUserException.php";
final class Forum {

    private array $registeredUsers = [];

    public function register(User $user): void {
        if ($user->getState() === State::BANNED) {
            throw new BannedUserException("Error: Banned User (not allowed to register)");
        }
        $this->registeredUsers[] = $user;
    }


    public function hasRegisteredUser(User $user): bool {
        return in_array($user, $this->registeredUsers, true);
    }

}