<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        
        //Création Rôle
        \App\Role::create(['name'=>'superAdmin','display_name'=>'SuperAdmin','description'=>'superAdmin']);
        \App\Role::create(['name'=>'admin','display_name'=>'Admin','description'=>'admin']);
        \App\Role::create(['name'=>'client','display_name'=>'Client','description'=>'client']);
        \App\Role::create(['name'=>'enqueteur','display_name'=>'Enqueteur','description'=>'Enqueteur']);
        
        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        
        //Création Permissions
        
    //Permission sur les projets 
        /*
         * CRUD Admin SuperAdmin
         * voir formulaire client enqueteur
         * submit enqueteur
         * reponse client
         */
        \App\Permission::create(['name'=>'CRUD','display_name'=>'AdminSuperAdmin','description'=>'Tout voir']);
        \App\Permission::create(['name'=>'formulaire','display_name'=>'voir les formulaires','description'=>'voir les formulaires']);
        \App\Permission::create(['name'=>'submit','display_name'=>'submit les formulaires','description'=>'faire les submit']);
        \App\Permission::create(['name'=>'reponse','display_name'=>'gerer les clients','description'=>'voir reponse']);
        
   
       
        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
        
        DB::insert('insert into permission_role (role_id,permission_id) values (1,1)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,2)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,3)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,4)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,1)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,2)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,3)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,4)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,2)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,3)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,4)');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
