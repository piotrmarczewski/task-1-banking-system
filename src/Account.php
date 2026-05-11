<?php
declare(strict_types=1);

namespace App;

abstract class Account
{
    protected float $balance = 0;
    
    public function __construct(
        protected string $accountNumber, 
        protected string $ownerName, 
    ) {

    }

    public function deposit(float $amount): void
    {
        $this->balance += $amount;
    }

    public function transferTo(Account $targetAccount, float $amount): void
    {
        $this->withdraw($amount);

        $targetAccount->deposit($amount);
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    abstract public function withdraw(float $amount): void;

}
