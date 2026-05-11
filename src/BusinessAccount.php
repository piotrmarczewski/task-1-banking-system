<?php
declare(strict_types=1);

namespace App;

final class BusinessAccount extends Account
{
    public function __construct(
        string $accountNumber,
        string $ownerName,
        private float $overdraftLimit = 2000
    ) {
        parent::__construct(
            $accountNumber,
            $ownerName
        );
    }

    public function withdraw(float $amount): void
    {
        if (($this->balance - $amount) < -$this->overdraftLimit) {
            throw new InsufficientFundsException(
                'Przekroczono limit debetu.'
            );
        }

        $this->balance -= $amount;
    }
}