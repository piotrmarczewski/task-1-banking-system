<?php
declare(strict_types=1);

namespace App;

final class PersonalAccount extends Account
{
    public function withdraw(float $amount): void
    {
        if ($amount > $this->balance) {
            throw new InsufficientFundsException(
                'Niewystarczające środki.'
            );
        }

        $this->balance -= $amount;
    }
}
