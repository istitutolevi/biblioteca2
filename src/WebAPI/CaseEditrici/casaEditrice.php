<?php
/**
 * Created by PhpStorm.
 * User: Mattia John
 * Date: 04/04/2019
 * Time: 17:09
 */

class casaEditrice
{
    public $Id;
    public $Nome;
    public $LuogoSede;


    public function __construct($id, $nome, $sede)
    {
        $this-> Id = $id;
        $this-> Nome= $nome;
        $this-> LuogoSede= $sede;



    }




}