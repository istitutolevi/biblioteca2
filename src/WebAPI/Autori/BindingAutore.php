<?php
/**
 * Created by PhpStorm.
 * User: Mattia John
 * Date: 04/04/2019
 * Time: 17:09
 */

class bindingAutore
{
    public $Id;
    public $Nome;
    public $Cognome;
    public $DataNascitaDa;
    public $DataNascitaA;
    public $DataMorteDa;
    public $DataMorteA;


    public function __construct($id,$nome,$cognome, $dataNascitaDa,$dataNascitaA, $dataMorteDa, $dataMorteA)
    {
        $this-> Id = $id;
        $this-> Nome = $nome;
        $this-> Cognome = $cognome;
        $this-> DataNascitaDa = $dataNascitaDa;
        $this-> DataNascitaA= $dataNascitaA;
        $this-> DataMorteDa= $dataMorteDa;
        $this-> DataMorteA= $dataMorteA;


    }




}