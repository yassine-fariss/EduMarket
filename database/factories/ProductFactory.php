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
        'Books' => [
            ['title' => '6th Grade Mathematics Textbook', 'desc' => 'Complete textbook covering the 6th grade mathematics curriculum. Integers, fractions, basic geometry, and statistics. Progressive exercises with detailed solutions.', 'price' => 180, 'stock' => 50, 'image_key' => 'math-book'],
            ['title' => '5th Grade French Textbook', 'desc' => 'Grammar, conjugation, spelling, and writing. Classic and modern literary excerpts, comprehension questions, essay topics.', 'price' => 175, 'stock' => 45, 'image_key' => 'french-book'],
            ['title' => '3rd Grade Physics-Chemistry Workbook', 'desc' => 'Over 200 corrected exercises on electricity, mechanics, and chemistry. Aligned with the official curriculum with color diagrams.', 'price' => 120, 'stock' => 60, 'image_key' => 'physics-book'],
            ['title' => 'SVT Guide - Life and Earth Sciences', 'desc' => 'Reference for teaching life and earth sciences. Plant and animal biology, ecology, geology. Detailed illustrations and summary sheets.', 'price' => 190, 'stock' => 40, 'image_key' => 'svt-book'],
            ['title' => 'Bescherelle - Conjugation for Everyone', 'desc' => 'Complete conjugation of French verbs in all tenses. Clear tables, agreement rules, lists of irregular verbs.', 'price' => 150, 'stock' => 80, 'image_key' => 'bescherelle'],
            ['title' => 'World School Atlas', 'desc' => 'Detailed physical and political maps of all continents. Updated demographic and economic data. Complete index.', 'price' => 220, 'stock' => 35, 'image_key' => 'atlas'],
            ['title' => '4th Grade History-Geography Textbook', 'desc' => 'Modern history, human geography. Source documents, timelines, case studies for the brevet exam.', 'price' => 165, 'stock' => 55, 'image_key' => 'history-book'],
            ['title' => 'German 1st Year - Activity Workbook', 'desc' => 'Progressive introduction to German. Illustrated vocabulary, simple dialogues, grammar exercises, language games.', 'price' => 130, 'stock' => 45, 'image_key' => 'german-book'],
            ['title' => 'Sesame - Terminal S Math', 'desc' => 'Complete preparation for the science baccalaureate. Detailed lessons, practice exercises, corrected exam topics.', 'price' => 250, 'stock' => 30, 'image_key' => 'math-advanced'],
            ['title' => 'Bled - Spelling and Grammar', 'desc' => 'Reference for mastering French spelling. Rules explained simply with concrete examples.', 'price' => 140, 'stock' => 70, 'image_key' => 'bled'],
            ['title' => 'Le Robert Pocket Dictionary', 'desc' => '60,000 words, 100,000 definitions. Conjugation, etymology, synonyms. Convenient pocket format.', 'price' => 180, 'stock' => 50, 'image_key' => 'dictionary'],
            ['title' => 'Larousse Junior - Children\'s Dictionary', 'desc' => '30,000 words, simple definitions, illustrations. For ages 7-11. Conjugation, grammar.', 'price' => 195, 'stock' => 40, 'image_key' => 'child-dictionary'],
            ['title' => 'Terminal Philosophy Textbook', 'desc' => 'Official curriculum: subject, culture, reason, politics, morality. Author texts, analyses, bac exam topics.', 'price' => 200, 'stock' => 35, 'image_key' => 'philosophy-book'],
            ['title' => 'CM2 to 6th Grade Vacation Workbook', 'desc' => 'Complete review of the CM2 curriculum. French, math, English, discovery of the world. Fun games and exercises.', 'price' => 85, 'stock' => 100, 'image_key' => 'vacation-workbook'],
            ['title' => 'Petit Larousse Illustrated 2025', 'desc' => '65,000 words, 28,000 proper names. Reference encyclopedia. Annual updated edition.', 'price' => 350, 'stock' => 25, 'image_key' => 'larousse'],
        ],
        'University Textbooks' => [
            ['title' => 'Introduction to Economics', 'desc' => 'Microeconomic and macroeconomic principles. Markets, economic policies, inflation, unemployment. Concrete examples.', 'price' => 320, 'stock' => 30, 'image_key' => 'economics-book'],
            ['title' => 'Constitutional Law - L1 Law', 'desc' => 'State theory, separation of powers, constitution, constitutional justice. Major case law.', 'price' => 280, 'stock' => 40, 'image_key' => 'law-book'],
            ['title' => 'Algorithms and Programming - Python', 'desc' => 'Data structures, sorting algorithms, recursion, OOP. Corrected exercises, practical projects.', 'price' => 350, 'stock' => 35, 'image_key' => 'python-book'],
            ['title' => 'Structural and Metabolic Biochemistry', 'desc' => 'Proteins, carbohydrates, lipids, nucleic acids. Metabolic pathways, enzyme regulation. Detailed diagrams.', 'price' => 420, 'stock' => 25, 'image_key' => 'biochemistry-book'],
            ['title' => 'Statistics for Social Sciences', 'desc' => 'Descriptive statistics, probability, hypothesis testing, linear regression. SPSS/R applications.', 'price' => 380, 'stock' => 30, 'image_key' => 'stats-book'],
            ['title' => 'Cognitive Psychology', 'desc' => 'Memory, attention, language, reasoning. Classic and recent theories. Key experiments.', 'price' => 340, 'stock' => 35, 'image_key' => 'psychology-book'],
            ['title' => 'Marketing Fundamentals', 'desc' => 'Marketing mix, segmentation, consumer behavior, brand, digital. Real company case studies.', 'price' => 360, 'stock' => 30, 'image_key' => 'marketing-book'],
            ['title' => 'Business Law', 'desc' => 'Companies, commercial contracts, competition, intellectual property. Annotated commercial code.', 'price' => 320, 'stock' => 35, 'image_key' => 'business-law'],
            ['title' => 'General Accounting', 'desc' => 'Chart of accounts, entries, balance sheet, income statement, VAT. Progressive corrected exercises.', 'price' => 290, 'stock' => 40, 'image_key' => 'accounting-book'],
            ['title' => 'Human Resources Management', 'desc' => 'Recruitment, training, evaluation, compensation, labor law. Modern HR tools.', 'price' => 340, 'stock' => 30, 'image_key' => 'hr-book'],
        ],
        'School Supplies' => [
            ['title' => 'Pack of 10 Blue Ballpoint Pens', 'desc' => 'Professional quality blue ink ballpoint pens. 0.7mm tip, smooth writing. Non-slip ergonomic body.', 'price' => 45, 'stock' => 200, 'image_key' => 'blue-pens'],
            ['title' => 'Pack of 10 Black Ballpoint Pens', 'desc' => 'Black ink ballpoint pens. 0.7mm tip, quick drying. Ideal for exams and competitions.', 'price' => 45, 'stock' => 200, 'image_key' => 'black-pens'],
            ['title' => 'Pack of 10 Red Ballpoint Pens', 'desc' => 'Red ink ballpoint pens. 0.7mm tip. Correction, annotation, highlighting.', 'price' => 45, 'stock' => 150, 'image_key' => 'red-pens'],
            ['title' => '200-Page Large Notebook', 'desc' => '21x29.7cm format, spiral bound. 200 pages, 90g/m² anti-bleed paper. Hardcover.', 'price' => 35, 'stock' => 150, 'image_key' => 'notebook-200'],
            ['title' => '96-Page Small Notebook', 'desc' => '17x22cm format, 96 pages. 90g/m² paper. Colorful soft cover. Ideal for primary school.', 'price' => 18, 'stock' => 300, 'image_key' => 'notebook-96'],
            ['title' => '140-Page Spiral Notebook', 'desc' => 'A4 format, 140 pages. Durable spiral binding. 90g/m² paper. Pre-printed margin.', 'price' => 28, 'stock' => 200, 'image_key' => 'spiral-notebook'],
            ['title' => 'A4 4-Ring Binder', 'desc' => 'Lever-arch file with 4 rings, 5cm spine. 300-sheet capacity. Transparent polypropylene. Customizable spine.', 'price' => 55, 'stock' => 80, 'image_key' => 'binder'],
            ['title' => 'Pack of 10 Hanging Folders', 'desc' => 'A4 suspension filing folders. Metal reinforcement, identifiable tabs. Assorted colors.', 'price' => 65, 'stock' => 100, 'image_key' => 'hanging-folders'],
            ['title' => 'Set of 5 Fluorescent Highlighters', 'desc' => 'Bleed-free fluorescent highlighters. Yellow, pink, green, orange, blue. Beveled tip 1-4mm.', 'price' => 35, 'stock' => 250, 'image_key' => 'highlighters'],
            ['title' => 'Correction Fluid 15ml', 'desc' => 'Quick-drying white correction fluid. Precision brush applicator. Covers black and blue ink.', 'price' => 18, 'stock' => 200, 'image_key' => 'correction-fluid'],
            ['title' => 'Correction Tape Roller 5mm x 8m', 'desc' => 'White correction tape. Clean application, immediate rewriting. Refillable.', 'price' => 25, 'stock' => 150, 'image_key' => 'correction-tape'],
            ['title' => 'School Diary 2025-2026', 'desc' => 'Daily and weekly pages. Sept 2025 - June 2026. Timetable, notes, directory.', 'price' => 55, 'stock' => 200, 'image_key' => 'agenda'],
            ['title' => 'Pack of 100 Grid Sheets', 'desc' => 'A4 21x29.7cm format. 5x5mm grid. 80g/m² paper. 4-hole punched.', 'price' => 25, 'stock' => 300, 'image_key' => 'grid-paper'],
            ['title' => 'Pack of 100 Plain Sheets', 'desc' => 'A4 format. White 80g/m² paper. 4-hole punched. Left margin. 100-sheet pack.', 'price' => 22, 'stock' => 300, 'image_key' => 'lined-paper'],
            ['title' => '2-Compartment Pencil Case', 'desc' => 'Polyester fabric 25x12cm. 2 zippers, inner mesh pockets. 40-pen capacity. Various colors.', 'price' => 85, 'stock' => 120, 'image_key' => 'pencil-case'],
            ['title' => 'Pack of 12 HB Graphite Pencils', 'desc' => 'HB graphite pencils. Durable 2.2mm lead. Certified cedar wood. Built-in eraser.', 'price' => 30, 'stock' => 250, 'image_key' => 'pencils-hb'],
            ['title' => 'Pack of 12 Colored Pencils', 'desc' => 'Soft 3.3mm leads. Bright, blendable colors. Reinforced cardboard case. CE standard.', 'price' => 55, 'stock' => 150, 'image_key' => 'color-pencils'],
            ['title' => 'Box of 24 Fine Markers', 'desc' => 'Fine tip 0.4mm markers. Washable ink. 24 colors. Ventilated safety cap.', 'price' => 65, 'stock' => 120, 'image_key' => 'fine-markers'],
            ['title' => 'White Eraser Pack of 5', 'desc' => 'High-quality erasers. Clean erasing without marks. Size 40x20x12mm. PVC-free.', 'price' => 20, 'stock' => 200, 'image_key' => 'erasers'],
            ['title' => 'Dual Metal Sharpener', 'desc' => 'Dual holes for standard and large pencils. Stainless steel blade. Transparent reservoir. Fixing screw.', 'price' => 15, 'stock' => 200, 'image_key' => 'sharpener'],
            ['title' => '30cm Transparent Flat Ruler', 'desc' => 'Unbreakable PMMA ruler. Precise mm/cm graduations. Beveled edges. Non-slip surface.', 'price' => 12, 'stock' => 300, 'image_key' => 'ruler'],
            ['title' => '26cm Set Square + 180° Protractor', 'desc' => 'Geometry set: 26cm set square, 180° protractor. Transparent PMMA. Laser graduations.', 'price' => 22, 'stock' => 200, 'image_key' => 'set-square'],
            ['title' => 'Metal Precision Compass', 'desc' => 'Stainless steel compass. Micrometric adjustment. Pencil and dry point. Rigid case.', 'price' => 85, 'stock' => 80, 'image_key' => 'compass'],
            ['title' => '13cm School Scissors', 'desc' => 'Round-tip stainless steel blades. Soft ergonomic handles. Ambidextrous. Micro-serrated blade.', 'price' => 18, 'stock' => 250, 'image_key' => 'scissors'],
            ['title' => 'Glue Stick 21g Pack of 3', 'desc' => 'PVP glue sticks. 30s drying time. Clean, non-toxic, washable. Retractable tube.', 'price' => 28, 'stock' => 200, 'image_key' => 'glue-sticks'],
            ['title' => 'Liquid Glue 50ml', 'desc' => 'White vinyl glue. Brush applicator. Strong bonding. Wood, paper, cardboard. Solvent-free.', 'price' => 15, 'stock' => 150, 'image_key' => 'liquid-glue'],
            ['title' => 'A4 Ream 500 Sheets 80g', 'desc' => 'White 80g/m² paper. CIE 161 whiteness. Multifunction printer/copier. PEFC certified.', 'price' => 55, 'stock' => 100, 'image_key' => 'a4-paper'],
            ['title' => '30L School Backpack', 'desc' => 'Waterproof 600D polyester. Padded back, ergonomic straps. 2 main compartments, front pocket.', 'price' => 280, 'stock' => 50, 'image_key' => 'backpack'],
        ],
        'Calculators' => [
            ['title' => 'Casio FX-92+ Scientific Calculator', 'desc' => '276 functions, 4-line display, 15 parenthesis levels. Official exam mode. Solar + battery power.', 'price' => 220, 'stock' => 60, 'image_key' => 'casio-fx92'],
            ['title' => 'Casio Graph 90+E Graphing Calculator', 'desc' => '3.5" color screen, 61KB RAM, 4.5MB Flash. Python, CAS, tables, 3D graphs. Exam mode.', 'price' => 1450, 'stock' => 20, 'image_key' => 'casio-graph90'],
            ['title' => 'Texas TI-30X Pro Scientific Calculator', 'desc' => '4-line display, 417 functions. MathPrint, tables, unit conversions. CR2032 battery included.', 'price' => 280, 'stock' => 40, 'image_key' => 'ti30xpro'],
            ['title' => 'NumWorks N0100 Graphing Calculator', 'desc' => '2.8" color screen, Python, built-in applications. Intuitive interface. LED exam mode.', 'price' => 1350, 'stock' => 25, 'image_key' => 'numworks'],
            ['title' => '12-Digit Desktop Calculator', 'desc' => 'Tiltable 12-digit LCD display. 2-color printer. Memory, %, square root, tax incl. Mains/battery.', 'price' => 380, 'stock' => 30, 'image_key' => 'desk-calculator'],
            ['title' => 'HP 10bII+ Financial Calculator', 'desc' => '120 financial functions. NPV, IRR, amortization, bonds. RPN/algebraic keyboard.', 'price' => 950, 'stock' => 15, 'image_key' => 'hp10bii'],
            ['title' => '8-Digit Pocket Calculator', 'desc' => 'Credit card size. 4 operations, %, square root, memory. Dual solar power. Rigid case.', 'price' => 45, 'stock' => 100, 'image_key' => 'pocket-calculator'],
        ],
        'Drawing Tools' => [
            ['title' => 'Kit of 12 Artist Colored Pencils', 'desc' => 'Soft 3.8mm leads, pure pigments. 12 intense, blendable colors. Metal tin.', 'price' => 120, 'stock' => 80, 'image_key' => 'artist-pencils'],
            ['title' => 'Kit of 24 Watercolor Pencils', 'desc' => 'Water-soluble leads. 24 shades. 3.3mm tip. Dry or wet application. Metal tin.', 'price' => 180, 'stock' => 50, 'image_key' => 'watercolor-pencils'],
            ['title' => 'A3 Drawing Pad 30 Sheets', 'desc' => '180g/m² fine-grain paper. 30 sheets. Ideal for pencil, charcoal, pastel. Hardcover.', 'price' => 85, 'stock' => 80, 'image_key' => 'drawing-pad-a3'],
            ['title' => 'A4 Watercolor Pad 20 Sheets', 'desc' => '300g/m² fine-grain paper. 4-edge glued. 100% cotton. Does not warp.', 'price' => 95, 'stock' => 60, 'image_key' => 'watercolor-pad'],
            ['title' => 'Set of 6 Double-Tip Artist Markers', 'desc' => 'Fine tip 0.4mm + medium tip 1mm. Water-based ink. 6 colors. Airtight cap.', 'price' => 85, 'stock' => 80, 'image_key' => 'artist-markers'],
            ['title' => 'Posca Markers Pack of 8', 'desc' => 'Opaque acrylic paint. Tip 1.8-2.5mm. 8 colors. Multi-surface. Non-toxic.', 'price' => 160, 'stock' => 60, 'image_key' => 'posca-markers'],
            ['title' => 'Artist Soft Pastels 24 Colors', 'desc' => 'Soft pastels, pure pigments. Intense, blendable colors. Wooden case of 24 shades.', 'price' => 140, 'stock' => 50, 'image_key' => 'soft-pastels'],
            ['title' => 'Oil Pastels 24 Colors', 'desc' => 'Greasy, opaque pastels. Water-resistant. 24 bright shades. Paper, canvas, wood.', 'price' => 110, 'stock' => 60, 'image_key' => 'oil-pastels'],
            ['title' => 'Kneaded Artist Eraser', 'desc' => 'Soft malleable eraser. Absorbs graphite/charcoal without damaging paper. 5x5cm size.', 'price' => 35, 'stock' => 100, 'image_key' => 'kneaded-eraser'],
            ['title' => 'Pocket Sketchbook 10x15cm', 'desc' => '140g/m² fine-grain paper. 80 pages. Spiral bound. Kraft cover. Fits in pocket.', 'price' => 45, 'stock' => 100, 'image_key' => 'sketchbook-pocket'],
            ['title' => 'Large Precision Compass', 'desc' => 'Steel compass, 18cm arms. Precise central adjustment. Circles up to 35cm. Leather case.', 'price' => 120, 'stock' => 40, 'image_key' => 'large-compass'],
            ['title' => 'Set Ruler 30cm + Set Square 26cm + Protractor', 'desc' => 'Transparent PMMA. 30cm ruler, 26cm 45/60° set square, 180° protractor. Pouch.', 'price' => 35, 'stock' => 150, 'image_key' => 'geometry-set'],
            ['title' => 'Canvas 40x50cm Pack of 3', 'desc' => '380g/m² cotton. 2cm pine wood frame. Universal primer. Ready to paint.', 'price' => 180, 'stock' => 40, 'image_key' => 'canvas-pack'],
            ['title' => 'Acrylic Paint Kit 12 Tubes', 'desc' => '12 tubes of 20ml. Primary colors + shades. Fine pigments. Non-toxic. Resealable tubes.', 'price' => 140, 'stock' => 60, 'image_key' => 'acrylic-set'],
            ['title' => 'Gouache Kit 12 Colors + Brushes', 'desc' => '12 pans of 12ml + 3 synthetic brushes. Bright, washable colors. Built-in palette.', 'price' => 85, 'stock' => 80, 'image_key' => 'gouache-set'],
        ],
        'Educational Kits' => [
            ['title' => 'Chemistry Kit - 50 Experiments', 'desc' => 'Complete lab: tubes, beaker, pipettes, goggles, safe chemicals. 50 experiments. 48-page booklet.', 'price' => 350, 'stock' => 25, 'image_key' => 'chemistry-kit'],
            ['title' => '12-in-1 Solar Robotics Kit', 'desc' => '12 solar-powered robots to build. Solar panel, motor, gears. Illustrated manual. Ages 10+.', 'price' => 280, 'stock' => 30, 'image_key' => 'solar-robot'],
            ['title' => 'mBot Programmable Robotics Kit', 'desc' => 'Arduino programmable robot with Scratch/Python. Sensors: ultrasonic, line, light. Bluetooth. Ages 8+.', 'price' => 850, 'stock' => 15, 'image_key' => 'mbot'],
            ['title' => 'Micro:bit V2 Go Kit', 'desc' => 'BBC microcontroller. 5x5 LED matrix, buttons, accelerometer, compass, Bluetooth, radio. Battery included.', 'price' => 320, 'stock' => 30, 'image_key' => 'microbit'],
            ['title' => 'Arduino Uno R3 Starter Kit', 'desc' => 'Arduino Uno R3, breadboard, LEDs, resistors, sensors, motors, wires. 15 tutorial projects.', 'price' => 420, 'stock' => 25, 'image_key' => 'arduino-starter'],
            ['title' => 'Human Anatomy Model Kit', 'desc' => '45cm model, 30 removable parts. Skeleton, organs, muscles, vessels. Rotating base. Anatomy guide.', 'price' => 280, 'stock' => 30, 'image_key' => 'anatomy-model'],
            ['title' => '85cm Human Skeleton on Stand', 'desc' => 'Complete anatomical skeleton. Movable joints. Opening skull. Metal stand with wheels. Manual.', 'price' => 850, 'stock' => 10, 'image_key' => 'skeleton-model'],
            ['title' => '30cm Illuminated Globe', 'desc' => 'Physical/political globe. Internal LED lighting. Countries, capitals, meridians. Metal base.', 'price' => 350, 'stock' => 25, 'image_key' => 'globe'],
            ['title' => 'Optical Microscope 40x-1000x', 'desc' => '3 objectives 4x/10x/40x. Eyepiece 10x/25x. Dual LED lighting. Macro/micro focus. Slides included.', 'price' => 550, 'stock' => 20, 'image_key' => 'microscope'],
            ['title' => '70mm/700mm Refractor Telescope', 'desc' => '70mm aperture, 700mm focal length. Equatorial mount, aluminum tripod. 10mm/20mm eyepieces. Moon filter.', 'price' => 850, 'stock' => 12, 'image_key' => 'telescope'],
            ['title' => 'Precision Scale 0.01g / 200g', 'desc' => '0.01g precision, 200g capacity. Flow, tare, counting. Backlit LCD display. External calibration.', 'price' => 420, 'stock' => 20, 'image_key' => 'precision-scale'],
            ['title' => 'Renewable Energy Kit', 'desc' => 'Wind turbine, solar panel, H2 fuel cell, electric car. 20 experiments. Meters included.', 'price' => 480, 'stock' => 20, 'image_key' => 'renewable-kit'],
        ],
        'Stationery' => [
            ['title' => 'A4 Ream 500 Sheets 80g', 'desc' => 'White 80g/m² paper. CIE 161 whiteness. Multifunction. Ream wrapped 500 sheets. PEFC certified.', 'price' => 55, 'stock' => 100, 'image_key' => 'a4-paper'],
            ['title' => 'A3 Ream 500 Sheets 80g', 'desc' => 'A3 format 297x420mm. 500 sheets 80g/m². Whiteness 161. Laser/inkjet printer.', 'price' => 110, 'stock' => 50, 'image_key' => 'a3-paper'],
            ['title' => 'Sticky Notes 75x75mm', 'desc' => '12 pads x 100 sheets. Neon colors. Repositionable adhesive. 100% recycled.', 'price' => 45, 'stock' => 150, 'image_key' => 'sticky-notes'],
            ['title' => '192-Page Hardcover Notebook', 'desc' => 'A5 format. 192 lined pages 90g/m² ivory. Synthetic leather cover. Bookmark, elastic, pocket.', 'price' => 85, 'stock' => 80, 'image_key' => 'hardcover-notebook'],
            ['title' => 'A4 Meeting Notebook 80 Pages', 'desc' => 'Polypro cover. 80 micro-perforated pages. 2 holes. 90g paper. Margin, date/subject header.', 'price' => 35, 'stock' => 100, 'image_key' => 'meeting-notebook'],
            ['title' => 'Kraft A4 Envelopes Pack of 50', 'desc' => 'Brown kraft 120g. Self-adhesive. 45x90mm window. Straight flap. Postal quality.', 'price' => 65, 'stock' => 80, 'image_key' => 'kraft-envelopes'],
            ['title' => 'White DL Envelopes Pack of 100', 'desc' => 'White 90g. Left window. Self-adhesive. DL format 110x220mm. Premium quality.', 'price' => 55, 'stock' => 100, 'image_key' => 'white-envelopes'],
            ['title' => 'A4 2-Ring Binder 30mm', 'desc' => '2 round rings 30mm. Opaque polypro. 1.5mm cover. 250-sheet capacity. 2 inner pockets.', 'price' => 38, 'stock' => 120, 'image_key' => '2-ring-binder'],
            ['title' => 'Cardboard A4 Folders Pack of 50', 'desc' => '250g cardboard. 30mm flap. 3 flaps. Rounded corners. Assorted colors. 30mm spine.', 'price' => 85, 'stock' => 60, 'image_key' => 'cardboard-folders'],
            ['title' => 'A4 Dividers 12 Tabs', 'desc' => 'Translucent polypropylene. 12 numbered tabs 1-12. Reinforced. Universal punching.', 'price' => 25, 'stock' => 150, 'image_key' => 'dividers'],
            ['title' => 'A4 Sheet Protectors Pack of 100', 'desc' => 'Transparent 80µ polypropylene. 11-hole punching. Top opening. 60µ thickness.', 'price' => 45, 'stock' => 100, 'image_key' => 'sheet-protectors'],
        ],
        'Classroom Equipment' => [
            ['title' => 'Whiteboard 120x90cm', 'desc' => 'Vitrified magnetic whiteboard. Anodized aluminum frame. Wall mounting kit. 1 marker + eraser.', 'price' => 450, 'stock' => 20, 'image_key' => 'whiteboard'],
            ['title' => 'Mobile Whiteboard 150x100cm', 'desc' => 'On stand with 4 lockable casters. Double-sided magnetic. Adjustable height 170-190cm.', 'price' => 1200, 'stock' => 8, 'image_key' => 'mobile-whiteboard'],
            ['title' => 'Whiteboard Slates 30x21cm Pack of 30', 'desc' => 'Erasable white slates. Rounded corners. Smooth surface. 30 slates + 30 markers + 30 cloths.', 'price' => 420, 'stock' => 20, 'image_key' => 'slates-pack'],
            ['title' => 'Board Markers Pack of 12 Colors', 'desc' => 'Bullet tip 3mm. Dry-erase ink. 12 colors. Transparent barrel. Ventilated cap.', 'price' => 120, 'stock' => 80, 'image_key' => 'board-markers'],
            ['title' => 'Magnetic Board Eraser', 'desc' => 'Dry-erase eraser. Ergonomic handle. Removable washable felt. Built-in magnet.', 'price' => 45, 'stock' => 100, 'image_key' => 'board-eraser'],
            ['title' => 'Educational Wall Clock 30cm', 'desc' => '12h/24h dial. Colored hour/minute hands. Silent. AA battery included.', 'price' => 120, 'stock' => 60, 'image_key' => 'teaching-clock'],
            ['title' => 'Cork Bulletin Board 90x60cm', 'desc' => 'Natural cork 10mm. Silver aluminum frame. Self-healing. Mounting kit included.', 'price' => 280, 'stock' => 30, 'image_key' => 'cork-board'],
            ['title' => 'Adjustable Teacher Lectern', 'desc' => 'Height 52-76cm. Tiltable surface 0-45°. Epoxy steel structure. Built-in bookrest.', 'price' => 650, 'stock' => 15, 'image_key' => 'teacher-desk'],
            ['title' => 'Magnetic Attendance Tracker 30', 'desc' => 'Panel 45x30cm. 30 photo/name magnets. 3 zones: present/absent/late. Erasable marker.', 'price' => 180, 'stock' => 30, 'image_key' => 'attendance-board'],
            ['title' => 'Teacher Briefcase 40x30cm', 'desc' => '600D polyester. Compartments: 15" laptop, folders, pencil case, bottle. Padded shoulder strap.', 'price' => 320, 'stock' => 30, 'image_key' => 'teacher-bag'],
        ],
        'Science & Experiments' => [
            ['title' => 'Optical Microscope 40x-1000x', 'desc' => '3 achromatic objectives 4x/10x/40x. Wide-field eyepiece 10x/25x. Adjustable LED. 5 prepared slides.', 'price' => 550, 'stock' => 20, 'image_key' => 'microscope'],
            ['title' => 'Telescope 70mm/700mm', 'desc' => '70mm/700mm refractor. EQ equatorial mount. Aluminum tripod. 10/20mm eyepieces. Moon filter. Carry bag.', 'price' => 850, 'stock' => 12, 'image_key' => 'telescope'],
            ['title' => 'Volcano & Crystal Chemistry Kit', 'desc' => 'Volcanic eruptions, crystal growing. 15 experiments. Tubes, funnel, goggles, gloves. Ages 8+.', 'price' => 180, 'stock' => 40, 'image_key' => 'volcano-kit'],
            ['title' => 'Solar Energy Kit', 'desc' => 'Solar car + windmill. 2V/100mAh panel. 1.5V motor. Tool-free assembly. Ages 8+.', 'price' => 180, 'stock' => 50, 'image_key' => 'solar-kit'],
            ['title' => '20x Binocular Loupe', 'desc' => '20x magnification. Rubber eyecups. Central focus. Rigid case. Weight 320g.', 'price' => 220, 'stock' => 40, 'image_key' => 'binoculars'],
            ['title' => 'Lab Thermometer -10/+110°C', 'desc' => 'Glass, red alcohol column. ±1°C accuracy. Length 30cm. Suspension ring.', 'price' => 45, 'stock' => 100, 'image_key' => 'lab-thermometer'],
            ['title' => 'Set of 10 Prepared Microscope Slides', 'desc' => 'Plant/animal tissues, protozoa, bacteria. Glass 26x76mm. Wooden box with 10 compartments.', 'price' => 120, 'stock' => 50, 'image_key' => 'microscope-slides'],
            ['title' => 'Strawberry DNA Extraction Kit', 'desc' => 'Visible DNA extraction. Tubes, filter, ethanol, soap, salt. Illustrated protocol. Ages 12+.', 'price' => 150, 'stock' => 40, 'image_key' => 'dna-kit'],
            ['title' => 'Wireless Weather Station', 'desc' => 'Indoor/outdoor temperature, humidity, pressure, forecasts, moon phases. 100m outdoor sensor. Alarm.', 'price' => 320, 'stock' => 30, 'image_key' => 'weather-station'],
        ],
        'Foreign Languages' => [
            ['title' => 'Assimil English Beginner Book+CD', 'desc' => '100 progressive lessons. 30 min/day. Native audio. Grammar, vocabulary, dialogues. Level A1-A2.', 'price' => 280, 'stock' => 40, 'image_key' => 'assimil-english'],
            ['title' => 'Assimil Spanish Book+CD', 'desc' => 'Same Assimil method for Spanish. 100 lessons. Native audio. Level A1-B1.', 'price' => 280, 'stock' => 35, 'image_key' => 'assimil-spanish'],
            ['title' => 'Assimil German Book+CD', 'desc' => 'Intuitive method. 100 lessons. MP3 audio. Progressive grammar. Level A1-A2.', 'price' => 280, 'stock' => 30, 'image_key' => 'assimil-german'],
            ['title' => 'Larousse English-French Dictionary', 'desc' => '250,000 words/expressions. Example sentences. Phonetics. Grammar/conjugation appendices.', 'price' => 220, 'stock' => 50, 'image_key' => 'eng-french-dict'],
            ['title' => 'Larousse Spanish-French Dictionary', 'desc' => '180,000 words. Latin America/Spain. Conjugation, proverbs. Medium format.', 'price' => 200, 'stock' => 40, 'image_key' => 'spanish-french-dict'],
            ['title' => 'Bescherelle Spanish Conjugation', 'desc' => '12,000 verbs. All tenses/moods. Model tables. Irregular verbs. Index.', 'price' => 150, 'stock' => 50, 'image_key' => 'bescherelle-spanish'],
            ['title' => 'English Vocabulary 3000 Words', 'desc' => '3000 words by theme. Double-sided flash cards. Level A1-B2. Audio app.', 'price' => 120, 'stock' => 80, 'image_key' => 'vocab-cards'],
            ['title' => 'Progressive English Grammar', 'desc' => 'Intermediate level B1-B2. 120 lessons. Rules, exceptions, corrected exercises. Self-assessment.', 'price' => 180, 'stock' => 50, 'image_key' => 'english-grammar'],
        ],
        'Computing & Programming' => [
            ['title' => '14" Student Laptop', 'desc' => 'Intel Core i5, 8GB RAM, 256GB SSD. 14" Full HD screen. Windows 11. 8h battery life. 1.4kg.', 'price' => 4500, 'stock' => 20, 'image_key' => 'student-laptop'],
            ['title' => 'RGB Mechanical Keyboard', 'desc' => 'Red mechanical switches. 16M color RGB backlighting. FR AZERTY layout. Detachable braided cable.', 'price' => 450, 'stock' => 50, 'image_key' => 'mechanical-keyboard'],
            ['title' => 'Wireless Gaming Mouse', 'desc' => '16000 DPI sensor. 6 programmable buttons. 70h battery life. USB 2.4GHz receiver. Weight 85g.', 'price' => 350, 'stock' => 60, 'image_key' => 'gaming-mouse'],
            ['title' => 'USB Headset with Microphone', 'desc' => 'Virtual 7.1 surround sound. Flexible noise-canceling mic. Memory foam ear cushions. Compatible PC/PS4/PS5.', 'price' => 380, 'stock' => 50, 'image_key' => 'gaming-headset'],
            ['title' => 'Full HD 1080p Webcam', 'desc' => '2MP sensor, autofocus. Built-in stereo microphone. Privacy cover. USB Plug&Play. Universal clip.', 'price' => 280, 'stock' => 60, 'image_key' => 'webcam'],
            ['title' => '128GB USB 3.2 Flash Drive', 'desc' => 'Read speed 400MB/s, write 200MB/s. Retractable cap. 5-year warranty. USB-A.', 'price' => 120, 'stock' => 100, 'image_key' => 'usb-drive'],
            ['title' => '1TB External SSD', 'desc' => 'NVMe PCIe 3.0. Speed 1050MB/s. USB-C 3.2 Gen2. Shock resistant IP54. USB-C/USB-A cable.', 'price' => 850, 'stock' => 30, 'image_key' => 'ssd-external'],
            ['title' => '7-in-1 USB-C Hub', 'desc' => 'HDMI 4K@60Hz, 3x USB-A 3.0, SD/microSD, USB-C PD 100W. Aluminum. Compatible Mac/PC.', 'price' => 350, 'stock' => 50, 'image_key' => 'usb-hub'],
            ['title' => 'Aluminum Laptop Stand', 'desc' => 'Adjustable 6 angles. Anodized aluminum. Non-slip pads. Passive ventilation. Compatible 11-17".', 'price' => 180, 'stock' => 60, 'image_key' => 'laptop-stand'],
            ['title' => 'HDMI 2.1 Cable 3m', 'desc' => '4K@120Hz, 8K@60Hz. 48Gbps. eARC, VRR, ALLM. Gold-plated connectors. Nylon braided.', 'price' => 120, 'stock' => 100, 'image_key' => 'hdmi-cable'],
            ['title' => 'WiFi 6 Router AX3000', 'desc' => 'Dual band 2.4/5GHz. 3000Mbps. 4 antennas. OFDMA, MU-MIMO. 2.5G WAN port. Mobile app.', 'price' => 650, 'stock' => 30, 'image_key' => 'wifi6-router'],
        ],
        'Creative Arts' => [
            ['title' => 'Acrylic Paint Kit 12x20ml', 'desc' => '12 tubes of 20ml. Fine pigments. Primary colors + earth, white, black. Resealable tubes.', 'price' => 140, 'stock' => 60, 'image_key' => 'acrylic-paint'],
            ['title' => 'Gouache Paint 12 Pans', 'desc' => '12 pans of 12ml + brush. Bright, opaque colors. Washable. Built-in palette. Ages 3+.', 'price' => 75, 'stock' => 100, 'image_key' => 'gouache'],
            ['title' => 'Modeling Clay Kit 10 Colors', 'desc' => '10 pots of 100g. 10 bright colors. Does not dry out, does not stain. CE standard. Ages 3+.', 'price' => 85, 'stock' => 80, 'image_key' => 'modeling-clay'],
            ['title' => 'Box of 50 Coloring Markers', 'desc' => '50 medium tip markers. Washable ink. Non-push-in tips. Rigid case. Ages 3+.', 'price' => 95, 'stock' => 80, 'image_key' => 'markers-50'],
            ['title' => 'Watercolor Block 300g 20S A4', 'desc' => '300g fine-grain paper. 20 sheets natural white. 4-edge glued. Ideal for watercolor.', 'price' => 95, 'stock' => 60, 'image_key' => 'watercolor-block'],
            ['title' => 'Cotton Canvas 30x40cm Pack of 5', 'desc' => '380g/m² cotton. 1.8cm pine frame. Universal primer. Ready to paint. Pack of 5.', 'price' => 180, 'stock' => 40, 'image_key' => 'canvas-pack'],
            ['title' => 'Origami Kit 200 Sheets', 'desc' => '200 sheets 15x15cm. 20 Japanese patterns. 70g paper. Booklet with 20 models. Ages 8+.', 'price' => 65, 'stock' => 80, 'image_key' => 'origami-pack'],
            ['title' => 'Mosaic Kit 1000 Pieces', 'desc' => '1000 tessellated pieces 10mm. 12 colors. 4 support boards. Glue, tweezers, templates. Ages 8+.', 'price' => 120, 'stock' => 40, 'image_key' => 'mosaic-kit'],
        ],
    ];

    public static function getTemplates(): array
    {
        return self::$productTemplates;
    }

    private static function img(string $text, string $category = ''): string
    {
        if ($category === 'Books') {
            $livresImages = [
                'Mathematics Textbook'          => 'images/products/books/math-book.jpg',
                'French Textbook'               => 'images/products/books/manuel-francais.jpg',
                'Physics-Chemistry'             => 'images/products/books/physics-book.jpg',
                'SVT Guide'                     => 'images/products/books/guide-svt.jpg',
                'Bescherelle'                   => 'images/products/books/bescherelle.jpg',
                'World School Atlas'            => 'images/products/books/atlas.jpg',
                'History-Geography'             => 'images/products/books/histoire-geo.jpg',
                'German 1st Year'               => 'images/products/books/allemand-cahier.jpg',
                'Sesame'                        => 'images/products/books/math-book.jpg',
                'Bled'                          => 'images/products/books/bled.jpg',
                'Le Robert Pocket'              => 'images/products/books/robert-poche.jpg',
                'Larousse Junior'               => 'images/products/books/larousse-junior.jpg',
                'Philosophy Textbook'           => 'images/products/books/philosophie.jpg',
                'Vacation Workbook'             => 'images/products/books/cahier-vacances.jpg',
                'Petit Larousse'                => 'images/products/books/petit-larousse.jpg',
            ];
            foreach ($livresImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'School Supplies') {
            $stationeryImages = [
                'Blue Ballpoint Pen'        => 'images/products/stationery/blue-pens.jpg',
                'Black Ballpoint Pen'       => 'images/products/stationery/black-pens.jpg',
                'Red Ballpoint Pen'         => 'images/products/stationery/red-pens.jpg',
                '200-Page Large Notebook'   => 'images/products/stationery/notebook-large.jpg',
                '96-Page Small Notebook'    => 'images/products/stationery/notebook-96.jpg',
                'Spiral Notebook'           => 'images/products/stationery/spiral-notebook.jpg',
                '4-Ring Binder'             => 'images/products/stationery/binder.jpg',
                'Hanging Folders'           => 'images/products/stationery/hanging-folders.jpg',
                'Fluorescent Highlighter'   => 'images/products/stationery/highlighters.jpg',
                'Correction Fluid'          => 'images/products/stationery/correction-fluid.jpg',
                'Correction Tape'           => 'images/products/stationery/correction-tape.jpg',
                'School Diary'              => 'images/products/stationery/agenda.jpg',
                'Grid Sheets'               => 'images/products/stationery/grid-paper.jpg',
                'Plain Sheets'              => 'images/products/stationery/lined-paper.jpg',
                'Pencil Case'               => 'images/products/stationery/pencil-case.jpg',
                'HB Graphite Pencil'        => 'images/products/stationery/pencils-hb.jpg',
                'Colored Pencil'            => 'images/products/stationery/color-pencils.jpg',
                'Fine Markers'              => 'images/products/stationery/fine-markers.jpg',
                'White Eraser'              => 'images/products/stationery/erasers.jpg',
                'Sharpener'                 => 'images/products/stationery/sharpener.jpg',
                'Flat Ruler'                => 'images/products/stationery/ruler.jpg',
                'Set Square'                => 'images/products/stationery/set-square.jpg',
                'Precision Compass'         => 'images/products/stationery/compass.jpg',
                'School Scissors'           => 'images/products/stationery/scissors.jpg',
                'Glue Stick'                => 'images/products/stationery/glue-sticks.jpg',
                'Liquid Glue'               => 'images/products/stationery/liquid-glue.jpg',
                'A4 Ream'                   => 'images/products/stationery/a4-paper.jpg',
                'School Backpack'           => 'images/products/stationery/backpack.jpg',
                'Box of 24'                 => 'images/products/stationery/fine-markers.jpg',
            ];
            foreach ($stationeryImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Stationery') {
            $officeImages = [
                'A4 Ream'                 => 'images/products/office/ramette-a4.jpg',
                'A3 Ream'                 => 'images/products/office/ramette-a3.jpg',
                'Sticky Notes'            => 'images/products/office/bloc-notes.jpg',
                'Hardcover Notebook'      => 'images/products/office/carnet-notes.jpg',
                'Meeting Notebook'        => 'images/products/office/cahier-reunion.jpg',
                'Kraft Envelopes'         => 'images/products/office/enveloppes-kraft.jpg',
                'White Envelopes'         => 'images/products/office/enveloppes-blanches.jpg',
                '2-Ring Binder'           => 'images/products/office/classeur-anneaux.jpg',
                'Cardboard Folders'       => 'images/products/office/chemises-cartonnes.jpg',
                'Dividers'                => 'images/products/office/intercalaires.jpg',
                'Sheet Protectors'        => 'images/products/office/pochettes-perforees.jpg',
            ];
            foreach ($officeImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'University Textbooks') {
            $uniImages = [
                'General Accounting'             => 'images/products/universitaire/comptabilite-generale.jpg',
                'Business Law'                   => 'images/products/universitaire/droit-des-affaires.jpg',
                'Algorithms and Programming'     => 'images/products/universitaire/algorithmique-python.jpg',
                'Introduction to Economics'      => 'images/products/universitaire/introduction-economie.jpg',
                'Constitutional Law'             => 'images/products/universitaire/droit-constitutionnel.jpg',
                'Cognitive Psychology'           => 'images/products/universitaire/psychologie-cognitive.jpg',
                'Marketing Fundamentals'         => 'images/products/universitaire/marketing-fondamentaux.jpg',
                'Statistics for Social'          => 'images/products/universitaire/statistiques-sociales.jpg',
                'Structural and Metabolic'       => 'images/products/universitaire/biochimie-structurale.jpg',
                'Human Resources'                => 'images/products/universitaire/gestion-rh.jpg',
            ];
            foreach ($uniImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Creative Arts') {
            $artImages = [
                'Acrylic Paint Kit'     => 'images/products/arts-creatifs/peinture-acrylique.jpg',
                'Gouache Paint'         => 'images/products/arts-creatifs/gouache-godets.jpg',
                'Modeling Clay'         => 'images/products/arts-creatifs/pate-modeler.jpg',
                'Coloring Markers'      => 'images/products/arts-creatifs/coffret-feutres.jpg',
                'Watercolor Block'      => 'images/products/arts-creatifs/bloc-aquarelle.jpg',
                'Cotton Canvas'         => 'images/products/arts-creatifs/toile-coton.jpg',
                'Origami Kit'           => 'images/products/arts-creatifs/kit-origami.jpg',
                'Mosaic Kit'            => 'images/products/arts-creatifs/kit-mosaique.jpg',
            ];
            foreach ($artImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Calculators') {
            $calcImages = [
                'Casio FX-92'       => 'images/products/calculatrices/casio-fx-92.jpg',
                'Casio Graph 90'    => 'images/products/calculatrices/casio-graph-90e.jpg',
                'Texas TI-30X'      => 'images/products/calculatrices/ti-30x-pro.jpg',
                'NumWorks N0100'    => 'images/products/calculatrices/numworks-n0100.jpg',
                'Desktop Calculator'=> 'images/products/calculatrices/calculatrice-bureau.jpg',
                'HP 10bII'          => 'images/products/calculatrices/hp-10bii-plus.jpg',
                'Pocket Calculator' => 'images/products/calculatrices/calculatrice-poche.jpg',
            ];
            foreach ($calcImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Educational Kits') {
            $kitImages = [
                'Chemistry Kit'                 => 'images/products/kits-pedagogiques/kit-chimie-50.jpg',
                'Solar Robotics'                => 'images/products/kits-pedagogiques/kit-robotique-solaire.jpg',
                'Programmable Robotics'         => 'images/products/kits-pedagogiques/mbot-robot.jpg',
                'Micro:bit'                     => 'images/products/kits-pedagogiques/microbit-v2-go.jpg',
                'Arduino'                       => 'images/products/kits-pedagogiques/arduino-starter.jpg',
                'Human Anatomy'                 => 'images/products/kits-pedagogiques/corps-humain.jpg',
                'Human Skeleton'                => 'images/products/kits-pedagogiques/squelette-humain.jpg',
                'Globe'                         => 'images/products/kits-pedagogiques/globe-terrestre.jpg',
                'Optical Microscope'            => 'images/products/kits-pedagogiques/microscope-40x-1000x.jpg',
                'Refractor Telescope'           => 'images/products/kits-pedagogiques/telescope-70mm.jpg',
                'Precision Scale'               => 'images/products/kits-pedagogiques/balance-precision.jpg',
                'Renewable Energy'              => 'images/products/kits-pedagogiques/kit-energie-renouvelable.jpg',
            ];
            foreach ($kitImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Foreign Languages') {
            $langImages = [
                'Assimil English'                   => 'images/products/langues/assimil-anglais-debutant.jpg',
                'Assimil Spanish'                   => 'images/products/langues/assimil-espagnol.jpg',
                'Assimil German'                    => 'images/products/langues/assimil-allemand.jpg',
                'Larousse English-French'           => 'images/products/langues/larousse-anglais.jpg',
                'Larousse Spanish-French'           => 'images/products/langues/larousse-espagnol.jpg',
                'Bescherelle Spanish'               => 'images/products/langues/bescherelle-espagnol.jpg',
                'English Vocabulary'                => 'images/products/langues/vocabulaire-anglais.jpg',
                'Progressive English Grammar'       => 'images/products/langues/grammaire-anglaise.jpg',
            ];
            foreach ($langImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Classroom Equipment') {
            $classImages = [
                'Whiteboard 120x90cm'          => 'images/products/materiel-classe/tableau-velleda-120x90.jpg',
                'Mobile Whiteboard'             => 'images/products/materiel-classe/tableau-velleda-mobile.jpg',
                'Whiteboard Slates'             => 'images/products/materiel-classe/ardoises-velleda.jpg',
                'Board Markers'                 => 'images/products/materiel-classe/feutres-tableau.jpg',
                'Board Eraser'                  => 'images/products/materiel-classe/effaceur-tableau.jpg',
                'Educational Wall Clock'        => 'images/products/materiel-classe/horloge-pedagogique.jpg',
                'Cork Bulletin Board'           => 'images/products/materiel-classe/tableau-affichage-liege.jpg',
                'Adjustable Teacher Lectern'    => 'images/products/materiel-classe/pupitre-professeur.jpg',
                'Magnetic Attendance'           => 'images/products/materiel-classe/compteur-presence.jpg',
                'Teacher Briefcase'             => 'images/products/materiel-classe/mallette-enseignant.jpg',
            ];
            foreach ($classImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Science & Experiments') {
            $sciImages = [
                'Optical Microscope'            => 'images/products/sciences/microscope-optique.jpg',
                'Telescope 70mm/700mm'          => 'images/products/sciences/telescope-70mm-700mm.jpg',
                'Volcano & Crystal'             => 'images/products/sciences/chimie-volcans.jpg',
                'Solar Energy'                  => 'images/products/sciences/kit-energie-solaire.jpg',
                'Binocular Loupe'               => 'images/products/sciences/loupe-binoculaire.jpg',
                'Lab Thermometer'               => 'images/products/sciences/thermometre-laboratoire.jpg',
                'Microscope Slides'             => 'images/products/sciences/lames-microscope.jpg',
                'DNA Extraction'                => 'images/products/sciences/kit-adn-extraction.jpg',
                'Wireless Weather Station'      => 'images/products/sciences/station-meteo.jpg',
            ];
            foreach ($sciImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Computing & Programming') {
            $infoImages = [
                'Student Laptop'         => 'images/products/informatique/pc-portable-etudiant.jpg',
                'Mechanical Keyboard'    => 'images/products/informatique/clavier-mecanique.jpg',
                'Gaming Mouse'           => 'images/products/informatique/souris-gaming.jpg',
                'USB Headset'            => 'images/products/informatique/casque-audio-usb.jpg',
                'Full HD Webcam'         => 'images/products/informatique/webcam-full-hd.jpg',
                'USB Flash Drive'        => 'images/products/informatique/cle-usb-128go.jpg',
                'External SSD'           => 'images/products/informatique/ssd-externe-1to.jpg',
                'USB-C Hub'              => 'images/products/informatique/hub-usb-c.jpg',
                'Laptop Stand'           => 'images/products/informatique/support-pc-aluminium.jpg',
                'HDMI Cable'             => 'images/products/informatique/cable-hdmi.jpg',
                'WiFi Router'            => 'images/products/informatique/routeur-wifi-6.jpg',
            ];
            foreach ($infoImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        if ($category === 'Drawing Tools') {
            $drawImages = [
                'Artist Colored Pencil'  => 'images/products/outils-dessin/crayons-artiste.jpg',
                'Watercolor Pencil'      => 'images/products/outils-dessin/crayons-aquarelle.jpg',
                'A3 Drawing Pad'         => 'images/products/outils-dessin/bloc-dessin-a3-180g.jpg',
                'A4 Watercolor Pad'      => 'images/products/outils-dessin/bloc-aquarelle-20f.jpg',
                'Artist Markers'         => 'images/products/outils-dessin/feutres-artistiques.jpg',
                'Posca Markers'          => 'images/products/outils-dessin/posca-marqueurs.jpg',
                'Soft Pastels'           => 'images/products/outils-dessin/pastels-secs.jpg',
                'Oil Pastels'            => 'images/products/outils-dessin/pastels-huile.jpg',
                'Kneaded Eraser'         => 'images/products/outils-dessin/gomme-mie-pain.jpg',
                'Pocket Sketchbook'      => 'images/products/outils-dessin/carnet-croquis.jpg',
                'Large Precision Compass'=> 'images/products/outils-dessin/compas-grand-modele.jpg',
                'Set Ruler 30cm'         => 'images/products/outils-dessin/set-geometrie.jpg',
                'Canvas 40x50cm'         => 'images/products/outils-dessin/toile-peinture-40x50.jpg',
                'Acrylic Paint Kit'      => 'images/products/outils-dessin/peinture-acrylique.jpg',
                'Gouache Kit'            => 'images/products/outils-dessin/kit-gouache.jpg',
            ];
            foreach ($drawImages as $key => $path) {
                if (str_contains($text, $key)) {
                    return $path;
                }
            }
        }

        $colors = [
            'Books'                     => '2563EB',
            'University Textbooks'      => '1D4ED8',
            'School Supplies'           => '16A34A',
            'Calculators'               => '9333EA',
            'Drawing Tools'             => 'D97706',
            'Educational Kits'          => 'DC2626',
            'Stationery'                => '0891B2',
            'Classroom Equipment'       => 'EA580C',
            'Science & Experiments'     => '0D9488',
            'Foreign Languages'         => 'A21CAF',
            'Computing & Programming'   => '4F46E5',
            'Creative Arts'             => 'DB2777',
        ];
        $color = $colors[$category] ?? '6B7280';
        $encoded = urlencode($text);
        return "https://placehold.co/400x300/{$color}/white?text={$encoded}&font=raleway";
    }

    public function definition(): array
    {
        // This should never be called if seeder works correctly, but fallback just in case
        $fallbackTitles = [
            'A4 100-Page Notebook', 'Blue Ballpoint Pen', 'HB Pencil', 'White Eraser',
            '30cm Ruler', 'School Scissors', 'Glue Stick', 'Pencil Case',
            'Scientific Calculator', '100-Page Notebook', 'Pack of 10 Pens',
            'A4 Binder', 'A4 Ream', '2-Compartment Pencil Case',
        ];
        $title = fake()->randomElement($fallbackTitles);
        
        return [
            'title' => $title,
            'slug' => fn (array $attrs) => Str::slug($attrs['title']),
            'description' => 'Quality educational product for students and teachers.',
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