<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ACL\{
    ProfileController, PermissionController, PermissionProfileController, PlanProfileController,
    PermissionRoleController, RoleController, RoleUserController
};

use App\Http\Controllers\Admin\{
    PlanController, DetailPlanController, UserController, CategoriaController, TipoProjetoController, ProjetoController, ProjetoTipoProjetoController, ProjetoCategoriaController, TenantController, DetailProjetoController, TipoUserController
};

use App\Http\Controllers\Site\{
    SiteController
};

use App\Http\Controllers\Subscription\{
    SubscriptionController
};
use App\Models\User;

Route::get('testeuser', function() {
    $usuario = User::First();

    $token = $usuario->createToken('token-teste');

    dd($token->plainTextToken);
});

// Rotas Checkout
Route::get('subscriptions/resume', [SubscriptionController::class, 'resume'])->name('subscriptions.resume');
Route::get('subscriptions/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
Route::get('subscriptions/invoice/{invoice}', [SubscriptionController::class, 'downloadInvoice'])->name('subscriptions.invoice.download');
Route::get('subscriptions/account', [SubscriptionController::class, 'account'])->name('subscriptions.account');
Route::post('subscriptions/store', [SubscriptionController::class, 'store'])->name('subscriptions.store');
Route::get('subscriptions/checkout', [SubscriptionController::class, 'index'])->name('subscriptions.checkout');
Route::get('subscriptions/premium', [SubscriptionController::class, 'premium'])->name('subscriptions.premium')->middleware(['subscribed']);
// Rotas Checkout

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function(){

/*
//Teste ACL
Route::get('teste-acl', function() {
    dd(auth()->user()->permissions());
    //dd(auth()->user());
    //dd(auth()->user()->hasPermission('p02'));
    //dd(auth()->user()->hasPermission('produtos'));
    //dd(auth()->user()->isAdmin('produtos'));
});
//Fim Teste ACL
*/

//Rotas Plans
    Route::put('plans/{url}/update', [PlanController::class, 'update'])->name('plans.update');
    Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
    Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::delete('plans/{url}', [PlanController::class, 'delete'])->name('plans.delete');
    Route::post('plans/store', [PlanController::class, 'store'])->name('plans.store');
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
//Fim Rotas Plans


//Routes Details Plan
    Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
    Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'delete'])->name('details.plan.delete');
    Route::get('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
    Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
    Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
//Fim Routes Details Plan

// Profile Routes
    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::put('profiles/{url}/update', [ProfileController::class, 'update'])->name('profiles.update');
    Route::get('profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::get('profiles/{url}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('profiles/{url}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::delete('profiles/{url}', [ProfileController::class, 'delete'])->name('profiles.delete');
    Route::post('profiles/store', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
//Fim Profile Routes

// Permissions Routes
    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::put('permissions/{url}/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::get('permissions/{url}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('permissions/{url}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::delete('permissions/{url}', [PermissionController::class, 'destroy'])->name('permissions.delete');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
//Fim Permissions Routes


//Permission x Profile Routes
    Route::get('profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach');
    Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
    Route::get('permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');
// Fim Permission x Profile Routes

//Route Plan x Profile
    Route::get('plans/{id}/profile/{idProfile}/detach', [PlanProfileController::class, 'detachProfilePlan'])->name('plans.profile.detach');
    Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
    Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');
//Fim Route Plan x Profile

// Users Routes
Route::any('users/search', [UserController::class, 'search'])->name('users.search');
Route::put('users/{url}/update', [UserController::class, 'update'])->name('users.update');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/{url}', [UserController::class, 'show'])->name('users.show');
Route::get('users/{url}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::delete('users/{url}', [UserController::class, 'destroy'])->name('users.delete');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::get('users', [UserController::class, 'index'])->name('users.index');
//Fim Users Routes

// Tipo Users Routes
Route::any('tipousers/search', [TipoUserController::class, 'search'])->name('tipousers.search');
Route::put('tipousers/{id}/update', [TipoUserController::class, 'update'])->name('tipousers.update');
Route::get('tipousers/create', [TipoUserController::class, 'create'])->name('tipousers.create');
Route::get('tipousers/{id}', [TipoUserController::class, 'show'])->name('tipousers.show');
Route::get('tipousers/{id}/edit', [TipoUserController::class, 'edit'])->name('tipousers.edit');
Route::delete('tipousers/{id}', [TipoUserController::class, 'destroy'])->name('tipousers.delete');
Route::post('tipousers/store', [TipoUserController::class, 'store'])->name('tipousers.store');
Route::get('tipousers', [TipoUserController::class, 'index'])->name('tipousers.index');
//Fim Tipo Users Routes

// Categorias Routes
Route::any('categorias/search', [CategoriaController::class, 'search'])->name('categorias.search');
Route::put('categorias/{id}/update', [CategoriaController::class, 'update'])->name('categorias.update');
Route::get('categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::get('categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.delete');
Route::post('categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias.index');
//Fim Categorias Routes

/**
* Routes Tipo Projetos
*/
    Route::put('tipoprojetos/{url}/update', [TipoProjetoController::class, 'update'])->name('tipoprojetos.update');
    Route::get('tipoprojetos/create', [TipoProjetoController::class, 'create'])->name('tipoprojetos.create');
    Route::get('tipoprojetos/{url}', [TipoProjetoController::class, 'show'])->name('tipoprojetos.show');
    Route::get('tipoprojetos/{url}/edit', [TipoProjetoController::class, 'edit'])->name('tipoprojetos.edit');
    Route::any('tipoprojetos/search', [TipoProjetoController::class, 'search'])->name('tipoprojetos.search');
    Route::delete('tipoprojetos/{url}', [TipoProjetoController::class, 'delete'])->name('tipoprojetos.delete');
    Route::post('tipoprojetos/store', [TipoProjetoController::class, 'store'])->name('tipoprojetos.store');
    Route::get('tipoprojetos', [TipoProjetoController::class, 'index'])->name('tipoprojetos.index');
/**
* End Routes Tipo Projetos
*/

/**
* Routes Projetos
*/
    Route::put('projetos/{url}/update', [ProjetoController::class, 'update'])->name('projetos.update');
    Route::get('projetos/create', [ProjetoController::class, 'create'])->name('projetos.create');
    Route::get('projetos/{url}', [ProjetoController::class, 'show'])->name('projetos.show');
    Route::get('projetos/{url}/edit', [ProjetoController::class, 'edit'])->name('projetos.edit');
    Route::any('projetos/search', [ProjetoController::class, 'search'])->name('projetos.search');
    Route::delete('projetos/{url}', [ProjetoController::class, 'delete'])->name('projetos.delete');
    Route::post('projetos/store', [ProjetoController::class, 'store'])->name('projetos.store');
    Route::get('projetos', [ProjetoController::class, 'index'])->name('projetos.index');
/**
* End Routes Projetos
*/

/**
* Routes Tipo Projetos
*/
    Route::put('tipoprojetos/{url}/update', [TipoProjetoController::class, 'update'])->name('tipoprojetos.update');
    Route::get('tipoprojetos/create', [TipoProjetoController::class, 'create'])->name('tipoprojetos.create');
    Route::get('tipoprojetos/{url}', [TipoProjetoController::class, 'show'])->name('tipoprojetos.show');
    Route::get('tipoprojetos/{url}/edit', [TipoProjetoController::class, 'edit'])->name('tipoprojetos.edit');
    Route::any('tipoprojetos/search', [TipoProjetoController::class, 'search'])->name('tipoprojetos.search');
    Route::delete('tipoprojetos/{url}', [TipoProjetoController::class, 'delete'])->name('tipoprojetos.delete');
    Route::post('tipoprojetos/store', [TipoProjetoController::class, 'store'])->name('tipoprojetos.store');
    Route::get('tipoprojetos', [TipoProjetoController::class, 'index'])->name('tipoprojetos.index');
/**
* End Routes Tipo Projetos
*/

/**
* Projeto x Categoria
*/
    Route::get('projetos/{id}/categoria/{idCategoria}/detach', [ProjetoCategoriaController::class, 'detachCategoriaProjeto'])->name('projetos.categoria.detach');
    Route::post('projetos/{id}/categorias', [ProjetoCategoriaController::class, 'attachCategoriasProjeto'])->name('projetos.categorias.attach');
    Route::any('projetos/{id}/categorias/create', [ProjetoCategoriaController::class, 'categoriasAvailable'])->name('projetos.categorias.available');
    Route::get('projetos/{id}/categorias', [ProjetoCategoriaController::class, 'categorias'])->name('projetos.categorias');
    Route::get('categorias/{id}/projetos', [ProjetoCategoriaController::class, 'projetos'])->name('categorias.projetos');
/**
* FIM Projeto x Categoria
*/

/**
 * Projeto x Tipos Projeto
 */
    Route::get('projetos/{id}/tipoprojetos/{idTipoProjeto}/detach', [ProjetoTipoProjetoController::class, 'detachTipoProjetoProjeto'])->name('projetos.tipoprojeto.detach');
    Route::post('projetos/{id}/tipoprojetos', [ProjetoTipoProjetoController::class, 'attachTipoProjetosProjeto'])->name('projetos.tipoprojetos.attach');
    Route::any('projetos/{id}/tipoprojetos/create', [ProjetoTipoProjetoController::class, 'tipoprojetosAvailable'])->name('projetos.tipoprojetos.available');
    Route::get('projetos/{id}/tipoprojetos', [ProjetoTipoProjetoController::class, 'tipoprojetos'])->name('projetos.tipoprojetos');
    Route::get('tipoprojetos/{id}/projetos', [ProjetoTipoProjetoController::class, 'projetos'])->name('tipoprojetos.projetos');
/**
 * FIM Projeto x Tipo Projeto
 */

/**
 * Routes Tenant
 */
    Route::get('tenants/create', [TenantController::class, 'create'])->name('tenants.create');
    Route::put('tenants/{url}', [TenantController::class, 'update'])->name('tenants.update');
    Route::get('tenants/{url}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::any('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
    Route::delete('tenants/{url}', [TenantController::class, 'destroy'])->name('tenants.destroy');
    Route::get('tenants/{url}', [TenantController::class, 'show'])->name('tenants.show');
    Route::post('tenants', [TenantController::class, 'store'])->name('tenants.store');
    Route::get('tenants', [TenantController::class, 'index'])->name('tenants.index');
/**
 * Fim Routes Tenant
 */

//Routes Details Projeto
    Route::get('projetos/{id}/details/create', [DetailProjetoController::class, 'create'])->name('details.projeto.create');
    Route::delete('projetos/{id}/details/{idDetail}', [DetailProjetoController::class, 'delete'])->name('details.projeto.delete');
    Route::get('projetos/{id}/details/{idDetail}', [DetailProjetoController::class, 'show'])->name('details.projeto.show');
    Route::put('projetos/{id}/details/{idDetail}', [DetailProjetoController::class, 'update'])->name('details.projeto.update');
    Route::get('projetos/{id}/details/{idDetail}/edit', [DetailProjetoController::class, 'edit'])->name('details.projeto.edit');
    Route::post('projetos/{id}/details', [DetailProjetoController::class, 'store'])->name('details.projeto.store');
    Route::get('projetos/{id}/details', [DetailProjetoController::class, 'index'])->name('details.projeto.index');
//Fim Routes Details Projeto

/**
 * Role x User
 */
    Route::get('users/{id}/role/{idRole}/detach',  [RoleUserController::class, 'detachRoleUser'])->name('users.role.detach');
    Route::post('users/{id}/roles',  [RoleUserController::class, 'attachRolesUser'])->name('users.roles.attach');
    Route::any('users/{id}/roles/create',  [RoleUserController::class, 'rolesAvailable'])->name('users.roles.available');
    Route::get('users/{id}/roles',  [RoleUserController::class, 'roles'])->name('users.roles');
    Route::get('roles/{id}/users',  [RoleUserController::class, 'users'])->name('roles.users');
/*
 * Role x User
 */

/**
 * Permission x Role
 */
    Route::get('roles/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionRole'])->name('roles.permission.detach');
    Route::post('roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attach');
    Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
    Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
    Route::get('permissions/{id}/role', [PermissionRoleController::class, 'roles'])->name('permissions.roles');
/**
 * Fim Permission x Role
 */

/**
 * Routes Roles
 */
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::put('roles/{url}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('roles/{url}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::any('roles/search', [RoleController::class, 'search'])->name('roles.search');
    Route::delete('roles/{url}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('roles/{url}', [RoleController::class, 'show'])->name('roles.show');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
/**
 * Fim Routes Roles
 */



    Route::get('/', [PlanController::class, 'index'])->name('admin.index');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Routes Site
    Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
    Route::get('/', [SiteController::class, 'index'])->name('site.home');
// Fim Routes Site

require __DIR__.'/auth.php';