<?php

// validation du telephone
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
function validerCode(string $code) : string {
    $erreur = "";
    if(strlen($code) != 4){
        $erreur = "code doit etre 4 caractere";
    }
    return $erreur;
}

function telephoneExiste (string $telephone) : string{
        global $wallets;
        $erreur = "numero telephone nexiste pas";
        foreach($wallets as $wallet){
            if($wallet['telephone']==$telephone){
                $erreur = "";
            }
        }
        return $erreur;
}


function montantValide (string $montant) : string{
    $erreurs = "";
    if($montant <=0){
        $erreurs = "montant dois etre positif";
    }
    return $erreurs; 
} 