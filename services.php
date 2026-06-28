<?php
// creation de wallet
function creerWallet(array $newWallet) : string {
    $erreur = validerTelephone($newWallet['telephone']);
    if($erreur == "") $erreur = validerCode($newWallet['code']);
    if($erreur == "") $erreur=verifierUnicite($newWallet['telephone'],$newWallet['code']);
    if($erreur == ""){
     enregistrerWallet($newWallet);
    }
    return $erreur;
}

// faire une depot
function faireDepot(string $telephone, int $montant) : string {
    $erreur = telephoneExiste($telephone);
    if($erreur == "") 
    $erreur = montantValide($montant);
    if($erreur == ""){
        ajouterSolde($telephone, $montant);
        $newTransaction = [
            'montant' => $montant,
            'indexClient' => $telephone
        ];
        enregistrerTransaction($newTransaction);
    }
    return $erreur;
}
// faire retrait
function faireRetrait(string $telephone, int $montant) : string {
    $erreur = telephoneExiste($telephone);
     if($erreur == "") 
    $erreur = montantValide($montant);
    if($erreur == "") $erreur = verifieSolde($telephone, $montant);
    if($erreur == ""){
        soustrairSolde($telephone, $montant);
        $newTransaction = [
           'montant' => $montant,
           'indexClient' => $telephone
     ];
     enregistrerTransaction($newTransaction);
    }   
    return $erreur;
}

function verifierUnicite(string $telephone, string $code) : string {
    global $wallets;
     $erreur = "";
    foreach($wallets as $wallet){
        if($wallet['telephone'] == $telephone){
            $erreur = "numero telephone existe";
        } else if($wallet['code'] == $code){
            $erreur = "code existe";
        }
    }
    return $erreur;
}