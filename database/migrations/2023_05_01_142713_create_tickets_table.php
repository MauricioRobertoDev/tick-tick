<?php

use App\Enums\Priority;
use App\Enums\Status;
use App\Models\Department;
use App\Models\User;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('status')->default(Status::OPEN->value);
            $table->text('description');
            $table->string('priority')->default(Priority::LOW->value);
            $table->foreignIdFor(Department::class)->nullable()->nullOnDelete();
            $table->foreignIdFor(User::class)->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'agent_id')->nullable()->nullOnDelete();
            $table->foreignIdFor(User::class, 'closed_by')->nullable()->nullOnDelete();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
