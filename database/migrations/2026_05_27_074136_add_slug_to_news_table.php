<?php

use App\Models\News;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });

        // Backfill slugs for any existing articles
        News::whereNull('slug')->orWhere('slug', '')->get()->each(function ($article) {
            $base = Str::slug($article->title);
            $slug = $base;
            $i = 1;
            while (News::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = $base.'-'.$i++;
            }
            $article->update(['slug' => $slug]);
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
