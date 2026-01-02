<?php

use App\Models\City;
use App\Models\Country;
use App\Models\Organizer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_code')->unique();
            $table->string('event_title');
            $table->string('event_type',100);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('venue');
            $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Organizer::class)->constrained()->cascadeOnDelete();
            $table->string('banner_image');
            $table->text('description');
            $table->integer('max_attendees');
            $table->enum('event_status',['Upcoming','Ongoing','Completed','Cancelled'])->default('Upcoming');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
