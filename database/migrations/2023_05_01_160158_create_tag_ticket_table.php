<?php

use App\Models\Tag;
use App\Models\Ticket;
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
        Schema::create('tag_ticket', function (Blueprint $table) {
            $table->foreignIdFor(Ticket::class);
            $table->foreignIdFor(Tag::class);
            $table->primary(['ticket_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_ticket');
    }
};
