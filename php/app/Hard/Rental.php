<?php
/**
 * J'ai redeclaré les propriétés et mis daysRented en Readonly afin d'éviter une modification externe
 * J'ai supprimé la méthode getDaysRented et getMovie comme le permet php8 pour les propriété public
 * J'ai passé la propriété daysRented en readonly afin d'éviter toute modif externe à  la classe
 *
 *
 */
declare(strict_types=1);

namespace App\Hard;

use App\Hard\Movie;

class Rental
{
    /**
     * Déclaration des propriétés selon les convention de php8
     *
     * @param Movie $movie
     * @param int $daysRented
     */
    public function __construct(public Movie $movie, public readonly int $daysRented)
    {
       //
    }
}