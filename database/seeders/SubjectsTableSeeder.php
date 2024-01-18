<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // データの挿入
        $subjects = [
            '国語',
            '算数',
            '理',
            '社会',
            '英語',
            '体育',
            '音楽',
            '図画工作',
            '道徳',
            '家庭',
            '総合'
        ];
        foreach ($subjects as $subject) {
            Subject::create(['name' => $subject]);
        }
    }
}
