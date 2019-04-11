<?php
/**
 * Created by PhpStorm.
 * User: Mattia John
 * Date: 04/04/2019
 * Time: 17:09
 */

class viewAutore
{
    public $Id;
    public $Nome;
    public $Cognome;
    public $DataNascita;
    public $DataMorte;


    public function __construct($id,$nome,$cognome, $dataNascita, $dataMorte)
    {
        $this-> Id = $id;
        $this-> Nome = $nome;
        $this-> Cognome = $cognome;
        $this-> DataNascita = $dataNascita;

        $this-> DataMorte= $dataMorte;


    }




}