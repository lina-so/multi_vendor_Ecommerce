<?php

namespace App\Http\Controllers\Vendor\Review;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterFields = $request->only(['rating', 'status']);
        $reviewQuery = Review::FilterByFields($filterFields,'reviews');

        $reviews = $reviewQuery->paginate();

        return view('vendor.reviews.index',compact('reviews'));
    }
/**********************************************************************************/
    public function updateStatus(Request $request) {

        $reviewId = $request->input('review_id');
        $status = $request->input('status');

        $review = Review::findOrFail($reviewId);
        $review->status = $status;
        $review->save();

        return response()->json(['success' => true]);
    }

}
