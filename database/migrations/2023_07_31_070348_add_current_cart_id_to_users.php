<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentCartIdToUsers extends Migration
{
    public function up()
    {
        // Bỏ lệnh thêm cột `current_cart_id`, vì nó đã tồn tại trong bảng `users`
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Xóa trường `current_cart_id` nếu rollback migration
            $table->dropColumn('current_cart_id');
        });
    }
}
