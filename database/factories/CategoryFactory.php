<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    private static array $descriptions = [
        'Manuels Universitaires' => 'Manuels complets et références académiques couvrant un large éventail de disciplines universitaires : économie, droit, informatique, psychologie, marketing et sciences naturelles. Sélectionnés pour accompagner les étudiants dans leur cursus et la préparation aux examens.',
        'Arts Créatifs' => 'Fournitures artistiques et loisirs créatifs pour l\'expression personnelle : kits de peinture, pâte à modeler, papier origami, mosaïque, blocs aquarelle, toiles et feutres de coloriage. Idéal pour étudiants, amateurs et artistes professionnels.',
        'Calculatrices' => 'Une sélection complète de calculatrices scientifiques, graphiques, financières et de bureau des grandes marques : Casio, Texas Instruments, HP et NumWorks. Adaptées aux cours, examens et travaux professionnels.',
        'Kits Pédagogiques' => 'Kits éducatifs interactifs pour un apprentissage ludique et captivant. Robots, laboratoires de chimie, microscopes, télescopes, modèles anatomiques et expériences sur les énergies renouvelables pour éveiller la curiosité scientifique.',
        'Langues Étrangères' => 'Ressources d\'apprentissage et ouvrages de référence pour l\'anglais, l\'espagnol, l\'allemand et d\'autres langues étrangères. Dictionnaires, guides de grammaire, cahiers de vocabulaire et méthodes audio des éditeurs les plus reconnus.',
        'Papeterie' => 'Fournitures de bureau et articles en papier essentiels : ramettes, carnets, enveloppes, classeurs, chemises cartonnées, intercalaires, blocs-notes et pochettes perforées. Du matériel de qualité pour un usage professionnel et académique.',
        'Matériel de Classe' => 'Équipements et outils pédagogiques conçus pour les enseignants. Tableaux blancs, panneaux d\'affichage, pupitres, compteurs de présence, horloges éducatives et supports de présentation pour créer un environnement d\'apprentissage efficace.',
        'Fournitures Scolaires' => 'Le nécessaire scolaire pour les élèves de tous âges. Stylos, crayons, cahiers, gommes, règles, compas, ciseaux, colle, sacs à dos, trousses et surligneurs — tout ce qu\'il faut pour une année scolaire réussie.',
        'Sciences et Expériences' => 'Matériel scientifique et kits d\'expériences pour explorer la biologie, la chimie, la physique et l\'astronomie. Microscopes, télescopes, thermomètres de laboratoire, stations météo et kits DIY pour projets scientifiques.',
        'Livres' => 'Collection de livres éducatifs pour les élèves du primaire et du secondaire. Mathématiques, français, histoire, géographie, sciences, philosophie et langues avec cahiers d\'exercices, dictionnaires et guides de préparation aux examens.',
        'Informatique et Programmation' => 'Matériel informatique, accessoires et outils de programmation pour étudiants et passionnés de technologie. Ordinateurs portables, claviers mécaniques, souris, webcams, clés USB, équipements réseau et câbles — l\'essentiel pour l\'espace de travail numérique.',
        'Outils de Dessin' => 'Fournitures professionnelles de dessin et d\'illustration pour artistes et étudiants en design. Crayons de couleur, pastels, carnets de croquis, sets de géométrie, peinture acrylique, gouache et toiles pour tous les niveaux.',
    ];

    public function definition(): array
    {
        $name = fake()->unique()->randomElement(array_keys(self::$descriptions));

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => self::$descriptions[$name],
        ];
    }
}
