<?php

namespace App\Easy;


class FormatBytes
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(public readonly int $precision, public readonly array $unit)
    {
        $precision = 2;
        $unit = [' B',' KB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB',' HB'];
    }

    /**
     * Function to format bytes into other unit
     * 
     * Correction des typo (ex: yottabytes YB et non ZB)
     * 
     * Itération d'un tableau listant les unité de mesure à retourner
     * A chaque boucle on vérifie si la valeur de $bytes est supérieur ou égale a 1024
     * Si ce n'est pas le cas on retourne directement la valeur du parametre en bytes
     * Sinon on continue jusqu'à la bonne taille
     * 
     * Puis on retourne la valeur convertie et concaténé avec la bonne unité de mesure récupéré via l'index de $i dans le tableau
     *  
     *
     * @param float $bytes
     * @return string
     */
    public function convertSize(float $bytes) : string {
        for($i = 0; $bytes >= 1024 && $i < count($this->unit)-1; $i++){
            $bytes = $bytes /1024;
        }

        return round($bytes, $this->precision) . $this->unit[$i];
    }

}
