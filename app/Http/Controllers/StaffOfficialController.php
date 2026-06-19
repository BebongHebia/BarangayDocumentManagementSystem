<?php

namespace App\Http\Controllers;

use App\Models\StaffOfficial;
use Illuminate\Http\Request;

class StaffOfficialController extends Controller
{
    public function addStaffOfficial(Request $request){
        if ($request->position == "Punong Barangay"){
            $getExistingPositioncount = StaffOfficial::where("position", "Punong Barangay")->where("status", "Active")->count();
            if ($getExistingPositioncount == 0){
                StaffOfficial::create([
                    'completeName' => $request->completeName,
                    'sex' => $request->sex,
                    'bday' => $request->bday,
                    'birthPlace' => $request->birthPlace,
                    'civilStatus' => $request->civilStatus,
                    'position' => $request->position,
                    'status' => "Active",
                    'code' => date("Ymdhis"),
                ]);

                return response()->json(); // Explicit success response
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'There is an existing Punong Barangay. Please make sure you disable the existing Punong Barangay before adding another.',
                ]);
            }
        } else if ($request->position == "Kagawad"){
            $getExistingPositioncount = StaffOfficial::where("position", "Kagawad")->where("status", "Active")->count();
            if ($getExistingPositioncount < 7){ // Changed from <= to <
                StaffOfficial::create([
                    'completeName' => $request->completeName,
                    'sex' => $request->sex,
                    'bday' => $request->bday,
                    'birthPlace' => $request->birthPlace,
                    'civilStatus' => $request->civilStatus,
                    'position' => $request->position,
                    'status' => "Active",
                    'code' => date("Ymdhis"),
                ]);

                return response()->json();
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to add new Kagawad. Only 7 Kagawad should be listed as active. Please remove or deactivate a Kagawad before adding a new one.',
                ]);
            }
        } else if ($request->position == "Secretary"){
            $getExistingPositioncount = StaffOfficial::where("position", "Secretary")->where("status", "Active")->count();
            if ($getExistingPositioncount == 0){ // Changed from == 7 to == 0
                StaffOfficial::create([
                    'completeName' => $request->completeName,
                    'sex' => $request->sex,
                    'bday' => $request->bday,
                    'birthPlace' => $request->birthPlace,
                    'civilStatus' => $request->civilStatus,
                    'position' => $request->position,
                    'status' => "Active",
                    'code' => date("Ymdhis"),
                ]);

                return response()->json();
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'There is already an active Secretary.',
                ]);
            }
        } else if ($request->position == "Treasurer"){
            $getExistingPositioncount = StaffOfficial::where("position", "Treasurer")->where("status", "Active")->count();
            if ($getExistingPositioncount == 0){ // Changed from == 7 to == 0
                StaffOfficial::create([
                    'completeName' => $request->completeName,
                    'sex' => $request->sex,
                    'bday' => $request->bday,
                    'birthPlace' => $request->birthPlace,
                    'civilStatus' => $request->civilStatus,
                    'position' => $request->position,
                    'status' => "Active",
                    'code' => date("Ymdhis"),
                ]);

                return response()->json();
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'There is already an active Treasurer.',
                ]);
            }
        }
    }
    public function getStaffOfficials()
    {
        $staffOfficials = StaffOfficial::orderBy('position')->get();

        return response()->json([
            'success' => true,
            'data' => $staffOfficials
        ]);
    }
    public function toggleStatus($code){
        $official = StaffOfficial::where('code', $code)->first();

        if (!$official) {
            return response()->json([
                'success' => false,
                'message' => 'Staff/Official not found'
            ]);
        }

        $official->status = $official->status == 'Active' ? 'Inactive' : 'Active';
        $official->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

        public function editStatus(Request $request){
        $data = StaffOfficial::find($request->staffId);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Staff member not found'
            ], 404);
        }

        // Check if trying to deactivate
        $isDeactivating = $request->status == 'Inactive' || $request->status == 'Deactivated';

        // If deactivating, no need to check position limits
        if ($isDeactivating) {
            $data->status = $request->status;
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Staff member deactivated successfully'
            ]);
        }

        // For activation, check position limits
        $position = $data->position;
        $maxAllowed = $this->getMaxAllowedForPosition($position);
        $currentActive = StaffOfficial::where('status', 'Active')
            ->where('position', $position)
            ->count();

        if ($currentActive < $maxAllowed) {
            $data->status = 'Active';
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Staff member activated successfully'
            ]);
        } else {
            $positionName = $position;
            $maxCount = $maxAllowed;
            return response()->json([
                'success' => false,
                'message' => "Cannot activate {$positionName}. Maximum of {$maxCount} active {$positionName}(s) allowed."
            ], 400);
        }
    }

    private function getMaxAllowedForPosition($position){
        $limits = [
            'Punong Barangay' => 1,
            'Kagawad' => 7,
            'Secretary' => 1,
            'Treasurer' => 1
        ];

        return $limits[$position] ?? 0;
    }

    public function deleteStatus(Request $request){
        $data = StaffOfficial::find($request->staffId);
        $data->delete();

        return response()->json();
    }
}
