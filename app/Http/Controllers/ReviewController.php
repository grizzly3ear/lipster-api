<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
    public function createReview (Request $request, $lipstickColor_id) {

        $user = $request->user();

        return $this->reviewRepository->store($request->only($this->reviewRepository->getModel()->fillable), $lipstickColor_id, $user);
    }

    public function updateReviewById (Request $request, $lipstickColor_id, $review_id) {
        $review = $this->reviewRepository->update($review_id, $lipstickColor_id, $request->user(), $request->only($this->reviewRepository->getModel()->fillable));
=======
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

    public function updateReviewById (Request $request, $review_id) {
        $this->validate($request, [
            'comment' => 'required|max:255|String',
            'skin_color' => 'required|String',
            'rating' => 'required|Integer',
            'user_id' => 'required|Integer',
            'lipstick_color_id' => 'required|Integer'
        ]);
        $review = $this->reviewRepository->update($review_id, $request);
>>>>>>> Stashed changes

        return new ReviewResource($review);
    }

    public function deleteReviewById ($review_id) {
        $review_id = $this->reviewRepository->deleteById($review_id);

        return $review_id;
    }
}
