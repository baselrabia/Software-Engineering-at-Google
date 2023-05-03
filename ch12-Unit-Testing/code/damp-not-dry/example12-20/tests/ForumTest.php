<?php

declare(strict_types=1);

require_once __DIR__ . "/../User.php";
require_once __DIR__ . "/../Forum.php";
require_once __DIR__ . "/../State.php";

use PHPUnit\Framework\TestCase;

final class ForumTest extends TestCase
{

    /** @test */
    public function shouldAllowMultipleUsers()
    {
        // Given two users and setting their state to NORMAL
        $user1 = (new User())->setState(State::NORMAL);
        $user2 = (new User())->setState(State::NORMAL);

        // And a forum object
        $forum = new Forum();

        // When register the user to forum
        $forum->register($user1);
        $forum->register($user2);

        // Then the user1 should be registered to the forum
        $this->assertTrue(
            $forum->hasRegisteredUser($user1),
            "Expected user1 to be registered to forum, but it is not"
        );

        // Then the user2 should be registered to the forum
        $this->assertTrue(
            $forum->hasRegisteredUser($user2),
            "Expected user2 to be registered to forum, but it is not"
        );
    }

    /** @test */
    public function shouldNotRegisterBannedUsers()
    {
        // Given the user and setting its state to BANNED
        $user = (new User())->setState(State::BANNED);

        // And a forum object
        $forum = new Forum();

        // When user register to the forum
        try {
            $forum->register($user);
        } catch (\Exception $ignored) {
        }

        // Then the user should not be registered to forum
        $this->assertFalse(
            $forum->hasRegisteredUser($user),
            "Expected banned user to not be register"
        );
    }
}