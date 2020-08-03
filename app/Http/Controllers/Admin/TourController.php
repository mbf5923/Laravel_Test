<?php


namespace App\Http\Controllers\Admin;


use App\Agency;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyResource;
use App\Http\Resources\AgencyResourceCollection;
use App\tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TourController extends Controller
{
    protected $tour,$agency;

    public function __construct(Tour $tour,Agency $agency)
    {
        $this->tour = $tour;
        $this->agency=$agency;
    }

    public function createTour(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'agency_id' => 'required|exists:agency,id,user_id,' . Auth::id(),
            'name' => 'required|max:255',
        ]);
        if ($validated->fails()) {
            return $this->failedValidationResponse($validated->errors());
        }
        $this->tour->createTour($request->only(['name', 'agency_id']));

        return $this->SuccessResponse();
    }

    public function getTourById($id)
    {
        return $this->tour->getTourById($id);

    }




}
