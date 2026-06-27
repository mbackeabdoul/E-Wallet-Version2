<?php
// creation de wallet
function creerWallet(array $newWallet) : string {
    $erreur = validerTelephone($newWallet['telephone']);
    if($erreur == "") $erreur = validerCode($newWallet['code']);
    if($erreur == ""){
     enregistrerWallet($newWallet);
    }
    return $erreur;
}