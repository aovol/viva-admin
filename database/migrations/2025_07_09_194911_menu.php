<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('菜单名称');
            $table->string('slug')->index()->comment('菜单别名');
            $table->string('route')->comment('路由');
            $table->string('component')->comment('组件');
            $table->string('redirect')->comment('重定向');
            $table->string('permission')->comment('权限');
            $table->string('icon')->comment('图标');
            $table->string('parent_id')->default(0)->comment('父级ID');
            $table->string('status')->default(1)->comment('状态');
            $table->string('sort')->default(0)->index()->comment('排序');
            $table->string('is_show')->default(1)->comment('是否显示');
            NestedSet::columns($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            NestedSet::dropColumns($table);
        });
        Schema::dropIfExists('menus');
    }
};
