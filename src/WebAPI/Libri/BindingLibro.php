<?php
/**
 * Created by PhpStorm.
 * User: Mattia John
 * Date: 04/04/2019
 * Time: 17:09
 */

class bindinglibro
{
    public $Id;
    public $Titolo;
    public $ISBN;
    public $Codice;
    public $CasaEditrice;
    public $Autore;
    public $AnnoA;
    public $AnnoDa;
    public $Armadio;
    public $Scaffale;
    public $Genere;


    public function __construct($id, $titolo, $isbn, $codice, $idCasaEditrice, $annoPubblicazioneA,$annoPubblicazioneDa, $collocazioneArmadio, $collocazioneScaffale, $idGenere, $idAutore)
    {
        //added by Bonantini
        $this-> Id = $id;
        $this-> Titolo= $titolo;
        $this-> ISBN= $isbn;
        $this-> Codice = $codice;
        $this-> CasaEditrice= $idCasaEditrice;
        $this-> AnnoA= $annoPubblicazioneA;
        $this-> AnnoDa= $annoPubblicazioneDa;
        $this-> Armadio= $collocazioneArmadio;
        $this-> Scaffale= $collocazioneScaffale;
        $this-> Autore = $idAutore;
        $this-> Genere= $idGenere;
    }




}