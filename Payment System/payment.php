<?php
  abstract class Payment {
    protected float $amount;

    public function __construct(float $amount) {
        $this->amount = $amount;
    }

    // Abstract method forces child classes to implement
    abstract public function pay(): string;
}
  interface Refundable {
    public function refund(): string;
}

//PayPal Payment
class PayPal extends Payment implements Refundable {
    public function pay(): string {
        return "Paid {$this->amount} using PayPal.";
    }

    public function refund(): string {
        return "Refunded {$this->amount} via PayPal.";
    }
}

//Credit Card Payment
class CreditCard extends Payment implements Refundable {
    public function pay(): string {
        return "Paid {$this->amount} using Credit Card.";
    }

    public function refund(): string {
        return "Refunded {$this->amount} via Credit Card.";
    }
}

//Crypto Payment
class Crypto extends Payment {
    public function pay(): string {
        return "Paid {$this->amount} using Cryptocurrency.";
    }
}

function processPayment(Payment $payment) {
    echo $payment->pay() . PHP_EOL;

    if ($payment instanceof Refundable) {
        echo $payment->refund() . PHP_EOL;
    } else {
        echo "This payment method is non-refundable." . PHP_EOL;
    }
}


//test
$paypal = new PayPal(100);
$credit = new CreditCard(200);
$crypto = new Crypto(300);

processPayment($paypal);
/* Output:
Paid 100 using PayPal.
Refunded 100 via PayPal.
*/

processPayment($credit);
/* Output:
Paid 200 using Credit Card.
Refunded 200 via Credit Card.
*/

processPayment($crypto);
/* Output:
Paid 300 using Cryptocurrency.
This payment method is non-refundable.
*/

?>