<?php

use App\Models\Attendee;
use App\Models\Event;
use App\Models\TicketType;
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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Event::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Attendee::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TicketType::class)->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('total_price');
            $table->enum('status',['Paid','Pending','Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
