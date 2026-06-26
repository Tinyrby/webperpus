<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('series_title')->nullable()->after('description');
            $table->string('call_number')->nullable()->after('series_title');
            $table->string('physical_description')->nullable()->after('call_number');
            $table->string('language')->nullable()->after('physical_description');
            $table->string('classification')->nullable()->after('language');
            $table->string('content_type')->nullable()->after('classification');
            $table->string('media_type')->nullable()->after('content_type');
            $table->string('carrier_type')->nullable()->after('media_type');
            $table->string('edition')->nullable()->after('carrier_type');
            $table->string('subject')->nullable()->after('edition');
            $table->string('specific_detail_info')->nullable()->after('subject');
            $table->string('statement_of_responsibility')->nullable()->after('specific_detail_info');
            $table->boolean('is_available')->default(true)->after('statement_of_responsibility');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'series_title',
                'call_number',
                'physical_description',
                'language',
                'classification',
                'content_type',
                'media_type',
                'carrier_type',
                'edition',
                'subject',
                'specific_detail_info',
                'statement_of_responsibility',
                'is_available'
            ]);
        });
    }
};
