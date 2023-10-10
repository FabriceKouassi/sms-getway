<?php

namespace App\Http\Controllers;

use App\Models\_Parent;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Professeur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pIndex = 'dashboard';

        $eleve = Eleve::all();
        $parent = _Parent::all();
        $professeur = Professeur::all();
        $classe = Classe::all();

        $param = [
            'pIndex' => $pIndex,
            'eleve' => $eleve,
            'parent' => $parent,
            'professeur' => $professeur,
            'classe' => $classe,
        ];

        return view('dashboard', $param);
    }
}
