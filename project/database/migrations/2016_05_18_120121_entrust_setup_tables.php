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
        \App\Permission::create(['name'=>'indexProjet','display_name'=>'Creer projet','description'=>'permet de voir interface d ajout de projet + projets ']);
        \App\Permission::create(['name'=>'storeP','display_name'=>'AddProjet','description'=>'permet d ajouter un projet dans la base ']);
        \App\Permission::create(['name'=>'updateP','display_name'=>'Mise à jour','description'=>'permet la mise à jour d un projet']);
        \App\Permission::create(['name'=>'destroyP','display_name'=>'Suppression','description'=>'permet la suppression du projet']);
        \App\Permission::create(['name'=>'editP','display_name'=>'Modification','description'=>'permet la modification du projet']);
        \App\Permission::create(['name'=>'showP','display_name'=>'Voir le formulaire','description'=>'permet la création du formulaire']);
        \App\Permission::create(['name'=>'putP','display_name'=>'Mise à jour du formulaire','description'=>'permet la mise à jour du formulaire']);
        \App\Permission::create(['name'=>'afficheP','display_name'=>'Affiche tout les projets','description'=>'permet d afficher tout les projets']);
        \App\Permission::create(['name'=>'deleteLiaisonP','display_name'=>'Suppression des users liés','description'=>'permet de supprimer les projets lies ']);
        //\App\Permission::create(['name'=>'createTable','display_name'=>'Création des tables dynamique','description'=>'permet la création des table reponse dynamiquement']);
     
    //Permission sur les clients
       \App\Permission::create(['name'=>'indexClient','display_name'=>'Creer client','description'=>'permet de voir l interface d ajout dun client ainsi que les clients']);
        \App\Permission::create(['name'=>'storeC','display_name'=>'AddProjet','description'=>'permet d ajouter un client dans la base ']);
        \App\Permission::create(['name'=>'updateC','display_name'=>'Mise à jour','description'=>'permet la mise à jour du client']);
        \App\Permission::create(['name'=>'destroyC','display_name'=>'Suppression','description'=>'permet la suppression du client']);
        \App\Permission::create(['name'=>'editC','display_name'=>'Modification','description'=>'permet la modification du client']);
        \App\Permission::create(['name'=>'afficheC','display_name'=>'Affiche tout les clients','description'=>'permet d afficher tout les clients']);
        \App\Permission::create(['name'=>'deleteLiaisonC','display_name'=>'Suppression des projets liés','description'=>'permet de supprimer les projets lies ']);

    //Permission sur les enqueteurs
        \App\Permission::create(['name'=>'indexEnq','display_name'=>'creer enqueteur','description'=>'permet de voir l interface d ajout de client ainsi que les clients']);
        \App\Permission::create(['name'=>'storeE','display_name'=>'Add enqueteur','description'=>'permet d ajouter un enqueteur dans la base ']);
        \App\Permission::create(['name'=>'updateE','display_name'=>'Mise à jour','description'=>'permet la mise à jour d un enqueteur']);
        \App\Permission::create(['name'=>'destroyE','display_name'=>'Suppression','description'=>'permet la suppression du enqueteur']);
        \App\Permission::create(['name'=>'editE','display_name'=>'Modification','description'=>'permet la modification du enqueteur']);
        \App\Permission::create(['name'=>'afficheE','display_name'=>'Affiche tout les enqueteurs','description'=>'permet d afficher tout les enqueteurs']);
        \App\Permission::create(['name'=>'deleteLiaisonE','display_name'=>'Suppression des enqueteurs liés','description'=>'permet de supprimer les enqueteurs lies ']);
        \App\Permission::create(['name'=>'htmlE','display_name'=>'Formulaire','description'=>'permet de passer du json à l html']);
        \App\Permission::create(['name'=>'liste_projetE','display_name'=>'liste des projets','description'=>'permet de lister les projets associer à l enqueteur']);
        \App\Permission::create(['name'=>'add_reponseE','display_name'=>'Ajout de la reponse du formulaire ','description'=>'permet l ajout du formulaire remplie dans  la table reponse']);
        
    //Permission sur les administrateurs
        \App\Permission::create(['name'=>'indexAdmin','display_name'=>'creer admin','description'=>'permet de voir l interface d ajout d admin ainsi que les admins']);
        \App\Permission::create(['name'=>'storeA','display_name'=>'AddProjet','description'=>'permet d ajouter un admin dans la base ']);
        \App\Permission::create(['name'=>'updateA','display_name'=>'Mise à jour','description'=>'permet la mise à jour d un admin']);
        \App\Permission::create(['name'=>'destroyA','display_name'=>'Suppression','description'=>'permet la suppression de l admin']);
        \App\Permission::create(['name'=>'editA','display_name'=>'Modification','description'=>'permet la modification de l admin']);
        \App\Permission::create(['name'=>'afficheA','display_name'=>'Affiche tout les admins','description'=>'permet d afficher tout les admins']);
        \App\Permission::create(['name'=>'deleteLiaisonA','display_name'=>'Suppression des admins liés','description'=>'permet de supprimer les admins lies ']);
        \App\Permission::create(['name'=>'list_formA','display_name'=>'liste formulaire','description'=>'permet de voir les liste de formulaire associé à ladmin']);
        
        
        
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
        
        //Inseretion des Role_permission dans la base
        //---------------SUPERADMIN------------------
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 1)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 2)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 3)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 4)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 5)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 6)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 7)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 8)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 9)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 10)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 11)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 12)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 13)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 14)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 15)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 16)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 17)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 18)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 19)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 20)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 21)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 22)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 23)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 24)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 25)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 26)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 27)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 28)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 29)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 30)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 31)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 32)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 33)');
        DB::insert('insert into permission_role (role_id, permission_id) values (1, 34)');


        //---------------ADMINISTRATEUR----------------
        DB::insert('insert into permission_role (role_id, permission_id) values (2, 34)');
        
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
