<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin EduMarket',
            'email' => 'admin@edumarket.com',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Client Test',
            'email' => 'client@edumarket.com',
        ]);

        User::factory(18)->create();

        $categories = Category::factory(12)->create();
        $templates = ProductFactory::getTemplates();

        // Flatten all templates for fallback
        $allTemplates = collect($templates)->flatten(1)->shuffle();

        $products = collect();
        $perCategory = (int) ceil(100 / $categories->count());
        $usedSlugs = collect();

        $categories->each(function (Category $category) use ($products, $perCategory, $templates, $allTemplates, &$usedSlugs) {
            $count = $perCategory;
            if ($products->count() + $count > 100) {
                $count = 100 - $products->count();
            }
            if ($count <= 0) {
                return;
            }

            $categoryTemplates = $templates[$category->name] ?? [];
            shuffle($categoryTemplates);

            $templateCount = min($count, count($categoryTemplates));

            for ($i = 0; $i < $templateCount; $i++) {
                $template = $categoryTemplates[$i];
                $slug = Str::slug($template['title']);

                // Skip if slug already used
                if ($usedSlugs->contains($slug)) {
                    continue;
                }

                $products->push(Product::factory()->forCategory($category, $template)->create());
                $usedSlugs->push($slug);
            }

            $remaining = $count - $templateCount;
            if ($remaining > 0) {
                // Use extra templates from other categories
                $extraTemplates = $allTemplates->filter(function ($template) use ($usedSlugs) {
                    return !$usedSlugs->contains(Str::slug($template['title']));
                })->shuffle()->take($remaining);

                foreach ($extraTemplates as $template) {
                    $slug = Str::slug($template['title']);
                    $products->push(Product::factory()->forCategory($category, $template)->create());
                    $usedSlugs->push($slug);
                }
            }
        });
    }
}