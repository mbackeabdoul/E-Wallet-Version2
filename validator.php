<?php

// validation du telephone
namespace Validator;
function validerTelephone(string $telephone) : string {
    $erreur = "";
    if(strlen($telephone) != 9){
        $erreur = "numero telephone doit etre 9 chiffres";
    } else if($telephone[0] != "7"){
        $erreur = "numero telephone invalide";
    } else
     if($telephone[1] != "0" && $telephone[1] != "5" &&
        $telephone[1] != "6" && $telephone[1] != "7" &&
        $telephone[1] != "8"){
        $erreur = "numero telephone invalide";
    }
    return $erreur;
}
function validerCode(string $code) : string{
    $erreur = "";
    if(strlen($code) != 4){
        $erreur = "code doit etre 4 caractere";
    }
    return $erreur;
}

function telephoneExiste(string $telephone) : string{
    global $wallets;
    $numeroTrouve = array_filter($wallets,function($wallet)use($telephone) {
        return $wallet['telephone'] == $telephone;
    });
    if(empty($numeroTrouve)){
        return "numero telephone nexiste pas";
    }
    return "";
}

function montantValide (string $montant) : string{
    $erreurs = "";
    if($montant <=0){
        $erreurs = "montant dois etre positif";
    }
    return $erreurs; 
} 

function verifieSolde(string $telephone, int $montant) : string {
    global $wallets;
    $soldeTrouve = array_filter($wallets, 
    function($wallet) 
    use ($telephone, $montant){
       return 
       $wallet['telephone'] == $telephone && 
       $wallet['solde'] < $montant;
    });
    if(!empty($soldeTrouve)){
       return "Solde n'est pas suffsant";
    }
    return "";
}

function verifierUnicite(string $telephone, string $code) : string {
    global $wallets;
    $numeroTrouve = array_filter($wallets, function($wallet) use ($telephone) {
        return $wallet['telephone'] == $telephone;
    });
    if(!empty($numeroTrouve)){
        return "telephone deja exister";
    }
    $codeTrouve = array_filter($wallets, function($wallet) use ($code) {
        return $wallet['code'] == $code;
    });
    if(!empty($codeTrouve)){
        return "code deja exister";
    }
    return "";
}