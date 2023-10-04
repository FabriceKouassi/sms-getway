<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatiereRequest;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatiereController extends Controller
{
    public function index()
    {
        $matiere = Matiere::latest()->get();
        $title = 'Matiere';

        $param = [
            'matiere' => $matiere,
            'title' => $title
        ];
        return view('matiere.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Matiere';

        $param = [
            'title' => $title
        ];
        return view('matiere.save', $param);
    }

    public function save(MatiereRequest $request)
    {
        $data = $request->validated();

        $matiere = Matiere::create($data);

        $matiere->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('matiere.all');
    }

    public function showUpdateForm(int $id)
    {
        $matiere = Matiere::where('id', $id)->first();
        $title = 'Matiere';

        $param = [
            'matiere' => $matiere,
            'title' => $title
        ];

        return view('matiere.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dataID' => 'required|numeric',
            'nom' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $matiere = Matiere::where('id', $request->dataID)->first();

        if($matiere==null) return redirect()->back();

        $matiere->nom = $request->nom;
        $matiere->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $matiere = Matiere::where('id', $id)->first();
        if($matiere==null) return redirect()->back();

        $matiere->delete();
        return redirect()->back();
    }
}
