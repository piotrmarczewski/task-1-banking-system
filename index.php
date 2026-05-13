<?php
declare(strict_types=1);

namespace App;
use App\PersonalAccount;
use App\BusinessAccount;

require_once __DIR__ . '/vendor/autoload.php';

$personalAccount = new PersonalAccount(
    '50525142854892382989011056',
    'Jan Nowak'
);

$businessAccount = new BusinessAccount(
    '60859875910552853192355214',
    'Firma X'
);

$savingsAccount = new SavingsAccount(
    '24866721375761599084379838',
    'Anna Nowak',
    2.5
);

try {
    echo "[Konto ".$personalAccount->getAccountNumber()."] Wpłata 200 zł"."<br>".PHP_EOL;
    $personalAccount->deposit(200);
    echo "[Konto ".$personalAccount->getAccountNumber()."] Saldo: {$personalAccount->getBalance()}"."<br>".PHP_EOL;

    echo "[Konto ".$personalAccount->getAccountNumber()."] Wypłata 50 zł"."<br>".PHP_EOL;
    try {
        $personalAccount->withdraw(50);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$personalAccount->getAccountNumber()."] Saldo: {$personalAccount->getBalance()}"."<br>".PHP_EOL;

    echo "[Konto ".$personalAccount->getAccountNumber()."] Wypłata 300 zł"."<br>".PHP_EOL;
    try {
        $personalAccount->withdraw(300);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$personalAccount->getAccountNumber()."] Saldo: {$personalAccount->getBalance()}"."<br>".PHP_EOL;
    
    echo "[Przelew] ".$personalAccount->getAccountNumber()." -> ".$businessAccount->getAccountNumber().": 400 zł"."<br>".PHP_EOL;
    try {
        $personalAccount->transferTo($businessAccount, 400);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$personalAccount->getAccountNumber()."] Saldo: {$personalAccount->getBalance()}"."<br>".PHP_EOL;
    echo "[Konto ".$businessAccount->getAccountNumber()."] Saldo: {$businessAccount->getBalance()}"."<br>".PHP_EOL;

    echo "[Konto ".$businessAccount->getAccountNumber()."] Wypłata 1000 zł"."<br>".PHP_EOL;
    try {
        $businessAccount->withdraw(1000);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$businessAccount->getAccountNumber()."] Saldo: {$businessAccount->getBalance()}"."<br>".PHP_EOL;

    echo "[Konto ".$businessAccount->getAccountNumber()."] Wypłata 12000 zł"."<br>".PHP_EOL;
    try {
        $businessAccount->withdraw(12000);
    } catch (InsufficientFundsException $e) {
        echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
    }
    echo "[Konto ".$businessAccount->getAccountNumber()."] Saldo: {$businessAccount->getBalance()}"."<br>".PHP_EOL;
    
    echo "[Konto ".$savingsAccount->getAccountNumber()."] Wpłata 1000 zł"."<br>".PHP_EOL;
    $savingsAccount->deposit(1000);

    $savingsAccount->applyInterest();
    echo "[Konto ".$savingsAccount->getAccountNumber()."] Saldo: {$savingsAccount->getBalance()}"."<br>".PHP_EOL;
} catch (InsufficientFundsException $e) {
    echo "[BŁĄD] " . $e->getMessage() . ""."<br>".PHP_EOL;
}

echo "<br>".PHP_EOL."--- Stan końcowy ---"."<br>".PHP_EOL;
echo "Konto ".$personalAccount->getAccountNumber()." ({$personalAccount->getBalance()})"."<br>".PHP_EOL;
echo "Konto ".$businessAccount->getAccountNumber()." ({$businessAccount->getBalance()})"."<br>".PHP_EOL;
echo "Konto ".$savingsAccount->getAccountNumber()." ({$savingsAccount->getBalance()})"."<br>".PHP_EOL;