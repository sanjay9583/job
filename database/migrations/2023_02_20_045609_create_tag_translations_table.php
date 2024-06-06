<?php

use App\Models\Tag;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('locale');
            $table->timestamps();
        });

        Artisan::call('db:seed --class=TagTranslationSeeder');

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_translations');
        Schema::table('tags', function (Blueprint $table) {
            $table->string('name');
            $table->string('slug');
        });
    }
}
