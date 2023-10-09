<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\AnnonceSendController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ModeleAbsenceController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PrendreClasseController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TypeAnnonceController;
use App\Http\Controllers\TypeSmsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/')->middleware('guest')
        ->group(function () {
            Route::controller(AuthController::class)
                ->group(function () {
                    Route::get('/', 'showLoginForm')->name('page.login');
                    Route::post('/', 'loginUser')->name('login');
                    Route::get('/register', 'showRegisterForm')->name('page.register');
                    Route::post('/register', 'registerUser')->name('register');
                });
        });

Route::prefix('admin_space')->middleware('auth')
        ->group(function () {
            Route::controller(AuthController::class)
                ->group(function () {
                    Route::get('/logout', 'logout')->name('logout');
                });
            Route::controller(DashboardController::class)
                ->group(function () {
                    Route::get('/dashboard', 'index')->name('dashboard');
                });

            Route::prefix('/type-sms')
                ->group(function () {
                    Route::controller(TypeSmsController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('typesms.all');
                            Route::get('/save', 'showSaveForm')->name('typesms.saveForm');
                            Route::post('/save', 'save')->name('typesms.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('typesms.updateForm');
                            Route::post('/update', 'update')->name('typesms.update');
                            Route::get('/delete/{id}', 'delete')->name('typesms.delete');
                        });
                });

            Route::prefix('/parent')
                ->group(function () {
                    Route::controller(ParentController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('parent.all');
                            Route::get('/save', 'showSaveForm')->name('parent.saveForm');
                            Route::post('/save', 'save')->name('parent.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('parent.updateForm');
                            Route::post('/update', 'update')->name('parent.update');
                            Route::get('/delete/{id}', 'delete')->name('parent.delete');
                        });
                });

            Route::prefix('/classe')
                ->group(function () {
                    Route::controller(ClasseController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('classe.all');
                            Route::get('/save', 'showSaveForm')->name('classe.saveForm');
                            Route::post('/save', 'save')->name('classe.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('classe.updateForm');
                            Route::post('/update', 'update')->name('classe.update');
                            Route::get('/delete/{id}', 'delete')->name('classe.delete');
                        });
                });

            Route::prefix('/matiere')
                ->group(function () {
                    Route::controller(MatiereController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('matiere.all');
                            Route::get('/save', 'showSaveForm')->name('matiere.saveForm');
                            Route::post('/save', 'save')->name('matiere.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('matiere.updateForm');
                            Route::post('/update', 'update')->name('matiere.update');
                            Route::get('/delete/{id}', 'delete')->name('matiere.delete');
                        });
                });

            Route::prefix('/type-annonce')
                ->group(function () {
                    Route::controller(TypeAnnonceController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('typeAnnonce.all');
                            Route::get('/save', 'showSaveForm')->name('typeAnnonce.saveForm');
                            Route::post('/save', 'save')->name('typeAnnonce.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('typeAnnonce.updateForm');
                            Route::post('/update', 'update')->name('typeAnnonce.update');
                            Route::get('/delete/{id}', 'delete')->name('typeAnnonce.delete');
                        });
                });

            Route::prefix('/modele-absence')
                ->group(function () {
                    Route::controller(ModeleAbsenceController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('modele.all');
                            Route::get('/save', 'showSaveForm')->name('modele.saveForm');
                            Route::post('/save', 'save')->name('modele.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('modele.updateForm');
                            Route::post('/update', 'update')->name('modele.update');
                            Route::get('/delete/{id}', 'delete')->name('modele.delete');
                        });
                });

            Route::prefix('/sms')
                ->group(function () {
                    Route::controller(SmsController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('sms.all');
                            Route::get('/save', 'showSaveForm')->name('sms.saveForm');
                            Route::post('/save', 'save')->name('sms.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('sms.updateForm');
                            Route::post('/update', 'update')->name('sms.update');
                            Route::get('/delete/{id}', 'delete')->name('sms.delete');
                        });
                });

            Route::prefix('/professeur')
                ->group(function () {
                    Route::controller(ProfesseurController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('professeur.all');
                            Route::get('/save', 'showSaveForm')->name('professeur.saveForm');
                            Route::post('/save', 'save')->name('professeur.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('professeur.updateForm');
                            Route::post('/update', 'update')->name('professeur.update');
                            Route::get('/delete/{id}', 'delete')->name('professeur.delete');
                        });
                });

            Route::prefix('/annonce-send')
                ->group(function () {
                    Route::controller(AnnonceSendController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('annonce.all');
                            Route::post('/', 'sendAnnonceByMail')->name('annonce.mail');

                            Route::get('/save', 'showSaveForm')->name('annonce.saveForm');
                            Route::post('/save', 'save')->name('annonce.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('annonce.updateForm');
                            Route::post('/update', 'update')->name('annonce.update');
                            Route::get('/delete/{id}', 'delete')->name('annonce.delete');

                        });
                });

            Route::prefix('/absence-send')
                ->group(function () {
                    Route::controller(AnnonceSendController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('annonce.all');
                            Route::post('/', 'sendAnnonceByMail')->name('annonce.mail');

                            Route::get('/save', 'showSaveForm')->name('annonce.saveForm');
                            Route::post('/save', 'save')->name('annonce.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('annonce.updateForm');
                            Route::post('/update', 'update')->name('annonce.update');
                            Route::get('/delete/{id}', 'delete')->name('annonce.delete');

                        });
                });

            Route::prefix('/eleve')
                ->group(function () {
                    Route::controller(EleveController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('eleve.all');
                            Route::get('/save', 'showSaveForm')->name('eleve.saveForm');
                            Route::post('/save', 'save')->name('eleve.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('eleve.updateForm');
                            Route::post('/update', 'update')->name('eleve.update');
                            Route::get('/delete/{id}', 'delete')->name('eleve.delete');
                        });
                });

            Route::prefix('/affectation-professeur')
                ->group(function () {
                    Route::controller(PrendreClasseController::class)
                        ->group(function () {
                            Route::get('/', 'index')->name('prendreClasse.all');
                            Route::get('/save', 'showSaveForm')->name('prendreClasse.saveForm');
                            Route::post('/save', 'save')->name('prendreClasse.save');
                            Route::get('/update/{id}', 'showUpdateForm')->name('prendreClasse.updateForm');
                            Route::post('/update', 'update')->name('prendreClasse.update');
                            Route::get('/delete/{id}', 'delete')->name('prendreClasse.delete');
                        });
                });
        });

