<?php

namespace App\Http\Controllers;

use App\Models\DinnerTable;
use App\Models\Game;
use App\Models\OpenMuseum;
use App\Models\Participant;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\json;

class ParticipantController extends Controller
{
    public function index(){
        $participants = Participant::with(['team', 'dinnerTable', 'openMuseum'])->get();

        $teams = Team::all();
        $dinner_table = DinnerTable::all();
        $open_museum = OpenMuseum::all();

        $data = [
            'teams' => $teams,
            'openMuseum' => $open_museum,
            'dinnerTable' => $dinner_table,
            'participants' => $participants,
        ];

        return view('participant', compact('data'));
    }

    public function store_participant(){
        $teams = Team::all();
        $dinner_table = DinnerTable::all();
        $open_museum = OpenMuseum::all();

        $data = [
            'teams' => $teams,
            'openMuseum' => $open_museum,
            'dinnerTable' => $dinner_table,
        ];

        return view('store-participant', compact('data'));
    }

    public function destroy_participant($id)
    {
        $score = Participant::findOrFail($id);
        $score->delete();

        return redirect()->route('participant')->with('success', 'Participant deleted successfully!');
    }

    public function edit_participant($id)
    {
        $participants = Participant::with(['team', 'dinnerTable', 'openMuseum'])->findOrFail($id);

        $teams = Team::all();
        $dinner_table = DinnerTable::all();
        $open_museum = OpenMuseum::all();

        $data = [
            'teams' => $teams,
            'openMuseum' => $open_museum,
            'dinnerTable' => $dinner_table,
            'participants' => $participants,
        ];

        return view('edit-participant', $data);
    }


    public function update_participant(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required',
            'full_name' => 'required',
            'id_team' => 'required',
            'id_open_museum' => 'required',
            'id_dinner_table' => 'required',
        ]);

        $participant = Participant::findOrFail($id);
        $participant->update([
            'code' => $request->nip,
            'full_name' => strtoupper($request->full_name),
            'id_team' => $request->id_team,
            'id_open_museum' => $request->id_open_museum,
            'id_dinner_table' => $request->id_dinner_table,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('participant')->with('success', 'Participant updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'full_name' => 'required',
            'id_team' => 'required',
            'id_open_museum' => 'required',
            'id_dinner_table' => 'required',
        ]);


        $existingParticipant = Participant::where('code', $request->nip)
        ->first();

        if ($existingParticipant) {
            return redirect()->back()->with('error', 'Participant has already been input.');
        }

        Participant::create([
            'code' => $request->nip,
            'full_name' => strtoupper($request->full_name),
            'id_team' => $request->id_team,
            'id_open_museum' => $request->id_open_museum,
            'id_dinner_table' => $request->id_dinner_table,
            'created_at' => Carbon::now(),
            // 'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Participant added successfully!');
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

    // public function amazingRaceRegister(Request $request){
    //     $code = $request->code;
    //     $full_name = strtolower($request->full_name);

    //     $participantByCode = Participant::where('code', $code)->first();

    //     $participantByName = Participant::whereRaw('LOWER(full_name) = ?', [$full_name])->first();

    //     // Case 1: NIP not found
    //     if (!$participantByCode && !$participantByName) {
    //         return redirect()->back()->with('error', 'Data tidak ditemukan!');
    //     }

    //     // Case 2: Name exists but NIP is wrong
    //     if ($participantByName && $participantByName->code != $code) {
    //         return redirect()->back()->with('error', 'NIP salah!');
    //     }

    //     // Case 3: NIP exists but name is wrong
    //     if ($participantByCode && strtolower($participantByCode->full_name) != $full_name) {
    //         return redirect()->back()->with('error', 'Nama salah!');
    //     }

    //     // Encode the ID
    //     $encodeId = Crypt::encrypt($participantByName->id);
    //     // dd($decodeId);

    //     // Redirect to the detail page
    //     return redirect()->route('amazingrace.detail', ['id' => $encodeId])
    //         ->with('success', 'Identification Success.');
    // }

    public function amazingRaceRegister(Request $request){
        $code = $request->code;
        $inputFullName = strtolower($request->full_name);

        $participantByCode = Participant::where('code', $code)->first();

        if ($participantByCode) {
            similar_text($inputFullName, strtolower($participantByCode->full_name), $similarityPercent);

            if ($similarityPercent > 80) {
                $encodeId = Crypt::encrypt($participantByCode->id);
                return redirect()->route('amazingrace.detail', ['id' => $encodeId])
                    ->with('success', 'Identification Success.');
            } else {
                return redirect()->back()->with('error', 'Nama kamu tidak ditemukan. Mohon pastikan nama yang kamu masukkan sesuai dengan Pro Int atau kartu identitasmu.');
            }
        } else {
            return redirect()->back()->with('error', 'NIP yang kamu masukkan salah. Silakan periksa kembali.');
        }
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
        $inputFullName = strtolower($request->full_name);

        $participantByCode = Participant::where('code', $code)->first();

        if ($participantByCode) {
            similar_text($inputFullName, strtolower($participantByCode->full_name), $similarityPercent);

            if ($similarityPercent > 80) {
                $encodeId = Crypt::encrypt($participantByCode->id);
                return redirect()->route('galadinner.detail', ['id' => $encodeId])
                    ->with('success', 'Identification Success.');
            } else {
                return redirect()->back()->with('error', 'Nama kamu tidak ditemukan. Mohon pastikan nama yang kamu masukkan sesuai dengan Pro Int atau kartu identitasmu.');
            }
        } else {
            return redirect()->back()->with('error', 'NIP yang kamu masukkan salah. Silakan periksa kembali.');
        }
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
        $inputFullName = strtolower($request->full_name);

        $participantByCode = Participant::where('code', $code)->first();

        if ($participantByCode) {
            similar_text($inputFullName, strtolower($participantByCode->full_name), $similarityPercent);

            if ($similarityPercent > 80) {
                $encodeId = Crypt::encrypt($participantByCode->id);
                return redirect()->route('openmuseum.detail', ['id' => $encodeId])
                    ->with('success', 'Identification Success.');
            } else {
                return redirect()->back()->with('error', 'Nama kamu tidak ditemukan. Mohon pastikan nama yang kamu masukkan sesuai dengan Pro Int atau kartu identitasmu.');
            }
        } else {
            return redirect()->back()->with('error', 'NIP yang kamu masukkan salah. Silakan periksa kembali.');
        }
    }

    public function openMuseumDetail($id){
        $decodeId = Crypt::decrypt($id);


        $participant = Participant::with(['team', 'dinnerTable', 'openMuseum'])->find($decodeId)->toArray();

        $data = [
            'participant' => $participant,
        ];

        return view('open-museum-detail', $data);
    }

    public function parseData($text) {
        // Mock-up of how you might begin to structure the parsing
        $entries = explode("\n\n", $text); // Assuming each entry is separated by two newlines
        $results = [];

        foreach ($entries as $entry) {
            $lines = explode("\n", $entry);
            $data = [];

            foreach ($lines as $line) {
                if (preg_match("/\[([^\]]+)\] => (.*)/", $line, $matches)) {
                    $key = trim($matches[1]);
                    $value = trim($matches[2]);
                    $data[$key] = $value;
                }
            }

            if (!empty($data)) {
                $results[] = $data;
            }
        }

        return $results;
    }

    public function normalizePhoneNumber($number) {
        // Remove any non-digits
        $number = preg_replace('/\D+/', '', $number);

        // Check if the number starts with '0' and replace with '+62'
        if (substr($number, 0, 1) === '0') {
            $number = '+62' . substr($number, 1);
        } elseif (substr($number, 0, 2) !== '62') {
            // Assume it's a local number missing the country code
            $number = '+62' . $number;
        } else {
            // It's likely already in the correct format, but ensure it starts with '+'
            $number = '+' . $number;
        }

        return $number;
    }

    public function wheel_of_name() {
        $data = Participant::select('full_name', 'code')->get()
            ->map(function ($participant) {
                return [
                    'full_name' => $participant->full_name,
                    'code' => $participant->code
                ];
            });

        // $data = [
        //     'full_name' => 'John Doe',
        //     'code' => '12345',
        // ];

        // Verify participants before passing to view
        // dd($participants);

        return view('wheel-of-name', compact('data'));
    }

}
