<?php


declare(strict_types=1);

require_once __DIR__ . '/Account.php';

final class Transaction
{

    private int $id;
    private Account $sender;
    private Account $recipient;
    private float|int $amount;

    public function __construct() {
        $this->id = -1;
        $this->sender = new Account("", 0);
        $this->recipient = new Account("", 0);
        $this->amount = 0;
    }

    public function setId(int $id): Transaction
    {
        $this->id = $id;
        return $this;
    }

    public function setSender(Account $sender): Transaction
    {
        $this->sender = $sender;
        return $this;
    }

    public function setRecipient(Account $recipient): Transaction
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function setAmount(float|int $amount): Transaction
    {
        $this->amount = $amount;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSender(): Account {
        return $this->sender;
    }

    public function getRecipient(): Account {
        return $this->recipient;
    }

    public function getAmount(): int|float {
        return $this->amount;
    }

}