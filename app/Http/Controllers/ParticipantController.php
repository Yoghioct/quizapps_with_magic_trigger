<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ParticipantController extends Controller
{
    public function index(){
        $participants = Participant::with(['team', 'dinnerTable'])->get();

        return view('participant', compact('participants'));
    }

    public function amazingRace(){
        return view('amazing-race');

        // $participant = Participant::with(['team', 'dinnerTable'])->find(1)->toArray();

        // dd($participant);
        // if (!$participant) {
        //     dd('Participant not found');
        // }

        // dd([
        //     'Participant' => $participant,
        //     'Team' => $participant->team,
        //     'DinnerTable' => $participant->dinnerTable,
        // ]);
    }

    public function amazingRaceRegister(Request $request){
        $code = $request->code;
        $full_name = strtolower($request->full_name);

        $participantByCode = Participant::where('code', $code)->first();

        $participantByName = Participant::whereRaw('LOWER(full_name) = ?', [$full_name])->first();

        // Case 1: NIP not found
        if (!$participantByCode && !$participantByName) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        // Case 2: Name exists but NIP is wrong
        if ($participantByName && $participantByName->code != $code) {
            return redirect()->back()->with('error', 'NIP salah!');
        }

        // Case 3: NIP exists but name is wrong
        if ($participantByCode && strtolower($participantByCode->full_name) != $full_name) {
            return redirect()->back()->with('error', 'Nama salah!');
        }

        // Encode the ID
        $encodeId = Crypt::encrypt($participantByName->id);
        // dd($decodeId);

        // Redirect to the detail page
        return redirect()->route('amazingrace.detail', ['id' => $encodeId])
            ->with('success', 'Identification Success.');
    }

    public function amazingRaceDetail($id){
        $decodeId = Crypt::decrypt($id);

        $participant = Participant::with(['team', 'dinnerTable'])->find($decodeId)->toArray();

        $data = [
            'participant' => $participant,
        ];

        return view('amazing-race-detail', $data);
    }

    public function amazingRaceParticipant($id){
        // $participant = Participant::find(1);

        // dd($participant);
    }

    public function galaDinner(){
        return view('gala-dinner');
    }

    public function galaDinnerRegister(Request $request){
        $code = $request->code;
        $full_name = strtolower($request->full_name);

        $participantByCode = Participant::where('code', $code)->first();

        $participantByName = Participant::whereRaw('LOWER(full_name) = ?', [$full_name])->first();

        // Case 1: NIP not found
        if (!$participantByCode && !$participantByName) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        // Case 2: Name exists but NIP is wrong
        if ($participantByName && $participantByName->code != $code) {
            return redirect()->back()->with('error', 'NIP salah!');
        }

        // Case 3: NIP exists but name is wrong
        if ($participantByCode && strtolower($participantByCode->full_name) != $full_name) {
            return redirect()->back()->with('error', 'Nama salah!');
        }

        // Encode the ID
        $encodeId = Crypt::encrypt($participantByName->id);
        // dd($decodeId);

        // Redirect to the detail page
        return redirect()->route('galadinner.detail', ['id' => $encodeId])
            ->with('success', 'Identification Success.');
    }

    public function galaDinnerDetail($id){
        $decodeId = Crypt::decrypt($id);

        $participant = Participant::with(['team', 'dinnerTable'])->find($decodeId)->toArray();

        $data = [
            'participant' => $participant,
        ];

        return view('gala-dinner-detail', $data);
    }

    public function openMuseum(){
        return view('open-museum');
    }

    public function openMuseumRegister(Request $request){
        $code = $request->code;
        $full_name = strtolower($request->full_name);

        $participantByCode = Participant::where('code', $code)->first();

        $participantByName = Participant::whereRaw('LOWER(full_name) = ?', [$full_name])->first();

        // Case 1: NIP not found
        if (!$participantByCode && !$participantByName) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        // Case 2: Name exists but NIP is wrong
        if ($participantByName && $participantByName->code != $code) {
            return redirect()->back()->with('error', 'NIP salah!');
        }

        // Case 3: NIP exists but name is wrong
        if ($participantByCode && strtolower($participantByCode->full_name) != $full_name) {
            return redirect()->back()->with('error', 'Nama salah!');
        }

        // Encode the ID
        $encodeId = Crypt::encrypt($participantByName->id);
        // dd($decodeId);

        // Redirect to the detail page
        return redirect()->route('openmuseum.detail', ['id' => $encodeId])
            ->with('success', 'Identification Success.');
    }

    public function openMuseumDetail($id){
        $decodeId = Crypt::decrypt($id);


        $participant = Participant::with(['team', 'dinnerTable', 'openMuseum'])->find($decodeId)->toArray();

        $data = [
            'participant' => $participant,
        ];

        return view('open-museum-detail', $data);
    }
}
