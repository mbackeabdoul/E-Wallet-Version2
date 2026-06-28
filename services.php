<?php
// creation de wallet
function creerWallet(array $newWallet) : string {
   $erreur = Validator\validerTelephone($newWallet['telephone']);
    if($erreur == "") $erreur = Validator\validerCode($newWallet['code']);
    if($erreur == "") $erreur=verifierUnicite($newWallet['telephone'],$newWallet['code']);
    if($erreur == ""){
     Repository\enregistrerWallet($newWallet);
    }
    return $erreur;
}

// faire une depot
function faireDepot(string $telephone, int $montant) : string {
    $erreur =Validator\telephoneExiste($telephone);
    if($erreur == "") 
    $erreur = Validator\montantValide($montant);
    if($erreur == ""){
        Repository\ajouterSolde($telephone, $montant);
        $newTransaction = [
            'montant' => $montant,
            'indexClient' => $telephone,
            'type' => 'depot'

        ];
        Repository\enregistrerTransaction($newTransaction);
    }
    return $erreur;
}
// faire retrait
function faireRetrait(string $telephone,$montant) : string {
    $erreur = Validator\telephoneExiste($telephone);
    if($erreur== "") $erreur = Validator\montantValide($montant);
    if($erreur == ""){
        $frais= calculeFrais($montant);
        $totalRetrait = $montant + $frais;
        $erreur = Validator\verifieSolde($telephone, $totalRetrait);
 }
    if($erreur == ""){
        Repository\soustrairSolde($telephone, $totalRetrait);
        $newTransaction = [
            'montant' => $montant,
            'indexClient' => $telephone,
            'type' => 'retrait', 
            'frais' => $frais
        ];
        Repository\enregistrerTransaction($newTransaction);
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
