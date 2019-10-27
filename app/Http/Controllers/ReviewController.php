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

    public function createReview (Request $request, $lipstickColor_id) {

        $user = $request->user();

        return $this->reviewRepository->store($request->only($this->reviewRepository->getModel()->fillable), $lipstickColor_id, $user);
    }

    public function updateReviewById (Request $request, $lipstickColor_id, $review_id) {
        $review = $this->reviewRepository->update($review_id, $lipstickColor_id, $request->user(), $request->only($this->reviewRepository->getModel()->fillable));

        return new ReviewResource($review);
    }

    public function deleteReviewById ($review_id) {
        $review_id = $this->reviewRepository->deleteById($review_id);

        return $review_id;
    }
}
