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
        Schema::create('collections', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('description');
            $table->string('image_collection', 200);
            $table->text('tags');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('sell')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
