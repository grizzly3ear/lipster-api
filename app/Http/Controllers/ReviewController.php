<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Resources\ReviewResource;
use App\Repositories\ReviewRepositoryInterface;
use App\Repositories\ReviewRepository;
use App\Models\Review;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(Review $review) {
        $this->reviewRepository = new ReviewRepository($review);
    }

    public function getAllReview () {
        $reviews = $this->reviewRepository->findAll();

        return ReviewResource::collection($reviews);
    }

    public function getReviewById ($review_id) {
        $review = $this->reviewRepository->findById($review_id);

        return new ReviewResource($review);
    }

    public function createReview (Request $request) {
        $this->validate($request, [
            'comment' => 'required|max:255|String',
            'skin_color' => 'required|String',
            'rating' => 'required|Integer',
            'lipstick_color_id' => 'required|Integer'
        ]);

        $user = $request->user();

        return $this->reviewRepository->store($request->only($this->reviewRepository->getModel()->fillable), $user);
    }

    public function updateReviewById (Request $request, $lipstick_color_id, $review_id) {
        // $this->validate($request, [
        //     'comment' => 'required|max:255|String',
        //     'skin_color' => 'required|String',
        //     'rating' => 'required|Integer',
        //     'lipstick_color_id' => 'required|Integer'
        // ]);
        $body = $request->input();
        $review = $this->reviewRepository->update($review_id, $request->user(), $body);

        return new ReviewResource($review);
    }

    public function deleteReviewById ($lipstick_color_id,$review_id) {
        $review_id = $this->reviewRepository->deleteById($review_id);

        return $review_id;
    }
}
