<?php

namespace App\Http\Controllers;

use App\Models\SMS;
use App\Models\TypeSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    public function index()
    {
        $sms = SMS::with('typeSms')->latest()->get();
        $title = 'SMS Prédefinis';

        $param = [
            'sms' => $sms,
            'title' => $title
        ];

        return view('sms.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'SMS Prédefinis';
        $typeSms = TypeSMS::oldest('libelle')->get();

        $param = [
            'title' => $title,
            'typeSms' => $typeSms,
        ];

        return view('sms.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'typeSms' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sms = SMS::create([
            'message' => $request->message,
            'date_envoi' => $request->date_envoi,
            'typesms_id' => $request->typeSms,
        ]);

        $sms->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('sms.all');
    }

    public function showUpdateForm(int $id)
    {
        $sms = SMS::where('id', $id)->first();
        $typeSms = TypeSMS::oldest('libelle')->get();
        $title = 'Type de l\'annonce';

        $param = [
            'sms' => $sms,
            'title' => $title,
            'typeSms' => $typeSms
        ];

        return view('sms.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dataID' => 'required|numeric',
            'typeSms' => 'required|numeric',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sms = SMS::where('id', $request->dataID)->first();

        if($sms==null) return redirect()->back();

        $sms->typesms_id = $request->typeSms;
        $sms->message = $request->message;
        $sms->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $sms = SMS::where('id', $id)->first();
        if($sms==null) return redirect()->back();

        $sms->delete();
        return redirect()->back();
    }
}
