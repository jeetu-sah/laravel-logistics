<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemType;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleTypes = [
            [

                'name' => 'Blinded Manuscript',
                'guard_name' => 'web',
                'slug' => 'blinded-manuscript',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Line figure',
                'guard_name' => 'web',
                'slug' => 'line-figure',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Copyright Transfer Statement',
                'guard_name' => 'web',
                'slug' => 'copyright-transfer-statement',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Screen',
                'guard_name' => 'web',
                'slug' => 'screen',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Colour Figure',
                'guard_name' => 'web',
                'slug' => 'colour-figure',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Compressed File',
                'guard_name' => 'web',
                'slug' => 'compressed-file',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Attachment to manuscript',
                'guard_name' => 'web',
                'slug' => 'attachment-to-manuscript',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Table',
                'guard_name' => 'web',
                'slug' => 'table',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Latex Supporting file(s) (if applicable; *.sty, *.bib, *.bbl, *.nls etc.)',
                'guard_name' => 'web',
                'slug' => 'latex-supporting-file',
                'created_at' => date('Y-m-d'),
            ]
        ];

        foreach ($articleTypes as $articleType) {

            ItemType::updateOrCreate(['slug' => $articleType['slug']], [
                'name' => $articleType['name'],
                'slug' => $articleType['slug'],
                'status' => 'active',
            ]);

        }
    }
}
