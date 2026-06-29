<?php
namespace Repository;
// enregistre wallet
function enregistrerWallet(array $newWallet) : void {
    global $wallets;
    array_push($wallets, $newWallet); 
}

function enregistrerTransaction (array $newTransaction) : void{
    global $transactions;
    array_push($transactions, $newTransaction);
} 

function ajouterSolde(string $telephone, int $montant) : void {
    global $wallets;
      foreach($wallets as $index => $wallet){
        if($wallet['telephone'] == $telephone){
            $soldeAncienne=$wallets[$index]['solde'];
            $soldeNouvelle=$soldeAncienne + $montant;
            $wallets[$index]['solde']=$soldeNouvelle;
        }
    }
}

function soustrairSolde(string $telephone, int $montant) : void {
    global $wallets;
    foreach($wallets as $index => $wallet){
     if($wallet['telephone'] == $telephone){
        $soldeAncienne = $wallets[$index]['solde'];
         $soldeNouvelle = $soldeAncienne - $montant;
         $wallets[$index]['solde'] = $soldeNouvelle;
        }
    }
}
