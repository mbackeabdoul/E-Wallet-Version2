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
    Controller\afficherMenu();
    $choix = readline("Votre choix: ");

    if($choix == "1"){
        $newWallet = Controller\saisirWallet();
        $erreur = creerWallet($newWallet);
        if($erreur == ""){
            Controller\afficherMessage("Wallet a ete cree ");
        } else {
            Controller\afficherMessage($erreur);
        }
    } else if($choix == "2"){
          $telephone = Controller\saisiTelephone();
    $montant = Controller\bindMontant();
    $erreur = faireDepot($telephone, $montant);
    if($erreur == ""){
       Controller\afficherMessage("vous avez fait un depot !");
    } else {
        Controller\afficherMessage($erreur);
    }
    
    } else if($choix == "3"){
           $telephone = Controller\saisiTelephone();
        $montant = Controller\bindMontant();
        $erreur = faireRetrait($telephone, (int)$montant);
        if($erreur == ""){
            Controller\afficherMessage("vous avez fait un retrait");
        } else {
            Controller\afficherMessage($erreur);
        }
    
    } else if($choix == "4"){
     Controller\afficherTransactions($transactions);
        } else if($choix == "0"){
        Controller\afficherMessage("Mercii !");
    } else {
        Controller\afficherMessage("Choix invalide veuillez reessayer");
    }
} while($choix != "0");