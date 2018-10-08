<?php
/**
 * Created by PhpStorm.
 * User: jarek
 * Date: 05.10.2018
 * Time: 17:30
 */
declare(strict_types=1);

/**
 * @param $toPrint
 */
function print_pre($toPrint) {
    echo '<pre>' . print_r($toPrint) . '</pre>';
}

/**
 * Class Account
 */
class Account
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $phoneNumber;
    /**
     * @var int
     */
    private $balance;


    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }


    /**
     * Account constructor.
     */
    public function __construct()
    {
        $this->balance = 0;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $amount
     * @throws Exception
     */
    public function makeDeposit(int $amount)
    {
        if ($amount <= 0) {
            throw new \Exception('Incorrect amount');
        } else {
            $this->balance += $amount;
        }
    }

    /**
     * @param int $amount
     * @throws Exception
     */
    public function payment(int $amount)
    {
        if ($amount > $this->balance) {
            throw new \Exception('Incorrect amount');
        } else {
            $this->balance -= $amount;
        }
    }

}

$customer1 = new Account();
$customer1->setName('Jarek');
$customer1->setAddress('Królewska 0' );
$customer1->setPhoneNumber('000 000 000');

$customer2 = new Account();
$customer2->setName('Leon');
$customer2->setAddress('Królewska 1');
$customer2->setPhoneNumber('111 111 111');

print_pre($customer1);
print_pre($customer2);

$customer1->makeDeposit(100);

print_pre($customer1);
print_pre($customer2);

$customer1->payment(60);

print_pre($customer1);
print_pre($customer2);
