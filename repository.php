<?php

// enregistre wallet
function enregistrerWallet(array $newWallet) : void {
    global $wallets;
    $wallets[] = $newWallet;
}