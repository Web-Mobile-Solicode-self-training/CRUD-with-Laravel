<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path=storage_path('seeds/articles.csv');

        if(!file_exists($path)){
             $this->command->warn('⚠️ fichier manquant : '.$path);
             return;
        }

        if(($handle= fopen($path, 'r')) === false){
             $this->command->error('❌ Impossible d’ouvrir le fichier CSV');
        }

        $header=fgetcsv($handle, 1000, ';');

      

while (($row = fgetcsv($handle, 1000, ';')) !== false) {
    $data = array_combine($header, $row);

    $title = trim($data['title'] ?? 'sans titre');
    $slug = trim($data['slug'] ?: Str::slug($title));

    // Get a user ID to assign (here we take the first user)
    $user = User::first();
    if (!$user) {
        $this->command->error('❌ Aucun utilisateur trouvé. Veuillez exécuter UserSeeder d’abord.');
        return;
    }

    Article::updateOrCreate(
        ['slug' => $slug],
        [
            'title' => $title,
            'excerpt' => $data['excerpt'] ?? null,
            'views' => (int)($data['views'] ?? 0),
            'published' => filter_var($data['published'] ?? true, FILTER_VALIDATE_BOOL),
            'user_id' => $user->id, // assign a valid user_id
        ]
    );
}

         fclose($handle);
         $this->command->info('✅ Articles importés avec succès depuis le CSV.');
}
}