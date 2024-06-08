<?php

namespace Database\Seeders;

use App\Models\ArticleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleTypes = [
            [

                'name' => 'Manuscript',
                'guard_name' => 'web',
                'slug' => 'manuscript',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Review Article',
                'guard_name' => 'web',
                'slug' => 'review-article',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Short Article',
                'guard_name' => 'web',
                'slug' => 'short-article',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Case Report',
                'guard_name' => 'web',
                'slug' => 'case-report',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Letter to the Editor',
                'guard_name' => 'web',
                'slug' => 'letter-to-the-editor',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Guidelines',
                'guard_name' => 'web',
                'slug' => 'guidelines',
                'created_at' => date('Y-m-d'),
            ]
        ];

        foreach ($articleTypes as $articleType) {

            ArticleType::updateOrCreate(['slug' => $articleType['slug']], [
                'name' => $articleType['name'],
                'slug' => $articleType['slug'],
                'status' => 'active',
            ]);

        }
    }
}
