<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    private static array $productTemplates = [
        'Livres' => [
            ['title' => 'Manuel de Mathématiques 6ème', 'desc' => 'Manuel complet couvrant le programme de mathématiques de la 6ème. Nombres entiers, fractions, géométrie de base et statistiques. Exercices progressifs avec corrigés détaillés.', 'price' => 180, 'stock' => 50, 'image_key' => 'math-book'],
            ['title' => 'Manuel de Français 5ème', 'desc' => 'Grammaire, conjugaison, orthographe et rédaction. Extraits littéraires classiques et modernes, questionnaires de compréhension, sujets de rédaction.', 'price' => 175, 'stock' => 45, 'image_key' => 'french-book'],
            ['title' => 'Cahier d\'Exercices Physique-Chimie 3ème', 'desc' => 'Plus de 200 exercices corrigés sur l\'électricité, la mécanique, la chimie. Conforme au programme officiel avec schémas en couleur.', 'price' => 120, 'stock' => 60, 'image_key' => 'physics-book'],
            ['title' => 'Guide SVT - Sciences de la Vie et de la Terre', 'desc' => 'Référence pour l\'enseignement des SVT. Biologie végétale, animale, écologie, géologie. Illustrations détaillées et fiches de synthèse.', 'price' => 190, 'stock' => 40, 'image_key' => 'svt-book'],
            ['title' => 'Bescherelle - La Conjugaison pour Tous', 'desc' => 'Intégralité des verbes français conjugués à tous les temps. Tableaux clairs, règles d\'accord, listes des verbes irréguliers.', 'price' => 150, 'stock' => 80, 'image_key' => 'bescherelle'],
            ['title' => 'Atlas Scolaire du Monde', 'desc' => 'Cartes physiques et politiques détaillées de tous les continents. Données démographiques et économiques actualisées. Index complet.', 'price' => 220, 'stock' => 35, 'image_key' => 'atlas'],
            ['title' => 'Manuel d\'Histoire-Géographie 4ème', 'desc' => 'Histoire moderne, géographie humaine. Documents sources, frises chronologiques, études de cas pour le brevet.', 'price' => 165, 'stock' => 55, 'image_key' => 'history-book'],
            ['title' => 'Allemand 1ère Année - Cahier d\'Activités', 'desc' => 'Introduction progressive à l\'allemand. Vocabulaire illustré, dialogues simples, exercices de grammaire, jeux linguistiques.', 'price' => 130, 'stock' => 45, 'image_key' => 'german-book'],
            ['title' => 'Sésame - Maths Terminale S', 'desc' => 'Préparation complète au baccalauréat scientifique. Cours détaillés, exercices types, sujets d\'examen corrigés.', 'price' => 250, 'stock' => 30, 'image_key' => 'math-advanced'],
            ['title' => 'Bled - Orthographe et Grammaire', 'desc' => 'Référence pour maîtriser l\'orthographe française. Règles expliquées simplement avec exemples concrets.', 'price' => 140, 'stock' => 70, 'image_key' => 'bled'],
            ['title' => 'Dictionnaire Le Robert Poche', 'desc' => '60 000 mots, 100 000 définitions. Conjugaison, étymologie, synonymes. Format poche pratique.', 'price' => 180, 'stock' => 50, 'image_key' => 'dictionary'],
            ['title' => 'Larousse Junior - Dictionnaire Enfant', 'desc' => '30 000 mots, définitions simples, illustrations. Pour enfants 7-11 ans. Conjugaison, grammaire.', 'price' => 195, 'stock' => 40, 'image_key' => 'child-dictionary'],
            ['title' => 'Manuel de Philosophie Terminale', 'desc' => 'Programme officiel : sujet, culture, raison, politique, morale. Textes d\'auteurs, analyses, sujets bac.', 'price' => 200, 'stock' => 35, 'image_key' => 'philosophy-book'],
            ['title' => 'Cahier de Vacances CM2 vers 6ème', 'desc' => 'Révision complète du programme CM2. Français, maths, anglais, découverte du monde. Jeux et exercices ludiques.', 'price' => 85, 'stock' => 100, 'image_key' => 'vacation-workbook'],
            ['title' => 'Petit Larousse Illustré 2025', 'desc' => '65 000 mots, 28 000 noms propres. Encyclopédie de référence. Version mise à jour annuelle.', 'price' => 350, 'stock' => 25, 'image_key' => 'larousse'],
        ],
        'Manuels Universitaires' => [
            ['title' => 'Introduction à l\'Économie', 'desc' => 'Principes microéconomie et macroéconomie. Marchés, politiques économiques, inflation, chômage. Exemples concrets.', 'price' => 320, 'stock' => 30, 'image_key' => 'economics-book'],
            ['title' => 'Droit Constitutionnel - L1 Droit', 'desc' => 'Théorie de l\'État, séparation des pouvoirs, constitution, justice constitutionnelle. Jurisprudence majeure.', 'price' => 280, 'stock' => 40, 'image_key' => 'law-book'],
            ['title' => 'Algorithmique et Programmation - Python', 'desc' => 'Structures de données, algorithmes de tri, récursivité, POO. Exercices corrigés, projets pratiques.', 'price' => 350, 'stock' => 35, 'image_key' => 'python-book'],
            ['title' => 'Biochimie Structurale et Métabolique', 'desc' => 'Protéines, glucides, lipides, acides nucléiques. Voies métaboliques, régulations enzymatiques. Schémas détaillés.', 'price' => 420, 'stock' => 25, 'image_key' => 'biochemistry-book'],
            ['title' => 'Statistiques pour Sciences Sociales', 'desc' => 'Statistiques descriptives, probabilités, tests d\'hypothèses, régression linéaire. Applications SPSS/R.', 'price' => 380, 'stock' => 30, 'image_key' => 'stats-book'],
            ['title' => 'Psychologie Cognitive', 'desc' => 'Mémoire, attention, langage, raisonnement. Théories classiques et récentes. Expériences clés.', 'price' => 340, 'stock' => 35, 'image_key' => 'psychology-book'],
            ['title' => 'Marketing Fondamentaux', 'desc' => 'Mix marketing, segmentation, comportement consommateur, marque, digital. Cas d\'entreprises réelles.', 'price' => 360, 'stock' => 30, 'image_key' => 'marketing-book'],
            ['title' => 'Droit des Affaires', 'desc' => 'Sociétés, contrats commerciaux, concurrence, propriété intellectuelle. Code de commerce annoté.', 'price' => 320, 'stock' => 35, 'image_key' => 'business-law'],
            ['title' => 'Comptabilité Générale', 'desc' => 'Plan comptable, écritures, bilan, compte de résultat, TVA. Exercices progressifs corrigés.', 'price' => 290, 'stock' => 40, 'image_key' => 'accounting-book'],
            ['title' => 'Gestion des Ressources Humaines', 'desc' => 'Recrutement, formation, évaluation, rémunération, droit social. Outils RH modernes.', 'price' => 340, 'stock' => 30, 'image_key' => 'hr-book'],
        ],
        'Fournitures Scolaires' => [
            ['title' => 'Lot de 10 Stylos Bille Bleu', 'desc' => 'Stylos bille encre bleue qualité pro. Pointe 0.7mm, écriture fluide. Corps ergonomique antidérapant.', 'price' => 45, 'stock' => 200, 'image_key' => 'blue-pens'],
            ['title' => 'Lot de 10 Stylos Bille Noir', 'desc' => 'Stylos bille encre noire. Pointe 0.7mm, séchage rapide. Idéal examens et concours.', 'price' => 45, 'stock' => 200, 'image_key' => 'black-pens'],
            ['title' => 'Lot de 10 Stylos Bille Rouge', 'desc' => 'Stylos bille encre rouge. Pointe 0.7mm. Correction, annotation, surlignage.', 'price' => 45, 'stock' => 150, 'image_key' => 'red-pens'],
            ['title' => 'Cahier 200 Pages Grand Format', 'desc' => 'Format 21x29.7cm, spirale. 200 pages, papier 90g/m² anti-transparence. Couverture rigide.', 'price' => 35, 'stock' => 150, 'image_key' => 'notebook-200'],
            ['title' => 'Cahier 96 Pages Petit Format', 'desc' => 'Format 17x22cm, 96 pages. Papier 90g/m². Couverture souple colorée. Idéal primaire.', 'price' => 18, 'stock' => 300, 'image_key' => 'notebook-96'],
            ['title' => 'Cahier Spirale 140 Pages', 'desc' => 'Format A4, 140 pages. Spirale résistante. Papier 90g/m². Marge pré-imprimée.', 'price' => 28, 'stock' => 200, 'image_key' => 'spiral-notebook'],
            ['title' => 'Classeur 4 Anneaux A4', 'desc' => 'Classeur levier 4 anneaux 5cm. Capacité 300 feuilles. Polypropylène transparent. Dos personnalisable.', 'price' => 55, 'stock' => 80, 'image_key' => 'binder'],
            ['title' => 'Lot de 10 Dossiers Suspendus', 'desc' => 'Dossiers suspension format A4. Renfort métallique, onglets identifiables. Coloris assortis.', 'price' => 65, 'stock' => 100, 'image_key' => 'hanging-folders'],
            ['title' => 'Set 5 Marqueurs Fluorescents', 'desc' => 'Marqueurs fluo sans bavure. Jaune, rose, vert, orange, bleu. Pointe biseautée 1-4mm.', 'price' => 35, 'stock' => 250, 'image_key' => 'highlighters'],
            ['title' => 'Correcteur Liquide 15ml', 'desc' => 'Correcteur blanc séchage rapide. Embout pinceau précis. Couvre encre noire et bleue.', 'price' => 18, 'stock' => 200, 'image_key' => 'correction-fluid'],
            ['title' => 'Roller Correcteur 5mm x 8m', 'desc' => 'Bande correctrice blanche. Application propre, réécriture immédiate. Rechargeable.', 'price' => 25, 'stock' => 150, 'image_key' => 'correction-tape'],
            ['title' => 'Agenda Scolaire 2025-2026', 'desc' => 'Journalier et hebdomadaire. Sept 2025 - Juin 2026. Emploi du temps, notes, répertoire.', 'price' => 55, 'stock' => 200, 'image_key' => 'agenda'],
            ['title' => 'Pack 100 Feuilles Quadrillées', 'desc' => 'Format A4 21x29.7cm. Quadrillage 5x5mm. Papier 80g/m². Perforées 4 trous.', 'price' => 25, 'stock' => 300, 'image_key' => 'grid-paper'],
            ['title' => 'Pack 100 Feuilles Unies', 'desc' => 'Format A4. Papier 80g/m² blanc. Perforées 4 trous. Marge gauche. Ramette 100 feuilles.', 'price' => 22, 'stock' => 300, 'image_key' => 'lined-paper'],
            ['title' => 'Trousse Scolaire 2 Compartiments', 'desc' => 'Toile polyester 25x12cm. 2 zips, poches filet intérieure. Capacité 40 stylos. Coloris variés.', 'price' => 85, 'stock' => 120, 'image_key' => 'pencil-case'],
            ['title' => 'Lot 12 Crayons à Papier HB', 'desc' => 'Crayons graphite HB. Mine résistante 2.2mm. Bois cèdre certifié. Gomme intégrée.', 'price' => 30, 'stock' => 250, 'image_key' => 'pencils-hb'],
            ['title' => 'Lot 12 Crayons de Couleur', 'desc' => 'Mines tendres 3.3mm. Couleurs vives, mélangeables. Étui carton renforcé. Norme CE.', 'price' => 55, 'stock' => 150, 'image_key' => 'color-pencils'],
            ['title' => 'Boîte 24 Feutres Fins', 'desc' => 'Feutres pointe fine 0.4mm. Encre lavable. 24 couleurs. Capuchon ventilé sécurité.', 'price' => 65, 'stock' => 120, 'image_key' => 'fine-markers'],
            ['title' => 'Gomme Blanche Lot de 5', 'desc' => 'Gommes qualité supérieure. Effacement net sans trace. Format 40x20x12mm. Sans PVC.', 'price' => 20, 'stock' => 200, 'image_key' => 'erasers'],
            ['title' => 'Taille-Crayon Métallique Double', 'desc' => 'Double trou standard et gros. Lame acier inoxydable. Réservoir transparent. Vis de fixation.', 'price' => 15, 'stock' => 200, 'image_key' => 'sharpener'],
            ['title' => 'Règle Plate 30cm Transparente', 'desc' => 'Règle PMMA incassable. Graduations mm/cm précises. Bords biseautés. Face antidérapante.', 'price' => 12, 'stock' => 300, 'image_key' => 'ruler'],
            ['title' => 'Équerre 26cm + Rapporteur 180°', 'desc' => 'Set géométrie : équerre 26cm, rapporteur 180°. PMMA transparent. Graduations laser.', 'price' => 22, 'stock' => 200, 'image_key' => 'set-square'],
            ['title' => 'Compas de Précision Métallique', 'desc' => 'Compas acier inox. Réglage micrométrique. Crayon et pointe sèche. Étui rigide.', 'price' => 85, 'stock' => 80, 'image_key' => 'compass'],
            ['title' => 'Ciseaux Scolaires 13cm', 'desc' => 'Lames inox bout rond. Poignées ergonomiques souples. Ambidextre. Lame micro-dentelée.', 'price' => 18, 'stock' => 250, 'image_key' => 'scissors'],
            ['title' => 'Colle Bâton 21g Lot de 3', 'desc' => 'Bâtons colle PVP. Séchage 30s. Propre, non toxique, lavable. Tube rétractable.', 'price' => 28, 'stock' => 200, 'image_key' => 'glue-sticks'],
            ['title' => 'Colle Liquide 50ml', 'desc' => 'Colle blanche vinyle. Embout pinceau. Fort pouvoir collant. Bois, papier, carton. Sans solvant.', 'price' => 15, 'stock' => 150, 'image_key' => 'liquid-glue'],
            ['title' => 'Ramette A4 500 Feuilles 80g', 'desc' => 'Papier blanc 80g/m². Blancheur CIE 161. Multifonction imprimante/copieur. Certifié PEFC.', 'price' => 55, 'stock' => 100, 'image_key' => 'a4-paper'],
            ['title' => 'Sac à Dos Scolaire 30L', 'desc' => 'Polyester 600D imperméable. Dos rembourré, bretelles ergonomiques. 2 grands compartiments, poche avant.', 'price' => 280, 'stock' => 50, 'image_key' => 'backpack'],
        ],
        'Calculatrices' => [
            ['title' => 'Calculatrice Scientifique Casio FX-92+', 'desc' => '276 fonctions, écran 4 lignes, 15 niveaux parenthèses. Mode examen officiel. Alimentation solaire + pile.', 'price' => 220, 'stock' => 60, 'image_key' => 'casio-fx92'],
            ['title' => 'Calculatrice Graphique Casio Graph 90+E', 'desc' => 'Écran couleur 3.5", 61KB RAM, 4.5MB Flash. Python, CAS, tableaux, graphiques 3D. Mode examen.', 'price' => 1450, 'stock' => 20, 'image_key' => 'casio-graph90'],
            ['title' => 'Calculatrice Scientifique Texas TI-30X Pro', 'desc' => 'Écran 4 lignes, 417 fonctions. MathPrint, tableaux, conversions unités. Pile CR2032 fournie.', 'price' => 280, 'stock' => 40, 'image_key' => 'ti30xpro'],
            ['title' => 'Calculatrice Graphique NumWorks N0100', 'desc' => 'Écran 2.8" couleur, Python, applications intégrées. Interface intuitive. Mode examen LED.', 'price' => 1350, 'stock' => 25, 'image_key' => 'numworks'],
            ['title' => 'Calculatrice de Bureau 12 Chiffres', 'desc' => 'Écran LCD inclinable 12 digits. Imprimante 2 couleurs. Mémoire, %, racine, TTC. Alim secteur/piles.', 'price' => 380, 'stock' => 30, 'image_key' => 'desk-calculator'],
            ['title' => 'Calculatrice Financière HP 10bII+', 'desc' => '120 fonctions financières. VAN, TIR, amortissement, obligations. Clavier RPN/algébrique.', 'price' => 950, 'stock' => 15, 'image_key' => 'hp10bii'],
            ['title' => 'Calculatrice de Poche 8 Chiffres', 'desc' => 'Format carte crédit. 4 opérations, %, racine, mémoire. Solaire double alimentation. Etui rigide.', 'price' => 45, 'stock' => 100, 'image_key' => 'pocket-calculator'],
        ],
        'Outils de Dessin' => [
            ['title' => 'Kit 12 Crayons de Couleur Artiste', 'desc' => 'Mines 3.8mm tendres, pigments purs. 12 couleurs intenses, mélangeables. Boîte métal.', 'price' => 120, 'stock' => 80, 'image_key' => 'artist-pencils'],
            ['title' => 'Kit 24 Crayons Aquarelle', 'desc' => 'Mines solubles dans l\'eau. 24 nuances. Pointe 3.3mm. Travail sec ou humide. Boîte métal.', 'price' => 180, 'stock' => 50, 'image_key' => 'watercolor-pencils'],
            ['title' => 'Bloc Dessin A3 30 Feuilles', 'desc' => 'Papier 180g/m² grain fin. 30 feuilles. Idéal crayon, fusain, pastel. Couverture rigide.', 'price' => 85, 'stock' => 80, 'image_key' => 'drawing-pad-a3'],
            ['title' => 'Bloc Aquarelle A4 20 Feuilles', 'desc' => 'Papier 300g/m² grain fin. Encollé 4 bords. 100% coton. Ne gondole pas.', 'price' => 95, 'stock' => 60, 'image_key' => 'watercolor-pad'],
            ['title' => 'Set 6 Feutres Artistiques Double Pointe', 'desc' => 'Pointe fine 0.4mm + moyenne 1mm. Encre à base d\'eau. 6 couleurs. Capuchon étanche.', 'price' => 85, 'stock' => 80, 'image_key' => 'artist-markers'],
            ['title' => 'Marqueurs Posca Lot de 8', 'desc' => 'Peinture acrylique opaque. Pointe 1.8-2.5mm. 8 couleurs. Multi-surfaces. Non toxique.', 'price' => 160, 'stock' => 60, 'image_key' => 'posca-markers'],
            ['title' => 'Pastels Secs Artistique 24 Couleurs', 'desc' => 'Pastels tendres, pigments purs. Couleurs intenses, fondant. Étui bois 24 teintes.', 'price' => 140, 'stock' => 50, 'image_key' => 'soft-pastels'],
            ['title' => 'Pastels à l\'Huile 24 Couleurs', 'desc' => 'Pastels gras, couvrants. Résistants à l\'eau. 24 teintes vives. Papier, toile, bois.', 'price' => 110, 'stock' => 60, 'image_key' => 'oil-pastels'],
            ['title' => 'Gomme Mie de Pain Artistique', 'desc' => 'Gomme molle malléable. Absorbe graphite/charbon sans abîmer papier. Format 5x5cm.', 'price' => 35, 'stock' => 100, 'image_key' => 'kneaded-eraser'],
            ['title' => 'Carnet Croquis Poche 10x15cm', 'desc' => 'Papier 140g/m² grain fin. 80 pages. Spirale. Couverture kraft. Glisse dans la poche.', 'price' => 45, 'stock' => 100, 'image_key' => 'sketchbook-pocket'],
            ['title' => 'Compas de Précision Grand Modèle', 'desc' => 'Compas acier, bras 18cm. Réglage central précis. Cercles jusqu\'à 35cm. Étui cuir.', 'price' => 120, 'stock' => 40, 'image_key' => 'large-compass'],
            ['title' => 'Set Règle 30cm + Équerre 26cm + Rapporteur', 'desc' => 'PMMA transparent. Règle 30cm, équerre 26cm 45/60°, rapporteur 180°. Pochette.', 'price' => 35, 'stock' => 150, 'image_key' => 'geometry-set'],
            ['title' => 'Toile Peinture 40x50cm Lot de 3', 'desc' => 'Coton 380g/m². Châssis bois pin 2cm. Encollage universel. Prêtes à peindre.', 'price' => 180, 'stock' => 40, 'image_key' => 'canvas-pack'],
            ['title' => 'Kit Peinture Acrylique 12 Tubes', 'desc' => '12 tubes 20ml. Couleurs primaires + nuances. Pigments fins. Non toxique. Tubes refermables.', 'price' => 140, 'stock' => 60, 'image_key' => 'acrylic-set'],
            ['title' => 'Kit Gouache 12 Couleurs + Pinceaux', 'desc' => '12 godets 12ml + 3 pinceaux synthétiques. Couleurs vives, lavables. Palette intégrée.', 'price' => 85, 'stock' => 80, 'image_key' => 'gouache-set'],
        ],
        'Kits Pédagogiques' => [
            ['title' => 'Kit Chimie - 50 Expériences', 'desc' => 'Labo complet: tubes, bécher, pipettes, lunettes, produits chimiques sûrs. 50 expériences. Livret 48p.', 'price' => 350, 'stock' => 25, 'image_key' => 'chemistry-kit'],
            ['title' => 'Kit Robotique Solaire 12-en-1', 'desc' => '12 robots solaires à construire. Panneau solaire, moteur, engrenages. notice illustrée. Dès 10 ans.', 'price' => 280, 'stock' => 30, 'image_key' => 'solar-robot'],
            ['title' => 'Kit Robotique Programmable mBot', 'desc' => 'Robot Arduino programmable Scratch/Python. Capteurs: ultrasons, ligne, lumière. Bluetooth. Dès 8 ans.', 'price' => 850, 'stock' => 15, 'image_key' => 'mbot'],
            ['title' => 'Kit Micro:bit V2 Go', 'desc' => 'Microcontrôleur BBC. LED 5x5, boutons, accéléromètre, boussole, Bluetooth, radio. Batterie incluse.', 'price' => 320, 'stock' => 30, 'image_key' => 'microbit'],
            ['title' => 'Kit Arduino Uno R3 Starter', 'desc' => 'Arduino Uno R3, breadboard, LEDs, résistances, capteurs, moteurs, fils. 15 projets tutoriels.', 'price' => 420, 'stock' => 25, 'image_key' => 'arduino-starter'],
            ['title' => 'Kit Corps Humain Anatomique', 'desc' => 'Modèle 45cm, 30 pièces amovibles. Squelette, organes, muscles, vaisseaux. Socle rotatif. Guide anatomique.', 'price' => 280, 'stock' => 30, 'image_key' => 'anatomy-model'],
            ['title' => 'Squelette Humain 85cm sur Socle', 'desc' => 'Squelette anatomique complet. Articulations mobiles. Crâne ouvrant. Socle métal roulettes. Notice.', 'price' => 850, 'stock' => 10, 'image_key' => 'skeleton-model'],
            ['title' => 'Globe Terrestre Lumineux 30cm', 'desc' => 'Globe physique/politique. Éclairage LED interne. Pays, capitales, méridiens. Socle métal.', 'price' => 350, 'stock' => 25, 'image_key' => 'globe'],
            ['title' => 'Microscope Optique 40x-1000x', 'desc' => '3 objectifs 4x/10x/40x. Oculaire 10x/25x. Éclairage LED double. Mise au point macro/micro. Lames incluses.', 'price' => 550, 'stock' => 20, 'image_key' => 'microscope'],
            ['title' => 'Télescope Réfracteur 70mm/700mm', 'desc' => 'Ouverture 70mm, focale 700mm. Monture équatoriale, trépied alu. Oculaires 10mm/20mm. Filtre lune.', 'price' => 850, 'stock' => 12, 'image_key' => 'telescope'],
            ['title' => 'Balance Précision 0.01g / 200g', 'desc' => 'Précision 0.01g, capacité 200g. Écoulement, tare, comptage. Écran LCD rétroéclairage. Calibrage externe.', 'price' => 420, 'stock' => 20, 'image_key' => 'precision-scale'],
            ['title' => 'Kit Énergie Renouvelable', 'desc' => 'Éolienne, panneau solaire, pile à combustible H2, voiture électrique. 20 expériences. Mesureurs inclus.', 'price' => 480, 'stock' => 20, 'image_key' => 'renewable-kit'],
        ],
        'Papeterie' => [
            ['title' => 'Ramette A4 500 Feuilles 80g', 'desc' => 'Papier blanc 80g/m². Blancheur 161 CIE. Multifonction. Ream emballé 500 feuilles. PEFC.', 'price' => 55, 'stock' => 100, 'image_key' => 'a4-paper'],
            ['title' => 'Ramette A3 500 Feuilles 80g', 'desc' => 'Format A3 297x420mm. 500 feuilles 80g/m². Blancheur 161. Imprimante laser/jet encre.', 'price' => 110, 'stock' => 50, 'image_key' => 'a3-paper'],
            ['title' => 'Bloc-Notes Autocollants 75x75mm', 'desc' => '12 blocs x 100 feuilles. Couleurs néon. Adhésif repositionnable. 100% recyclé.', 'price' => 45, 'stock' => 150, 'image_key' => 'sticky-notes'],
            ['title' => 'Carnet Notes Relié 192 Pages', 'desc' => 'Format A5. 192 pages lignées 90g/m² ivoire. Couverture cuir synthétique. Signet, élastique, poche.', 'price' => 85, 'stock' => 80, 'image_key' => 'hardcover-notebook'],
            ['title' => 'Cahier Réunion A4 80 Pages', 'desc' => 'Couverture polypro. 80 pages micro-perforées. 2 trous. Papier 90g. Marge, en-tête date/objet.', 'price' => 35, 'stock' => 100, 'image_key' => 'meeting-notebook'],
            ['title' => 'Enveloppes Kraft A4 Lot de 50', 'desc' => 'Kraft brun 120g. Autocollantes. Fenêtre 45x90mm. Rabat droit. Qualité postale.', 'price' => 65, 'stock' => 80, 'image_key' => 'kraft-envelopes'],
            ['title' => 'Enveloppes Blanches DL Lot 100', 'desc' => 'Blanc 90g. Fenêtre gauche. Autocollantes. Format DL 110x220mm. Qualité supérieure.', 'price' => 55, 'stock' => 100, 'image_key' => 'white-envelopes'],
            ['title' => 'Classeur 2 Anneaux A4 30mm', 'desc' => '2 anneaux ronds 30mm. Polypro opaque. Couverture 1.5mm. Compression 250 feuilles. 2 poches int.', 'price' => 38, 'stock' => 120, 'image_key' => '2-ring-binder'],
            ['title' => 'Chemises Cartonnées A4 Lot 50', 'desc' => 'Carton 250g. Rabat 30mm. 3 rabats. Coins arrondis. Coloris assortis. Dos 30mm.', 'price' => 85, 'stock' => 60, 'image_key' => 'cardboard-folders'],
            ['title' => 'Intercalaires A4 12 Onglets', 'desc' => 'Polypropylène translucide. 12 onglets numérotés 1-12. Renforcés. Perforation universelle.', 'price' => 25, 'stock' => 150, 'image_key' => 'dividers'],
            ['title' => 'Pochettes Perforées A4 Lot 100', 'desc' => 'Polypropylène 80µ transparent. Perforation 11 trous. Ouverture haut. Épaisseur 60µ.', 'price' => 45, 'stock' => 100, 'image_key' => 'sheet-protectors'],
        ],
        'Matériel de Classe' => [
            ['title' => 'Tableau Velleda 120x90cm', 'desc' => 'Blanc magnétique vitrifié. Cadre alu anodisé. Kit fixation mural. 1 feutre + effaceur.', 'price' => 450, 'stock' => 20, 'image_key' => 'whiteboard'],
            ['title' => 'Tableau Velleda Mobile 150x100cm', 'desc' => 'Sur pied 4 roulettes freinées. Double face magnétique. Hauteur réglable 170-190cm.', 'price' => 1200, 'stock' => 8, 'image_key' => 'mobile-whiteboard'],
            ['title' => 'Ardoises Velleda 30x21cm Lot 30', 'desc' => 'Blanches effaçables. Coins arrondis. Surface lisse. 30 ardoises + 30 feutres + 30 chiffons.', 'price' => 420, 'stock' => 20, 'image_key' => 'slates-pack'],
            ['title' => 'Feutres Tableau Lot 12 Couleurs', 'desc' => 'Pointe ogive 3mm. Encre effaçable sèche. 12 couleurs. Corps transparent. Capuchon ventilé.', 'price' => 120, 'stock' => 80, 'image_key' => 'board-markers'],
            ['title' => 'Effaceur Tableau Magnétique', 'desc' => 'Effaceur feutre sec. Manche ergonomique. Feutre amovible lavable. Aimant intégré.', 'price' => 45, 'stock' => 100, 'image_key' => 'board-eraser'],
            ['title' => 'Horloge Murale Pédagogique 30cm', 'desc' => 'Cadran 12h/24h. Aiguilles heures/minutes couleurs. Silencieuse. Pile AA fournie.', 'price' => 120, 'stock' => 60, 'image_key' => 'teaching-clock'],
            ['title' => 'Tableau Affichage Liège 90x60cm', 'desc' => 'Liège naturel 10mm. Cadre alu argenté. Auto-cicatrisant. Kit fixation inclus.', 'price' => 280, 'stock' => 30, 'image_key' => 'cork-board'],
            ['title' => 'Pupitre Professeur Réglable', 'desc' => 'Hauteur 52-76cm. Plateau inclinable 0-45°. Structure acier époxy. Range-livres intégré.', 'price' => 650, 'stock' => 15, 'image_key' => 'teacher-desk'],
            ['title' => 'Compteur Présence Magnétique 30', 'desc' => 'Panneau 45x30cm. 30 aimants photos/noms. 3 zones: présent/absent/retard. Feutre effaçable.', 'price' => 180, 'stock' => 30, 'image_key' => 'attendance-board'],
            ['title' => 'Mallette Enseignant 40x30cm', 'desc' => 'Polyester 600D. Compartiments: PC 15\", dossiers, trousse, bouteille. Bandoulière rembourrée.', 'price' => 320, 'stock' => 30, 'image_key' => 'teacher-bag'],
        ],
        'Sciences et Expériences' => [
            ['title' => 'Microscope Optique 40x-1000x', 'desc' => '3 objectifs achromatiques 4x/10x/40x. Oculaire grand champ 10x/25x. LED réglable. 5 lames préparées.', 'price' => 550, 'stock' => 20, 'image_key' => 'microscope'],
            ['title' => 'Télescope 70mm/700mm', 'desc' => 'Réfracteur 70mm/700mm. Monture équatoriale EQ. Trépied alu. Oculaires 10/20mm. Filtre lune. Sac transport.', 'price' => 850, 'stock' => 12, 'image_key' => 'telescope'],
            ['title' => 'Kit Chimie Volcans Cristaux', 'desc' => 'Éruptions volcaniques, culture cristaux. 15 expériences. Tubes, entonnoir, lunettes, gants. 8+ ans.', 'price' => 180, 'stock' => 40, 'image_key' => 'volcano-kit'],
            ['title' => 'Kit Énergie Solaire', 'desc' => 'Voiture solaire + moulin à vent. Panneau 2V/100mAh. Moteur 1.5V. Assemblage sans outil. 8+ ans.', 'price' => 180, 'stock' => 50, 'image_key' => 'solar-kit'],
            ['title' => 'Loupe Binoculaire 20x', 'desc' => 'Grossissement 20x. Œilletons caoutchouc. Mise au point centrale. Étui rigide. Poids 320g.', 'price' => 220, 'stock' => 40, 'image_key' => 'binoculars'],
            ['title' => 'Thermomètre Laboratoire -10/+110°C', 'desc' => 'Verre, colonne alcool rouge. Précision ±1°C. Longueur 30cm. Anneau suspension.', 'price' => 45, 'stock' => 100, 'image_key' => 'lab-thermometer'],
            ['title' => 'Set 10 Lames Microscope Préparées', 'desc' => 'Tissus végétaux/animaux, protozoaires, bactéries. Verre 26x76mm. Boîte bois 10 compartiments.', 'price' => 120, 'stock' => 50, 'image_key' => 'microscope-slides'],
            ['title' => 'Kit ADN Extraction Fraise', 'desc' => 'Extraction ADN visible. Tubes, filtre, éthanol, savon, sel. Protocole illustré. 12+ ans.', 'price' => 150, 'stock' => 40, 'image_key' => 'dna-kit'],
            ['title' => 'Station Météo Sans Fil', 'desc' => 'Température int/ext, hygrométrie, pression, prévisions, phases lune. Sonde ext 100m. Alarme.', 'price' => 320, 'stock' => 30, 'image_key' => 'weather-station'],
        ],
        'Langues Étrangères' => [
            ['title' => 'Assimil Anglais Débutant Livre+CD', 'desc' => '100 leçons progressives. 30 min/jour. Audio natifs. Grammaire, vocabulaire, dialogues. Niveau A1-A2.', 'price' => 280, 'stock' => 40, 'image_key' => 'assimil-english'],
            ['title' => 'Assimil Espagnol Livre+CD', 'desc' => 'Même méthode Assimil pour l\'espagnol. 100 leçons. Audio natifs. Niveau A1-B1.', 'price' => 280, 'stock' => 35, 'image_key' => 'assimil-spanish'],
            ['title' => 'Assimil Allemand Livre+CD', 'desc' => 'Méthode intuitive. 100 leçons. Audio MP3. Grammaire progressive. Niveau A1-A2.', 'price' => 280, 'stock' => 30, 'image_key' => 'assimil-german'],
            ['title' => 'Dictionnaire Larousse Anglais-Français', 'desc' => '250 000 mots/expressions. Phrases exemples. Phonétique. Annexes grammaire/conjugaison.', 'price' => 220, 'stock' => 50, 'image_key' => 'eng-french-dict'],
            ['title' => 'Dictionnaire Larousse Espagnol-Français', 'desc' => '180 000 mots. Amérique latine/Espagne. Conjugaison, proverbes. Format moyen.', 'price' => 200, 'stock' => 40, 'image_key' => 'spanish-french-dict'],
            ['title' => 'Bescherelle Espagnol Conjugaison', 'desc' => '12 000 verbes. Tous temps/modes. Tables modèles. Verbes irréguliers. Index.', 'price' => 150, 'stock' => 50, 'image_key' => 'bescherelle-spanish'],
            ['title' => 'Vocabulaire Anglais 3000 Mots', 'desc' => '3000 mots par thèmes. Cartes mémo recto-verso. Niveau A1-B2. Application audio.', 'price' => 120, 'stock' => 80, 'image_key' => 'vocab-cards'],
            ['title' => 'Grammaire Anglaise Progressive', 'desc' => 'Niveau intermédiaire B1-B2. 120 leçons. Règles, exceptions, exercices corrigés. Auto-évaluation.', 'price' => 180, 'stock' => 50, 'image_key' => 'english-grammar'],
        ],
        'Informatique et Programmation' => [
            ['title' => 'Ordinateur Portable Étudiant 14"', 'desc' => 'Intel Core i5, 8Go RAM, 256Go SSD. Écran 14" Full HD. Windows 11. Autonomie 8h. 1.4kg.', 'price' => 4500, 'stock' => 20, 'image_key' => 'student-laptop'],
            ['title' => 'Clavier Mécanique RGB', 'desc' => 'Switchs mécaniques Red. Rétroéclairage RGB 16M couleurs. Layout FR AZERTY. Câble tressé détachable.', 'price' => 450, 'stock' => 50, 'image_key' => 'mechanical-keyboard'],
            ['title' => 'Souris Gaming Sans Fil', 'desc' => 'Capteur 16000 DPI. 6 boutons programmables. Autonomie 70h. Récepteur USB 2.4GHz. Poids 85g.', 'price' => 350, 'stock' => 60, 'image_key' => 'gaming-mouse'],
            ['title' => 'Casque Audio USB avec Micro', 'desc' => 'Son stéréo 7.1 virtuel. Micro flexible anti-bruit. Coussinets mousse mémoire. Compatible PC/PS4/PS5.', 'price' => 380, 'stock' => 50, 'image_key' => 'gaming-headset'],
            ['title' => 'Webcam Full HD 1080p', 'desc' => 'Capteur 2MP, autofocus. Micro stéréo intégré. Couvercle vie privée. USB Plug&Play. Clip universel.', 'price' => 280, 'stock' => 60, 'image_key' => 'webcam'],
            ['title' => 'Clé USB 128Go USB 3.2', 'desc' => 'Vitesse lecture 400Mo/s, écriture 200Mo/s. Capuchon rétractable. Garantie 5 ans. USB-A.', 'price' => 120, 'stock' => 100, 'image_key' => 'usb-drive'],
            ['title' => 'Disque Dur Externe 1To SSD', 'desc' => 'NVMe PCIe 3.0. Vitesse 1050Mo/s. USB-C 3.2 Gen2. Choc résistant IP54. Câble USB-C/USB-A.', 'price' => 850, 'stock' => 30, 'image_key' => 'ssd-external'],
            ['title' => 'Hub USB-C 7-en-1', 'desc' => 'HDMI 4K@60Hz, 3x USB-A 3.0, SD/microSD, USB-C PD 100W. Aluminium. Compatible Mac/PC.', 'price' => 350, 'stock' => 50, 'image_key' => 'usb-hub'],
            ['title' => 'Support PC Portable Aluminium', 'desc' => 'Réglable 6 angles. Aluminium anodisé. Pads antidérapants. Ventilation passive. Compatible 11-17".', 'price' => 180, 'stock' => 60, 'image_key' => 'laptop-stand'],
            ['title' => 'Câble HDMI 2.1 3m', 'desc' => '4K@120Hz, 8K@60Hz. 48Gbps. eARC, VRR, ALLM. Connecteurs plaqués or. Tresse nylon.', 'price' => 120, 'stock' => 100, 'image_key' => 'hdmi-cable'],
            ['title' => 'Routeur WiFi 6 AX3000', 'desc' => 'Double bande 2.4/5GHz. 3000Mbps. 4 antennes. OFDMA, MU-MIMO. Port WAN 2.5G. Application mobile.', 'price' => 650, 'stock' => 30, 'image_key' => 'wifi6-router'],
        ],
        'Arts Créatifs' => [
            ['title' => 'Kit Peinture Acrylique 12x20ml', 'desc' => '12 tubes 20ml. Pigments fins. Couleurs primaires + terre, blanc, noir. Tubes refermables.', 'price' => 140, 'stock' => 60, 'image_key' => 'acrylic-paint'],
            ['title' => 'Peinture Gouache 12 Godets', 'desc' => '12 godets 12ml + pinceau. Couleurs vives, couvrantes. Lavable. Palette intégrée. 3+ ans.', 'price' => 75, 'stock' => 100, 'image_key' => 'gouache'],
            ['title' => 'Kit Pâte à Modeler 10 Couleurs', 'desc' => '10 pots 100g. 10 couleurs vives. Ne sèche pas, ne tache pas. Norme CE. 3+ ans.', 'price' => 85, 'stock' => 80, 'image_key' => 'modeling-clay'],
            ['title' => 'Coffret 50 Feutres Coloriage', 'desc' => '50 feutres pointe moy. Encre lavable. Pointes anti-enfoncement. Étui rigide. 3+ ans.', 'price' => 95, 'stock' => 80, 'image_key' => 'markers-50'],
            ['title' => 'Bloc Aquarelle 300g 20F A4', 'desc' => 'Papier 300g grain fin. 20 feuilles blanc naturel. Encollé 4 bords. Idéal aquarelle.', 'price' => 95, 'stock' => 60, 'image_key' => 'watercolor-block'],
            ['title' => 'Toile Coton 30x40cm Lot 5', 'desc' => 'Coton 380g/m². Châssis pin 1.8cm. Encollage universel. Prêtes à peindre. Lot 5.', 'price' => 180, 'stock' => 40, 'image_key' => 'canvas-pack'],
            ['title' => 'Kit Origami 200 Feuilles', 'desc' => '200 feuilles 15x15cm. 20 motifs japonais. Papier 70g. Livret 20 modèles. 8+ ans.', 'price' => 65, 'stock' => 80, 'image_key' => 'origami-pack'],
            ['title' => 'Kit Mosaïque 1000 Pièces', 'desc' => '1000 tesselles 10mm. 12 couleurs. 4 plaques support. Colle, pince, gabarits. 8+ ans.', 'price' => 120, 'stock' => 40, 'image_key' => 'mosaic-kit'],
        ],
    ];

    public static function getTemplates(): array
    {
        return self::$productTemplates;
    }

    private static function img(string $text, string $category = ''): string
    {
        if ($category === 'Livres') {
            $livresImages = [
                'Manuel de Mathématiques'   => 'images/products/books/math-book.jpg',
                'Manuel de Français'        => 'images/products/books/manuel-francais.jpg',
                'Physique-Chimie'           => 'images/products/books/physics-book.jpg',
                'Guide SVT'                 => 'images/products/books/guide-svt.jpg',
                'Bescherelle'               => 'images/products/books/bescherelle.jpg',
                'Atlas Scolaire'            => 'images/products/books/atlas.jpg',
                'Histoire-Géographie'       => 'images/products/books/histoire-geo.jpg',
                'Allemand 1ère Année'       => 'images/products/books/allemand-cahier.jpg',
                'Sésame'                    => 'images/products/books/math-book.jpg',
                'Bled'                      => 'images/products/books/bled.jpg',
                'Dictionnaire Le Robert'    => 'images/products/books/robert-poche.jpg',
                'Larousse Junior'           => 'images/products/books/larousse-junior.jpg',
                'Manuel de Philosophie'     => 'images/products/books/philosophie.jpg',
                'Cahier de Vacances'        => 'images/products/books/cahier-vacances.jpg',
                'Petit Larousse'            => 'images/products/books/petit-larousse.jpg',
            ];
            foreach ($livresImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Fournitures Scolaires') {
            $stationeryImages = [
                'Stylos Bille Bleu'         => 'images/products/stationery/blue-pens.jpg',
                'Stylos Bille Noir'         => 'images/products/stationery/black-pens.jpg',
                'Stylos Bille Rouge'        => 'images/products/stationery/red-pens.jpg',
                'Cahier 200 Pages'          => 'images/products/stationery/notebook-large.jpg',
                'Cahier 96 Pages'           => 'images/products/stationery/notebook-96.jpg',
                'Cahier Spirale'            => 'images/products/stationery/spiral-notebook.jpg',
                'Classeur 4 Anneaux'        => 'images/products/stationery/binder.jpg',
                'Dossiers Suspendus'        => 'images/products/stationery/hanging-folders.jpg',
                'Marqueurs Fluorescents'    => 'images/products/stationery/highlighters.jpg',
                'Correcteur Liquide'        => 'images/products/stationery/correction-fluid.jpg',
                'Roller Correcteur'         => 'images/products/stationery/correction-tape.jpg',
                'Agenda Scolaire'           => 'images/products/stationery/agenda.jpg',
                'Feuilles Quadrillées'      => 'images/products/stationery/grid-paper.jpg',
                'Feuilles Unies'            => 'images/products/stationery/lined-paper.jpg',
                'Trousse Scolaire'          => 'images/products/stationery/pencil-case.jpg',
                'Crayons à Papier HB'       => 'images/products/stationery/pencils-hb.jpg',
                'Crayons de Couleur'        => 'images/products/stationery/color-pencils.jpg',
                'Feutres Fins'              => 'images/products/stationery/fine-markers.jpg',
                'Gomme Blanche'             => 'images/products/stationery/erasers.jpg',
                'Taille-Crayon'             => 'images/products/stationery/sharpener.jpg',
                'Règle Plate'               => 'images/products/stationery/ruler.jpg',
                'Équerre 26cm'              => 'images/products/stationery/set-square.jpg',
                'Compas de Précision'       => 'images/products/stationery/compass.jpg',
                'Ciseaux Scolaires'         => 'images/products/stationery/scissors.jpg',
                'Colle Bâton'               => 'images/products/stationery/glue-sticks.jpg',
                'Colle Liquide'             => 'images/products/stationery/liquid-glue.jpg',
                'Ramette A4'                => 'images/products/stationery/a4-paper.jpg',
                'Sac à Dos Scolaire'        => 'images/products/stationery/backpack.jpg',
                'Boîte 24 Feutres'          => 'images/products/stationery/fine-markers.jpg',
            ];
            foreach ($stationeryImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Papeterie') {
            $officeImages = [
                'Ramette A4'              => 'images/products/office/ramette-a4.jpg',
                'Ramette A3'              => 'images/products/office/ramette-a3.jpg',
                'Bloc-Notes Autocollants' => 'images/products/office/bloc-notes.jpg',
                'Carnet Notes'            => 'images/products/office/carnet-notes.jpg',
                'Cahier Réunion'          => 'images/products/office/cahier-reunion.jpg',
                'Enveloppes Kraft'        => 'images/products/office/enveloppes-kraft.jpg',
                'Enveloppes Blanches'     => 'images/products/office/enveloppes-blanches.jpg',
                'Classeur 2 Anneaux'      => 'images/products/office/classeur-anneaux.jpg',
                'Chemises Cartonnées'     => 'images/products/office/chemises-cartonnes.jpg',
                'Intercalaires'           => 'images/products/office/intercalaires.jpg',
                'Pochettes Perforées'     => 'images/products/office/pochettes-perforees.jpg',
            ];
            foreach ($officeImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Manuels Universitaires') {
            $uniImages = [
                'Comptabilité Générale'          => 'images/products/universitaire/comptabilite-generale.jpg',
                'Droit des Affaires'             => 'images/products/universitaire/droit-des-affaires.jpg',
                'Algorithmique et Programmation' => 'images/products/universitaire/algorithmique-python.jpg',
                'Introduction à l\'Économie'     => 'images/products/universitaire/introduction-economie.jpg',
                'Droit Constitutionnel'          => 'images/products/universitaire/droit-constitutionnel.jpg',
                'Psychologie Cognitive'          => 'images/products/universitaire/psychologie-cognitive.jpg',
                'Marketing Fondamentaux'         => 'images/products/universitaire/marketing-fondamentaux.jpg',
                'Statistiques pour Sciences'     => 'images/products/universitaire/statistiques-sociales.jpg',
                'Biochimie Structurale'          => 'images/products/universitaire/biochimie-structurale.jpg',
                'Gestion des Ressources'         => 'images/products/universitaire/gestion-rh.jpg',
            ];
            foreach ($uniImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Arts Créatifs') {
            $artImages = [
                'Peinture Acrylique'    => 'images/products/arts-creatifs/peinture-acrylique.jpg',
                'Gouache'               => 'images/products/arts-creatifs/gouache-godets.jpg',
                'Pâte à Modeler'        => 'images/products/arts-creatifs/pate-modeler.jpg',
                'Coffret 50 Feutres'    => 'images/products/arts-creatifs/coffret-feutres.jpg',
                'Bloc Aquarelle'        => 'images/products/arts-creatifs/bloc-aquarelle.jpg',
                'Toile Coton'           => 'images/products/arts-creatifs/toile-coton.jpg',
                'Kit Origami'           => 'images/products/arts-creatifs/kit-origami.jpg',
                'Kit Mosaïque'          => 'images/products/arts-creatifs/kit-mosaique.jpg',
            ];
            foreach ($artImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Calculatrices') {
            $calcImages = [
                'Casio FX-92'       => 'images/products/calculatrices/casio-fx-92.jpg',
                'Casio Graph 90'    => 'images/products/calculatrices/casio-graph-90e.jpg',
                'Texas TI-30X'      => 'images/products/calculatrices/ti-30x-pro.jpg',
                'NumWorks N0100'    => 'images/products/calculatrices/numworks-n0100.jpg',
                'Bureau 12 Chiffres'=> 'images/products/calculatrices/calculatrice-bureau.jpg',
                'HP 10bII'          => 'images/products/calculatrices/hp-10bii-plus.jpg',
                'Poche 8 Chiffres'  => 'images/products/calculatrices/calculatrice-poche.jpg',
            ];
            foreach ($calcImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Kits Pédagogiques') {
            $kitImages = [
                'Kit Chimie - 50'               => 'images/products/kits-pedagogiques/kit-chimie-50.jpg',
                'Kit Robotique Solaire'         => 'images/products/kits-pedagogiques/kit-robotique-solaire.jpg',
                'Kit Robotique Programmable'    => 'images/products/kits-pedagogiques/mbot-robot.jpg',
                'Kit Micro:bit'                 => 'images/products/kits-pedagogiques/microbit-v2-go.jpg',
                'Kit Arduino'                   => 'images/products/kits-pedagogiques/arduino-starter.jpg',
                'Kit Corps Humain'              => 'images/products/kits-pedagogiques/corps-humain.jpg',
                'Squelette Humain'              => 'images/products/kits-pedagogiques/squelette-humain.jpg',
                'Globe Terrestre'               => 'images/products/kits-pedagogiques/globe-terrestre.jpg',
                'Microscope Optique'            => 'images/products/kits-pedagogiques/microscope-40x-1000x.jpg',
                'Télescope Réfracteur'          => 'images/products/kits-pedagogiques/telescope-70mm.jpg',
                'Balance Précision'             => 'images/products/kits-pedagogiques/balance-precision.jpg',
                'Kit Énergie Renouvelable'      => 'images/products/kits-pedagogiques/kit-energie-renouvelable.jpg',
            ];
            foreach ($kitImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Langues Étrangères') {
            $langImages = [
                'Assimil Anglais Débutant'          => 'images/products/langues/assimil-anglais-debutant.jpg',
                'Assimil Espagnol'                  => 'images/products/langues/assimil-espagnol.jpg',
                'Assimil Allemand'                  => 'images/products/langues/assimil-allemand.jpg',
                'Dictionnaire Larousse Anglais'     => 'images/products/langues/larousse-anglais.jpg',
                'Dictionnaire Larousse Espagnol'    => 'images/products/langues/larousse-espagnol.jpg',
                'Bescherelle Espagnol'              => 'images/products/langues/bescherelle-espagnol.jpg',
                'Vocabulaire Anglais'               => 'images/products/langues/vocabulaire-anglais.jpg',
                'Grammaire Anglaise'                => 'images/products/langues/grammaire-anglaise.jpg',
            ];
            foreach ($langImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Matériel de Classe') {
            $classImages = [
                'Tableau Velleda 120x90cm'      => 'images/products/materiel-classe/tableau-velleda-120x90.jpg',
                'Tableau Velleda Mobile'        => 'images/products/materiel-classe/tableau-velleda-mobile.jpg',
                'Ardoises Velleda'              => 'images/products/materiel-classe/ardoises-velleda.jpg',
                'Feutres Tableau'               => 'images/products/materiel-classe/feutres-tableau.jpg',
                'Effaceur Tableau'              => 'images/products/materiel-classe/effaceur-tableau.jpg',
                'Horloge Murale'                => 'images/products/materiel-classe/horloge-pedagogique.jpg',
                'Tableau Affichage Liège'       => 'images/products/materiel-classe/tableau-affichage-liege.jpg',
                'Pupitre Professeur'            => 'images/products/materiel-classe/pupitre-professeur.jpg',
                'Compteur Présence'             => 'images/products/materiel-classe/compteur-presence.jpg',
                'Mallette Enseignant'           => 'images/products/materiel-classe/mallette-enseignant.jpg',
            ];
            foreach ($classImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Sciences et Expériences') {
            $sciImages = [
                'Microscope Optique'            => 'images/products/sciences/microscope-optique.jpg',
                'Télescope 70mm/700mm'          => 'images/products/sciences/telescope-70mm-700mm.jpg',
                'Kit Chimie Volcans'            => 'images/products/sciences/chimie-volcans.jpg',
                'Kit Énergie Solaire'           => 'images/products/sciences/kit-energie-solaire.jpg',
                'Loupe Binoculaire'             => 'images/products/sciences/loupe-binoculaire.jpg',
                'Thermomètre Laboratoire'       => 'images/products/sciences/thermometre-laboratoire.jpg',
                'Lames Microscope'              => 'images/products/sciences/lames-microscope.jpg',
                'Kit ADN'                       => 'images/products/sciences/kit-adn-extraction.jpg',
                'Station Météo'                 => 'images/products/sciences/station-meteo.jpg',
            ];
            foreach ($sciImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Informatique et Programmation') {
            $infoImages = [
                'Ordinateur Portable'   => 'images/products/informatique/pc-portable-etudiant.jpg',
                'Clavier Mécanique'     => 'images/products/informatique/clavier-mecanique.jpg',
                'Souris Gaming'         => 'images/products/informatique/souris-gaming.jpg',
                'Casque Audio'          => 'images/products/informatique/casque-audio-usb.jpg',
                'Webcam Full HD'        => 'images/products/informatique/webcam-full-hd.jpg',
                'Clé USB'               => 'images/products/informatique/cle-usb-128go.jpg',
                'Disque Dur Externe'    => 'images/products/informatique/ssd-externe-1to.jpg',
                'Hub USB-C'             => 'images/products/informatique/hub-usb-c.jpg',
                'Support PC Portable'   => 'images/products/informatique/support-pc-aluminium.jpg',
                'Câble HDMI'            => 'images/products/informatique/cable-hdmi.jpg',
                'Routeur WiFi'          => 'images/products/informatique/routeur-wifi-6.jpg',
            ];
            foreach ($infoImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Outils de Dessin') {
            $drawImages = [
                'Crayons de Couleur Artiste'    => 'images/products/outils-dessin/crayons-artiste.jpg',
                'Crayons Aquarelle'             => 'images/products/outils-dessin/crayons-aquarelle.jpg',
                'Bloc Dessin A3'                => 'images/products/outils-dessin/bloc-dessin-a3-180g.jpg',
                'Bloc Aquarelle A4'             => 'images/products/outils-dessin/bloc-aquarelle-20f.jpg',
                'Feutres Artistiques'           => 'images/products/outils-dessin/feutres-artistiques.jpg',
                'Marqueurs Posca'               => 'images/products/outils-dessin/posca-marqueurs.jpg',
                'Pastels Secs'                  => 'images/products/outils-dessin/pastels-secs.jpg',
                'Pastels à l\'Huile'            => 'images/products/outils-dessin/pastels-huile.jpg',
                'Gomme Mie de Pain'             => 'images/products/outils-dessin/gomme-mie-pain.jpg',
                'Carnet Croquis'                => 'images/products/outils-dessin/carnet-croquis.jpg',
                'Compas de Précision Grand'     => 'images/products/outils-dessin/compas-grand-modele.jpg',
                'Règle 30cm'                    => 'images/products/outils-dessin/set-geometrie.jpg',
                'Toile Peinture 40x50cm'        => 'images/products/outils-dessin/toile-peinture-40x50.jpg',
                'Kit Peinture Acrylique'        => 'images/products/outils-dessin/peinture-acrylique.jpg',
                'Kit Gouache'                   => 'images/products/outils-dessin/kit-gouache.jpg',
            ];
            foreach ($drawImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        $colors = [
            'Livres'                    => '2563EB',
            'Manuels Universitaires'    => '1D4ED8',
            'Fournitures Scolaires'     => '16A34A',
            'Calculatrices'             => '9333EA',
            'Outils de Dessin'          => 'D97706',
            'Kits Pédagogiques'         => 'DC2626',
            'Papeterie'                 => '0891B2',
            'Matériel de Classe'        => 'EA580C',
            'Sciences et Expériences'   => '0D9488',
            'Langues Étrangères'        => 'A21CAF',
            'Informatique et Programmation' => '4F46E5',
            'Arts Créatifs'             => 'DB2777',
        ];
        $color = $colors[$category] ?? '6B7280';
        $encoded = urlencode($text);
        return "https://placehold.co/400x300/{$color}/white?text={$encoded}&font=raleway";
    }

    public function definition(): array
    {
        // This should never be called if seeder works correctly, but fallback just in case
        $fallbackTitles = [
            'Cahier A4 100 Pages', 'Stylo Bille Bleu', 'Crayon HB', 'Gomme Blanche',
            'Règle 30cm', 'Ciseaux Scolaires', 'Colle Stick', 'Trousse Scolaire',
            'Calculatrice Scientifique', 'Cahier 100 Pages', 'Lot 10 Stylos',
            'Classeur A4', 'Ramette A4', 'Trousse 2 Compartiments',
        ];
        $title = fake()->randomElement($fallbackTitles);
        
        return [
            'title' => $title,
            'slug' => fn (array $attrs) => Str::slug($attrs['title']),
            'description' => 'Produit éducatif de qualité pour étudiants et enseignants.',
            'price' => fake()->randomFloat(2, 10, 500),
            'stock' => fake()->numberBetween(10, 100),
            'image' => fn (array $attrs) => "https://placehold.co/400x300/6B7280/white?text=" . urlencode($attrs['title']) . "&font=raleway",
            'status' => 'active',
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }

    public function forCategory(Category $category, ?array $template = null): static
    {
        if ($template) {
            return $this->state([
                'title' => $template['title'],
                'description' => $template['desc'],
                'price' => $template['price'],
                'stock' => $template['stock'],
                'image' => self::img($template['title'], $category->name),
                'category_id' => $category->id,
            ]);
        }

        // Fallback with category-appropriate defaults
        return $this->state([
            'category_id' => $category->id,
        ]);
    }
}