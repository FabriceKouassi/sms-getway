<?php

namespace App\Http\Controllers;

use App\Mail\AbsenceMail;
use App\Models\_Parent;
use App\Models\AbsenceSend;
use App\Models\Classe;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AbsenceSendController extends Controller
{
    public function index()
    {
        $title = 'Absence';
        $classes = Classe::oldest('nom')->get();

        $param = [
            'title' => $title,
            'classes' => $classes,
        ];

        return view('absence_send.index', $param);
    }

    public function sendAbsenceByMail(Request $request)
    {
        $query = AbsenceSend::query()->with(['parent', 'sms'])->where('status', 0)->get();

        foreach ($query as $q) {
            Mail::to($q->parent->email)->send(new AbsenceMail([
                $q->sms->message,
            ]));

            $status = AbsenceSend::where('id', $q->id)->first();
            $status->status = 1;
            $status->save();
        }

        return redirect()->back();
    }

    public function showSaveForm($id)
    {
        $classe = Classe::where('id', $id)->first();
        $eleves = Eleve::with(['classe', '_parent'])->where('classe_id', $id)->get();

        $param = [
            'classe' => $classe,
            'eleves' => $eleves,
        ];

        return view('absence_send.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'classe_id' => 'required|numeric',
            'absences' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $eleves = $request->absences;
        $classe = $request->classe_id;

        foreach ($eleves as $eleve) {
            $absence_send = AbsenceSend::create([
                'user_id' => auth()->user()->id,
                'eleve_id' => (int)$eleve
            ]);
        }

        $query = AbsenceSend::query()->with('eleve')->where('status', 0)->get();
        $classe = Classe::query()->with('professeurs')->where('id', $classe)->first();

        foreach ($query as $q) {
            $param_mail = [
                'parent' => $q->eleve->_parent->nom,
                'eleve' => $q->eleve->nom . ' ' . $q->eleve->prenoms,
                'matricule' => $q->eleve->matricule,
                'classe' => $classe->nom
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
