<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();

        return new JsonResponse($reservations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'arrival' => 'nullable|date',
            'weeknight' => 'nullable',
            'weekendnight' => 'nullable'
        ]);

        $record = Reservation::create($data);

        $registeredData = Reservation::latest('updated_at')->first();

        return response()->json([
            'success' => 'Création de votre réservation effectué avec succès.',
            'data' => new JsonResponse($registeredData)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $result = Reservation::where('id', '=', $reservation->id)->get();

        return new JsonResponse($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'arrival' => 'nullable|date',
            'weeknight' => 'nullable',
            'weekendnight' => 'nullable'
        ]);

        $record = Reservation::where('id', '=', $reservation->id)->update($data);

        $registeredData = Reservation::latest('updated_at')->first();
        
        return response()->json([
            'success' => 'Modification de votre réservation effectué avec succès.',
            'data' => new JsonResponse($registeredData)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $data = Reservation::where('id', '=', $reservation->id)->delete();

        return response()->json(['success' => 'Votre réservation a bien été annulée.']);
    }
}