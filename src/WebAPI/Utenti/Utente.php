<?php
/**
 * Created by PhpStorm.
 * User: 6989
 * Date: 17/05/2019
 * Time: 10:03
 */

class Utente
{//`Id`, `Nome`, `Cognome`, `Telefono`, `Mail`, `DataDiNascita`, `Documento`, `NumeroDocumento`, `CodiceFiscale`, `Indirizzo`, `Località`, `Provincia`, `CAP`, `LivelloUtente`
    public $Id;
    public $Nome;
    public $Cognome;
    public $CodiceFiscale;
    public $Telefono;
    public $Mail;
    public $DataDiNascita;
    public $Documento;
    public $NumeroDocumento;
    public $Indirizzo;
    public $Localita;
    public $Provincia;
    public $CAP;
    public $Disabilitato;
    public $LivelloUtente;


    public function __construct($id, $nome, $cognome, $telefono, $mail, $dataDiNascita, $documento, $numeroDocumento,$codiceFiscale, $indirizzo, $localita, $provincia, $cap, $disabilitato, $livelloUtente)
    {
        //added by Bonantini
        $this-> Id = $id;
        $this-> Nome = $nome;
        $this-> Cognome = $cognome;
        $this-> Telefono= $telefono;
        $this-> Mail= $mail;
        $this-> DataDiNascita= $dataDiNascita;
        $this-> Documento= $documento;
        $this-> NumeroDocumento= $numeroDocumento;
        $this-> CodiceFiscale = $codiceFiscale;
        $this-> Indirizzo= $indirizzo;
        $this-> Localita = $localita;
        $this-> Provincia= $provincia;
        $this-> CAP= $cap;
        $this-> Disabilitato= $disabilitato;
        $this-> LivelloUtente= $livelloUtente;
    }
}