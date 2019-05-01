<?php
/**
 * Created by PhpStorm.
 * User: Mattia John
 * Date: 04/04/2019
 * Time: 17:09
 */

class libro
{
    public $Id;
    public $Titolo;
    public $ISBN;
    public $Codice;
    public $IdCasaEditrice;
    public $AnnoPubblicazione;
    public $CollocazioneLuogo;
    public $CollocazioneArmadio;
    public $CollocazioneScaffale;
    public $Stato;
    public $IdUtentePrestito;
    public $DataInizioPresito;
    public $DataFinePrestitoPrevista;
    public $IdGenere;


    public function __construct($id, $titolo, $isbn, $codice, $idCasaEditrice, $annoPubblicazione, $collocazioneLuogo, $collocazioneArmadio, $collocazioneScaffale, $stato, $idUtentePrestito, $dataInizioPrestito, $dataFinePrestitoPrevista, $idGenere)
    {
        //added by Bonantini
        $this-> Id = $id;
        $this-> Titolo= $titolo;
        $this-> ISBN= $isbn;
        $this-> Codice = $codice;
        $this-> IdCasaEditrice= $idCasaEditrice;
        $this-> AnnoPubblicazione= $annoPubblicazione;
        $this-> CollocazioneLuogo = $collocazioneLuogo;
        $this-> CollocazioneArmadio= $collocazioneArmadio;
        $this-> CollocazioneScaffale= $collocazioneScaffale;
        $this-> Stato = $stato;
        $this-> IdUtentePrestito= $idUtentePrestito;
        $this-> DataInizioPresito= $dataInizioPrestito;
        $this-> DataFinePrestitoPrevista = $dataFinePrestitoPrevista;
        $this-> IdGenere= $idGenere;
    }




}