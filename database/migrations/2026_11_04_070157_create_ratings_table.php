<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            /**
             * Anonymous device fingerprint.
             *
             * Visitors do not log in, so "one rating per device" is enforced with
             * a hash of a long-lived cookie plus coarse request data. Unique, so
             * the database itself rejects a second submission even if the client
             * ignores the UI.
             */
            $table->string('device_key', 64)->unique();

            $table->unsignedTinyInteger('stars');

            $table->string('author', 60)->nullable();
            $table->text('body');

            // Moderation hook: nothing is shown on the public page until approved.
            $table->boolean('is_visible')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
