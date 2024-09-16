<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Http\Requests\StoreContactUsRequest;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
	public function contactUs()
    {
        return view('pages.admin.contact_us');
    }

	public function getContactUs(Request $request)
    {
        $contactUs = ContactUs::all();
            
        
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $search = $request->input('search')['value'];
            $contactUs->where(function ($query) use ($search) {
                $query->where('full_name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        return datatables()->of($contactUs)
			->addColumn('action', function ($item) {
				return '<a href="#" class="btn btn-sm btn-danger delete" data-id="'.$item->id.'">Delete</a>';
			})
			->toJson();
    }

    public function store(StoreContactUsRequest $request)
    {
		ContactUs::create([
			'full_name' => $request->full_name,
			'email' => $request->email,
			'message' => $request->message
		]);

        return redirect()->route('contactus');
    }

	public function destroy($id)
    {
        $item = ContactUs::find($id);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }
}
