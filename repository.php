<?php

// enregistre wallet
function enregistrerWallet(array $newWallet) : void {
    global $wallets;
    $wallets[] = $newWallet;
}

function enregistrerTransaction (array $newTransaction) : void{
    global $transactions;
    $transactions [] = $newTransaction;
} 

function ajouterSolde(string $telephone, int $montant) : void {
    global $wallets;
      foreach($wallets as $index => $wallet){
        if($wallet['telephone'] == $telephone){
            $soldeAncienne = $wallets[$index]['solde'];
            $soldeNouvelle = $soldeAncienne + $montant;
            $wallets[$index]['solde'] = $soldeNouvelle;
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
