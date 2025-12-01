<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('seeds/articles.csv');
        if (! file_exists($path)) {
            $this->command->warn("⚠️  Fichier manquant : $path (seed ignoré)");
            return;
        }

        if (($handle = fopen($path, 'r')) === false) {
            $this->command->error('❌ Impossible d’ouvrir le fichier CSV.');
            return;
        }

        $header = fgetcsv($handle, 1000, ';'); // lire la première ligne (en-têtes)
        while (($row = fgetcsv($handle, 1000, ';')) !== false) {
            $data = array_combine($header, $row);

            $title = trim($data['title'] ?? 'Sans titre');
            $slug  = $data['slug'] ?: Str::slug($title);
            Article::updateOrCreate(
                ['slug' => $slug],
                [
                    'title'     => $title,
                    'excerpt'   => $data['excerpt'] ?? null,
                    'views'     => (int)($data['views'] ?? 0),
                    'published' => filter_var($data['published'] ?? true, FILTER_VALIDATE_BOOL),
                ]
            );
        }

        fclose($handle);
        $this->command->info('✅ Articles importés avec succès depuis le CSV.');
    }
}
