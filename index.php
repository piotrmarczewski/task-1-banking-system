<?php
declare(strict_types=1);

namespace App;
use App\PersonalAccount;
use App\BusinessAccount;

require_once __DIR__ . '/vendor/autoload.php';

$account1 = new PersonalAccount(
    '50525142854892382989011056',
    'Jan Nowak'
);

$account2 = new BusinessAccount(
    '60859875910552853192355214',
    'Firma X'
);

try {
    echo "[Konto ".$account1->getAccountNumber()."] Wpłata 200 zł"."<br>".PHP_EOL;
    $account1->deposit(200);
    echo "[Konto ".$account1->getAccountNumber()."] Saldo: {$account1->getBalance()}"."<br>".PHP_EOL;

    echo "[Konto ".$account1->getAccountNumber()."] Wypłata 50 zł"."<br>".PHP_EOL;
    try {
        $account1->withdraw(50);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$account1->getAccountNumber()."] Saldo: {$account1->getBalance()}"."<br>".PHP_EOL;

    echo "[Konto ".$account1->getAccountNumber()."] Wypłata 300 zł"."<br>".PHP_EOL;
    try {
        $account1->withdraw(300);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$account1->getAccountNumber()."] Saldo: {$account1->getBalance()}"."<br>".PHP_EOL;
    
    echo "[Przelew] ".$account1->getAccountNumber()." -> ".$account2->getAccountNumber().": 400 zł"."<br>".PHP_EOL;
    try {
        $account1->transferTo($account2, 400);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$account1->getAccountNumber()."] Saldo: {$account1->getBalance()}"."<br>".PHP_EOL;
    echo "[Konto ".$account2->getAccountNumber()."] Saldo: {$account2->getBalance()}"."<br>".PHP_EOL;

    echo "[Konto ".$account2->getAccountNumber()."] Wypłata 1000 zł"."<br>".PHP_EOL;
    try {
        $account2->withdraw(1000);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$account2->getAccountNumber()."] Saldo: {$account2->getBalance()}"."<br>".PHP_EOL;

    echo "[Konto ".$account2->getAccountNumber()."] Wypłata 12000 zł"."<br>".PHP_EOL;
    try {
        $account2->withdraw(12000);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$account2->getAccountNumber()."] Saldo: {$account2->getBalance()}"."<br>".PHP_EOL;
} catch (InsufficientFundsException $e) {
    echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
}

echo "<br>".PHP_EOL."--- Stan końcowy ---"."<br>".PHP_EOL;
echo "Konto ".$account1->getAccountNumber()." ({$account1->getBalance()})"."<br>".PHP_EOL;
echo "Konto ".$account2->getAccountNumber()." ({$account2->getBalance()})"."<br>".PHP_EOL;