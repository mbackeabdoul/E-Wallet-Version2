<?php

// tableaux
$wallets = [];
$transactions = [];

include "validator.php";
include "repository.php";
include "services.php";
include "controller.php";

// boucle menu
do {
    afficherMenu();
    $choix = readline("Votre choix: ");

    if($choix == "1"){
        $newWallet = saisirWallet();
        $erreur = creerWallet($newWallet);
        if($erreur == ""){
            afficherMessage("Wallet a ete cree ");
        } else {
            afficherMessage($erreur);
        }
    } else if($choix == "2"){
        afficherMessage("noppeegul");
    } else if($choix == "3"){
        afficherMessage("noppeegul");
    } else if($choix == "4"){
        afficherMessage("noppeeegul");
    } else if($choix == "0"){
        afficherMessage("Mercii !");
    } else {
        afficherMessage("Choix invalide veuillez reessayer");
    }

} while($choix != "0");