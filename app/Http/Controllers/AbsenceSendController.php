<?php

namespace App\Http\Controllers;

use App\Mail\AbsenceMail;
use App\Models\_Parent;
use App\Models\AbsenceSend;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Matiere;
use App\Models\ProfesseurClasse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AbsenceSendController extends Controller
{
    public function index()
    {
        $title = 'Absence';
        $classes_enseignes = ProfesseurClasse::query()
                    ->with(['professeurs', 'classes'])
                    ->get()
                    ->filter( fn ($classes) => $classes->professeurs()->count() > 0);

        $param = [
            'title' => $title,
            'classes_enseignes' => $classes_enseignes,
        ];

        return view('absence_send.index', $param);
    }

    public function showSaveForm(int $id)
    {
        $classes_enseignes = ProfesseurClasse::query()
                            ->with(['professeurs', 'classes'])
                            ->where('id', $id)
                            ->get()
                            ->filter( fn ($classes) => $classes->professeurs()->count() > 0);
                            // if($classes_enseignes->isEmpty()) abort(404);

        foreach ($classes_enseignes as $item) {
            $eleves = Eleve::with(['classe', '_parent'])->where('classe_id', $item->classes->id)->get();
        }

        $matieres = Matiere::with(['professeurs'])->oldest('nom')->get();

        $param = [
            'classes_enseignes' => $classes_enseignes,
            'eleves' => $eleves,
            'matieres' => $matieres,
        ];

        return view('absence_send.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'classe_id' => 'required|numeric',
            'matiere' => 'required|numeric',
            'absences' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $eleves = $request->absences;
        $classe = $request->classe_id;
        $matiere = $request->matiere;

        foreach ($eleves as $eleve) {
            $absence_send = AbsenceSend::create([
                'user_id' => auth()->user()->id,
                'eleve_id' => (int)$eleve,
                'matiere_id' => (int)$matiere
            ]);
        }

        $query = AbsenceSend::query()->with(['eleve', 'matiere'])->where('status', 0)->get();
        $classe = Classe::query()->with('professeurs')->where('id', $classe)->first();

        foreach ($query as $q) {
            $date_format = Carbon::createFromTimestamp(now());

            $date = $date_format->toDateTimeString();
            // $heures = $date_format->format('%H h');
            // $minutes = $date_format->format('%i min');
            // $secondes = $date_format->format('%s min');

            $matiere = Matiere::where('id', $q->matiere->id)->first();
            $param_mail = [
                'parent' => $q->eleve->_parent->nom,
                'eleve' => $q->eleve->nom . ' ' . $q->eleve->prenoms,
                'matricule' => $q->eleve->matricule,
                'classe' => $classe->nom,
                'matiere' => $matiere->nom,
                'date' => $date,
                // 'heures' => $heures,
                // 'minutes' => $minutes,
                // 'secondes' => $secondes,
            ];

            Mail::to($q->eleve->_parent->email)->send(new AbsenceMail([$param_mail]));
            $status = AbsenceSend::where('id', $q->id)->first();
            $status->status = 1;
            $status->save();
        }

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('absence.all');
    }

    public function showUpdateForm(int $id)
    {
        $absence = Absence::where('id', $id)->first();
        $typeAbsence = TypeAbsence::oldest('libelle')->get();
        $title = 'Absence';

        $param = [
            'absence' => $absence,
            'title' => $title,
            'typeAbsence' => $typeAbsence
        ];

        return view('absence.update', $param);
    }
}
