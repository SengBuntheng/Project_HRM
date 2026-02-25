<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $khmerDepartments = [
            ['code' => 'DEPT-001', 'name' => 'ផ្នែកបច្ចេកវិទ្យា', 'desc' => 'ផ្នែកឯកទេសក្នុងបច្ចេកវិទ្យាព័ត៌មាននិងប្រព័ន្ធកុំព្យូទ័រ'],
            ['code' => 'DEPT-002', 'name' => 'ផ្នែកធនធានមនុស្ស', 'desc' => 'ផ្នែកដែលទទួលខុសត្រូវលើការគ្រប់គ្រងនិងអភិវឌ្ឍន៍មនុស្ស'],
            ['code' => 'DEPT-003', 'name' => 'ផ្នែកហិរញ្ញវត្ថុ', 'desc' => 'ផ្នែកដែលទទួលខុសត្រូវលើការគ្រប់គ្រងហិរញ្ញវត្ថុ'],
            ['code' => 'DEPT-004', 'name' => 'ផ្នែកលក់ និងទីផ្សារ', 'desc' => 'ផ្នែកឯកទេសក្នុងការលក់និងផ្សារលំនាម'],
            ['code' => 'DEPT-005', 'name' => 'ផ្នែកប្រតិបត្តិការ', 'desc' => 'ផ្នែកដែលទទួលខុសត្រូវលើប្រតិបត្តិការប្រចាំថ្ងៃ'],
            ['code' => 'DEPT-006', 'name' => 'ផ្នែកផលិតកម្ម', 'desc' => 'ផ្នែកឯកទេសក្នុងផលិតកម្មនិងគុណវត្ថុ'],
            ['code' => 'DEPT-007', 'name' => 'ផ្នែកសិក្ខាសាលានិងផលិតកម្ម', 'desc' => 'ផ្នែកដែលទទួលខុសត្រូវលើការបង្ហាត់លម្អិត'],
            ['code' => 'DEPT-008', 'name' => 'ផ្នែកសន្តិសុខនិងសុវត្ថិភាព', 'desc' => 'ផ្នែកដែលទទួលខុសត្រូវលើសន្តិសុខនិងសុវត្ថិភាពកម្មករ'],
            ['code' => 'DEPT-009', 'name' => 'ផ្នែកច្បាប់', 'desc' => 'ផ្នែកឯកទេសក្នុងបញ្ហាច្បាប់និងលិខិតកិច្ច'],
            ['code' => 'DEPT-010', 'name' => 'ផ្នែកដឹកជញ្ជូននិងលូលាស់', 'desc' => 'ផ្នែកដែលទទួលខុសត្រូវលើដឹកជញ្ជូននិងលូលាស់'],
        ];

        foreach ($khmerDepartments as $dept) {
            DB::table('departments')->insert([
                'department_code' => $dept['code'],
                'department_name' => $dept['name'],
                'description' => $dept['desc'],
                'department_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
