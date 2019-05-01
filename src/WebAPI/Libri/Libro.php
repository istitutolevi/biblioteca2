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
    public $DataFinePrestito;
    public $IdGenere;


    public function __construct($id, $nome, $sede)
    {
        $this-> Id = $id;
        $this-> Nome= $nome;
        $this-> LuogoSede= $sede;



    }




}