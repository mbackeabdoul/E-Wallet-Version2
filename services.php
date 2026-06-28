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
            'indexClient' => $telephone,
            'type' => 'depot'

        ];
        enregistrerTransaction($newTransaction);
    }
    return $erreur;
}
// faire retrait
function faireRetrait(string $telephone,$montant) : string {
    $erreur = telephoneExiste($telephone);
    if($erreur== "") $erreur = montantValide($montant);
    if($erreur == ""){
        $frais= calculeFrais($montant);
        $totalRetrait = $montant + $frais;
        $erreur = verifieSolde($telephone, $totalRetrait);
 }
    if($erreur == ""){
        soustrairSolde($telephone, $totalRetrait);
        $newTransaction = [
            'montant' => $montant,
            'indexClient' => $telephone,
            'type' => 'retrait', 
            'frais' => $frais
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

function calculeFrais(int $montant):int{
    if($montant <= 10000){
        $frais = 200;
    } else if($montant <= 100000){
        $frais = 500;
    } else {
        $frais = $montant / 100;
        if($frais > 5000){
            $frais = 5000;
        }
    }
    return $frais;
}
