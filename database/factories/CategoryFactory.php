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
        'University Textbooks' => 'Complete textbooks and academic references covering a wide range of university disciplines: economics, law, computer science, psychology, marketing, and natural sciences. Selected to support students throughout their studies and exam preparation.',
        'Creative Arts' => 'Art supplies and creative hobbies for personal expression: painting kits, modeling clay, origami paper, mosaic tiles, watercolor blocks, canvases, and coloring markers. Ideal for students, hobbyists, and professional artists.',
        'Calculators' => 'A comprehensive selection of scientific, graphing, financial, and desktop calculators from top brands: Casio, Texas Instruments, HP, and NumWorks. Suitable for courses, exams, and professional work.',
        'Educational Kits' => 'Interactive educational kits for fun and engaging learning. Robots, chemistry labs, microscopes, telescopes, anatomical models, and renewable energy experiments to spark scientific curiosity.',
        'Foreign Languages' => 'Learning resources and reference works for English, Spanish, German, and other foreign languages. Dictionaries, grammar guides, vocabulary workbooks, and audio methods from the most renowned publishers.',
        'Stationery' => 'Essential office supplies and paper items: reams, notebooks, envelopes, binders, cardboard folders, dividers, sticky notes, and sheet protectors. Quality materials for professional and academic use.',
        'Classroom Equipment' => 'Educational equipment and tools designed for teachers. Whiteboards, display boards, lecterns, attendance trackers, educational clocks, and presentation aids to create an effective learning environment.',
        'School Supplies' => 'School essentials for students of all ages. Pens, pencils, notebooks, erasers, rulers, compasses, scissors, glue, backpacks, pencil cases, and highlighters — everything needed for a successful school year.',
        'Science & Experiments' => 'Scientific equipment and experiment kits for exploring biology, chemistry, physics, and astronomy. Microscopes, telescopes, lab thermometers, weather stations, and DIY kits for science projects.',
        'Books' => 'A collection of educational books for primary and secondary school students. Mathematics, French, history, geography, science, philosophy, and languages with exercise books, dictionaries, and exam preparation guides.',
        'Computing & Programming' => 'Computer hardware, accessories, and programming tools for students and technology enthusiasts. Laptops, mechanical keyboards, mice, webcams, USB drives, networking equipment, and cables — the essentials for a digital workspace.',
        'Drawing Tools' => 'Professional drawing and illustration supplies for artists and design students. Colored pencils, pastels, sketchbooks, geometry sets, acrylic paint, gouache, and canvases for all skill levels.',
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
