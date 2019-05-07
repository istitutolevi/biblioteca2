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
    public $NascitaDa;
    public $NascitaA;
    public $MorteDa;
    public $MorteA;


    public function __construct($id,$nome,$cognome, $dataNascitaDa,$dataNascitaA, $dataMorteDa, $dataMorteA)
    {
        $this-> Id = $id;
        $this-> Nome = $nome;
        $this-> Cognome = $cognome;
        $this-> NascitaDa = $dataNascitaDa;
        $this-> NascitaA= $dataNascitaA;
        $this-> MorteDa= $dataMorteDa;
        $this-> MorteA= $dataMorteA;


    }




}