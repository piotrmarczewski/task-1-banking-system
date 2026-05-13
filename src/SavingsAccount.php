<?php
declare(strict_types=1);

namespace App;

final class SavingsAccount extends Account
{
    public function __construct(
        string $accountNumber,
        string $ownerName,
        private float $interestRate = 5
    ) {
        parent::__construct(
            $accountNumber,
            $ownerName
        );
    }

    public function withdraw(float $amount): void
    {
        if ($amount > $this->balance) {
            throw new InsufficientFundsException(
                'Niewystarczające środki.'
            );
        }

        $this->balance -= $amount;
    }

    public function applyInterest(): void
    {
        $interest = $this->balance * ($this->interestRate / 100);

        $this->balance += $interest;
    }
}