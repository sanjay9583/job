<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use App\Models\SkillTranslation;
use Modules\Language\Entities\Language;

class SkillTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = Language::all();

        $skills = Skill::all();
        if($skills && count($skills) && count($skills) != 0){
            foreach ($skills as $data) {
                foreach ($languages as $language) {
                    SkillTranslation::create([
                        'skill_id' => $data->id,
                        'locale' => $language->code,
                        'name' => $data->name ?? "{$language->code} name",
                    ]);
                }
            }
        }
    }
}
