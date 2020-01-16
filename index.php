<?php

require_once 'LifeInsurance.php';
require_once 'Withdrawal.php';

$lifeInsurance = new LifeInsurance(41000.25, new DateTime('2008-12-01'), 20000);


$withdrawal = new Withdrawal(0, $lifeInsurance);

var_dump($withdrawal->totalAmount());
var_dump($withdrawal->getGain());
var_dump($withdrawal->getDuration());
var_dump($withdrawal->getIsFlatTax());


// MONTANT DE LA PLUS VALUE
// DUREE DE LA POSSESSION
// CHOIX DE LA FISCALITE
// MONTANT DE LA FISCALITE
