<?php

/**
 * J'ai découpé la méthode en plusieurs petites méthodes (peut être trop)
 * Afin que chaque partie de code s'occupe d'une seule chose, 
 * J'ai changé la structure des dossiers et installer composer.json pour bloquer la version php8 et pour check les conventions de namespaces etc...
 */

declare(strict_types=1);

/**
 * J'ai créé un dossier app et renommé les dossier en accord avec les convention PSR-4 pour que le namespace soit correct.
 */
namespace App\Medium;

class Rover
{
    /**
     * Constructor
     * 
     * J'ai déclaré les propriétés en accord avec la nouvelle convention php8 défini dans composer.json que j'ai installé 
     * Modifié la visibilité en public readonly (php8.2) anfin de ne pas avoir à créer de getter et setter et empecher tout de même leur modifications.
     *
     * @param integer $x
     * @param integer $y
     * @param string $direction
     */
    public function __construct(public int $x, public int $y, public string $direction)
    {
        //
    }
    
    /**
     * Receives the sequence and returns the commands to the driveRover method
     * 
     * J'ai hésité entre une boucle foreach pour une itération du tableau généré via la str_split et un array_map()
     * Au final array_map est un poil plus performant
     *
     * @param string $commandsSequence
     * @return void
     */
    public function receiveSequence(string $commandsSequence): void {

        array_map([self::class, 'driveRover'], str_split($commandsSequence));
    }
    
    /**
     * Method that define if the rover turn or move according to the command receive
     * J'ai hésité entre rassembler les 3 dernieres méthodes en une seule 
     * Finalement j'ai opté pour la découpe en petites portions pour essayer de respecter le principe SRP 
     *
     * @param string $command
     * @return void
     */
    public function driveRover(string $command): void {

        if ($command === "l" || $command === "r") {
            // Rotate Rover
            $this->setDirection($command);
        } else {
            // Move Rover forward or backward
            $this->moveRover($command);
        }
    }


    /**
     * Method to define the direction depends on the command "l" or "r" and the direction of the rover.
     * 
     * J'ai remplacé les if/else par un switch case pour chaque direction puis j'ai découvert la méthode match (php8) en cours de dev.
     * Il utilise une comparaison plus strict et n'évalue qu'une seule ligne. 
     * Puis j'ai utisé un ternaire pour définir la direction pour simplifier la lisibilité du code 
     *
     * @param string $command
     * @return string
     */
    private function setDirection(string $command): string{

        return match ($this->direction) {
            "N" => $this->direction = $command === "r" ? "E" : "W",
            "S" => $this->direction = $command === "r" ? "W" : "E",
            "W" => $this->direction = $command === "r" ? "N" : "S",
            "E" => $this->direction = $command === "r" ? "S" : "N",
            default => $this->direction,
        };
    }

    /**
     * Method to move the rover according to the direction and the command 'f' or i guess 'b'
     * 
     * J'ai refactoré l'assignement de $displacement en une ligne grace a un ternaire pour simplifier
     * Puis utilisation de la méthode match pour les même raisons citées plus hauts.
     *
     * @param string $command
     * @return int
     */
    private function moveRover(string $command): int{
        $displacement = ($command === "f") ? 1 : -1;

        return match ($this->direction) {
            "N" => $this->y += $displacement,
            "S" => $this->y -= $displacement,
            "W" => $this->x -= $displacement,
            default => $this->x += $displacement,
        };
    }
}
