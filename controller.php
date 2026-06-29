<?php
namespace Controller;
// on affiche le menu
function afficherMenu() : void {
    echo "\n Menu Distributeur \n";
    echo "1. Creer Wallet\n";
    echo "2.Faire Depot\n";
    echo "3. Faire Retrait\n";
    echo "4. Lister Transactions\n";
    echo "0. Quitter\n";
}
function afficherMessage(string $message) : void {
    echo $message."\n";
}
function saisirWallet() : array {
    $newWallet = ['nom' => '', 'telephone' => '', 'code' => '', 'solde' => 0];
    $newWallet['nom'] = readline("Veuillez saisir un nom : ");
    $newWallet['telephone'] = readline("Veuillez saisir un numero du telephone: ");
    $newWallet['code'] = readline("Veuillez saisir le code: ");
    $newWallet['solde'] = (int)readline("Veuillez saisir la solde:");
    return $newWallet;
}

function bindMontant () : string{
    return readline("Saisi un montant :");

}

function saisiTelephone () : string{
    return readline("Saisir un numero telephone: ");
}

function afficherTransactions(array $transactions) : void {
    foreach($transactions as $transaction){
        $message = $transaction['type']." | Montant : ".$transaction['montant'];
        if($transaction['type'] == 'retrait'){
          $message = $message." | Frais : ".$transaction['frais'];
        }
         $message = $message." | Telephone : ".$transaction['indexClient'];
        afficherMessage($message);
    }
}