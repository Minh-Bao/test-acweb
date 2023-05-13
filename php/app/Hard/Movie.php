<?php
/**
 * J'ai remplacé les constantes par une classe Enums que j'ai créé ans un dossier a ce sujet.
 * Ainsi la proriété priceCode est typé par la class MovieCategory
 * J'ai supprimé la methode setPriceCode car pour ajouter unne nouvelle category/prix on le rajoute dans la classe Enums
 * J'ai supprimé la méthode getTitle car en php8 on peut directement appeler la propriété .
 * Cette dernière pourra être stockée en BDD et non en dure dans le code.
 * Enfin j'ai mis la class en readonly afin d'éviter de modifier le nom ou la category depuis une autre classe .
 *
 *
 */
declare(strict_types=1);

namespace App\Hard;

use App\Hard\Enums\MovieCategory;

readonly class Movie
{
    /**
     * Déclaration des propriété en adéquation avec php8
     *
     * @param string $title
     * @param MovieCategory $movieCategory
     */
    public function __construct(public string $title, public MovieCategory $movieCategory)
    {
        //
    }

    /**
     * Retourne la valeur de la category du film
     *
     * @return int
     */
    public function getPriceCode(): int
    {
        return $this->movieCategory->value;
    }

}