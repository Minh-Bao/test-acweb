<?php
/**
 * j'ai déclarée les propriétés selon la convention php8 et ajouté une propriétés array rentals qui servira à ajouter des locations au customer.
 * J'ai modifié la méthodes addRental pour ajouter à chaque fois une nouvelle instance de Rental avec tout ce que cela implique.
 * Suppression de la méthode getName car les getter et setter ne sont plus indispensables pour les propriétés public en php8.2
 * Enfin j'ai découpé la méthode statements en petites fonctions pour respecter le SRP
 * J'ai utilisé au maximum des ternaires ou la methode match() afin de limiter les if/else et gagner en lisibilité et performance.
 *
 */

declare(strict_types=1);

namespace App\Hard;

use App\Hard\Enums\MovieCategory;
use App\Hard\Rental;
use Exception;

class Customer
{
    /**
     * J'ai déclaré les propriétés en accord avec la nouvelle convention php8 défini dans composer.json que j'ai installé
     * Modifié la visibilité de private en public readonly (php8.2) anfin de ne pas avoir à créer de getter et setter et empecher tout de même leur modifications.
     *
     * @param string $name
     * @param array $rentals
     */
    public function __construct(public readonly string $name, private array $rentals)
    {
        $this->rentals = [];
    }

    /**
     * Add new rental to the rental list of the customer
     *
     * @param string $titleMovie
     * @param MovieCategory $category
     * @param int $daysRented
     * @return Rental
     */
    public function addRental(string $titleMovie,MovieCategory $category, int $daysRented ): Rental
    {
        return $this->rentals[] = new Rental(new Movie($titleMovie, $category), $daysRented);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function statement(): string {

        $totalAmount = 0.0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->name . "\n";

        /**
         * J'ai découpé le code en petite fonction qui s'occupe chacune de choses différentes.
         */
        foreach ($this->rentals as $each) {
            $thisAmount = $this->getAmount($each);
            $frequentRenterPoints = $this->getFrequentPointNumber($each, $frequentRenterPoints);
            $result .= "\t{$each->movie->title}\t" . number_format($thisAmount, 1) . "\n";
            $totalAmount += $thisAmount;
        }

        $result .= "You owed " . number_format($totalAmount, 1)  . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points\n";

        return $result;
    }

    /**
     * @param Rental $each
     * @return float|int
     * @throws Exception
     */
    public function getAmount(Rental $each): int|float
    {
        return match ($each->movie->getPriceCode()) {
            MovieCategory::NEW_RELEASE->value => $each->daysRented * 3,
            MovieCategory::REGULAR->value => 2 + ($each->daysRented > 2 ? ($each->daysRented - 2) * 1.5 : 0),
            MovieCategory::CHILDREN->value => 1.5 + ($each->daysRented > 3 ? ($each->daysRented - 3) * 1.5 : 0),
            default => 0.0,
        };
    }

    /**
     * Calcule le nombre de point de fréquence
     * Utilisation d'un ternaire pour simplifier le code
     * Et évalue une seule fois en fonction de la category et du nombre de jour loués  si l'on ajoute 1 ou 2 points au lieux de le faire en 2 fois .
     *
     * @param Rental $each
     * @param int $frequentRenterPoints
     * @return int
     */
    public function getFrequentPointNumber(Rental $each, int $frequentRenterPoints): int
    {
        return $frequentRenterPoints + (($each->movie->getPriceCode() === MovieCategory::NEW_RELEASE->value && $each->daysRented > 1) ? 2 : 1);
    }

}