<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\StayDetail;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TenantController extends Controller
{
    // Get all tenants
    public function index()
    {
        return response()->json(Tenant::all(), 200);
    }

    // Store a new tenant
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'building_id' => 'required|exists:buildings,id',
                'room_id' => 'required|exists:rooms,id',
                'unit_type' => 'required|string',
                'floor' => 'required|string',
                'sharing_type' => 'required|string',
                'daily_stay_charges_min' => 'required|numeric',
                'daily_stay_charges_max' => 'required|numeric',
                'is_room_available' => 'required|boolean',
                'electricity_reading_last' => 'required|numeric',
                'electricity_reading_date' => 'required|date',
                'room_photos' => 'nullable|string'
            ]);


            //dd($validatedData);

            $tenant = Tenant::create($validatedData);


            return response()->json($tenant, 200);
        } catch (\Exception $e) {
            Log::error('Error storing tenant: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to store tenant'], 500);
        }
    }

    // Get a tenant by ID
    public function show(Tenant $tenant)
    {
        return response()->json($tenant, 200);
    }

    // Update a tenant
    public function update(Request $request, Tenant $tenant)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'building_id' => 'required|exists:buildings,id',
            'room_id' => 'required|exists:rooms,id',
            'unit_type' => 'required|string',
            'floor' => 'required|string',
            'sharing_type' => 'required|string',
            'daily_stay_charges_min' => 'required|numeric',
            'daily_stay_charges_max' => 'required|numeric',
            'is_room_available' => 'required|boolean',
            'electricity_reading_last' => 'required|numeric',
            'electricity_reading_date' => 'required|date',
            'room_photos' => 'nullable|string'
        ]);


        //Log::info('Validated Data: ', $validatedData);


        $tenant->update($validatedData);
        return response()->json($tenant, 201);
    }

    // Delete a tenant
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return response()->json(null, 204);
    }

    // Store stay details for a tenant
    public function storeStayDetails(Request $request, Tenant $tenant)
    {
        try {
            $validatedData = $request->validate([
                'stay_start_date' => 'required|date',
                'stay_end_date' => 'nullable|date',
                'move_in_date' => 'nullable|date',
                'move_out_date' => 'nullable|date',
                'lock_in_period' => 'nullable|integer',
                'notice_period' => 'nullable|integer',
                'agreement_period' => 'nullable|integer',
                'rental_frequency' => 'nullable|string',
                'remark' => 'nullable|string',
                'regular_security_deposit' => 'nullable|integer',
                'fixed_rent' => 'nullable|integer',
                // 'add_rent_on' => 'nullable|integer',  // Ensure this is set to integer
                'electricity_meter_details' => 'nullable|json',
            ]);

            $validatedData['tenant_id'] = $tenant->id;

            $stayDetail = StayDetail::create($validatedData);

            return response()->json($stayDetail, 201);
        } catch (\Exception $e) {
            Log::error('Error storing stay details: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to store stay details'], 500);
        }
    }


    // Store payment details for a tenant
    public function storePaymentDetails(Request $request, $tenant_id)
    {
        try {
            $validatedData = $request->validate([
                'payment_date' => 'required|date',
                'amount_paid' => 'required|numeric',
                'due_amount' => 'nullable|numeric',
                'due_date' => 'nullable|date',
                'description' => 'nullable|string'
            ]);

            // Include tenant_id in the data to be stored
            $validatedData['tenant_id'] = $tenant_id;

            $paymentDetail = PaymentDetail::create($validatedData);

            return response()->json($paymentDetail, 201);
        } catch (\Exception $e) {
            Log::error('Error storing payment details: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to store payment details'], 500);
        }
    }
}
