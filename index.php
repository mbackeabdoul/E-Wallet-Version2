<?php

// tableaux
$wallets = [];
$transactions = [];

include "validator.php";
include "repository.php";
include "services.php";
include "controller.php";

// boucle de menu
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
          $telephone = saisiTelephone();
    $montant = bindMontant();
    $erreur = faireDepot($telephone, $montant);
    if($erreur == ""){
        afficherMessage("vous avez fait un depot !");
    } else {
        afficherMessage($erreur);
    }
    
    } else if($choix == "3"){
           $telephone = saisiTelephone();
        $montant = bindMontant();
        $erreur = faireRetrait($telephone, (int)$montant);
        if($erreur == ""){
            afficherMessage("vous avez fait un retrait");
        } else {
            afficherMessage($erreur);
        }
    
    } else if($choix == "4"){
      afficherTransactions();
        } else if($choix == "0"){
        afficherMessage("Mercii !");
    } else {
        afficherMessage("Choix invalide veuillez reessayer");
    }
} while($choix != "0");