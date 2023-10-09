<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\EnseignerClasse;
use App\Models\Professeur;
use App\Models\ProfesseurClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PrendreClasseController extends Controller
{
    public function index()
    {
        //$prendreClasse = EnseignerClasse::with(['professeur', 'classe'])->get();
        // $classeParProf = DB::table('enseigner_classe')
        //                     ->select('classes.nom')
        //                     ->leftJoin('classes', 'classes.id', 'enseigner_classe.classe_id')
        //                     ->leftJoin('professeurs', 'professeurs.id', 'enseigner_classe.professeur_id')
        //                     ->get()->dd();

        $professeurs = Professeur::query()->with('classes')->get()->filter(fn ($professeur) => $professeur->classes()->count() > 0);

        $title = 'Affectation du professeur';

        $param = [
            'prendreClasse' => $professeurs,
            'title' => $title
        ];

        return view('prendreClasse.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Affectation du professeur';
        $professeur = Professeur::oldest('nom')->get();
        $classe = Classe::oldest('nom')->get();

        $param = [
            'title' => $title,
            'professeur' => $professeur,
            'classe' => $classe,
        ];

        return view('prendreClasse.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'professeur' => 'required|numeric',
            'classes[]' => 'required|numeric',
        ]);

        $professeur = $request->professeur;
        $classes = $request->classes;

        if ($professeur === null && $classes === null) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $professeur = Professeur::query()->find($professeur);
        $professeurClasses = $professeur
            ->classes()
            ->get()
            ->map(fn ($classe) => $classe->id)
            ->toArray();

        foreach ($classes as $classe) {
            if (!in_array((int) $classe, $professeurClasses)) {
                $professeur->classes()->attach($classe);
            }
        }

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('prendreClasse.all');
    }

    public function showUpdateForm(int $id)
    {
        $title = 'Affectation du professeur';
        $professeur = Professeur::oldest('nom')->get();
        $classe = Classe::oldest('nom')->get();
        $professeur_classe = ProfesseurClasse::query()->with(['professeurs', 'classes'])->get();

        $param = [
            'title' => $title,
            'professeur' => $professeur,
            'classe' => $classe,
            'professeur_classe' => $professeur_classe,
        ];

        return view('prendreClasse.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'professeur' => 'required|numeric',
            'classes[]' => 'required|numeric',
        ]);

        $professeur = $request->professeur;
        $classes = $request->classes;

        if ($professeur === null && $classes === null) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $professeur = Professeur::query()->find($professeur);
        $professeurClasses = $professeur
            ->classes()
            ->get()
            ->map(fn ($classe) => $classe->id)
            ->toArray();

        foreach ($classes as $classe) {
            if (!in_array((int) $classe, $professeurClasses)) {
                $professeur->classes()->detach($classe);
            }
        }

        return redirect()->back();
    }

    public function delete(int $id, Request $req)
    {
        $prendreClasse = ProfesseurClasse::where('id', $req->id)->first();

        if($prendreClasse==null) return redirect()->back();
        dd($req->id);

        $prendreClasse->delete();
        return redirect()->back();
    }
}
