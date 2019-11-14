<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository implements ReviewRepositoryInterface
{
    protected $review;

    public function __construct(Review $review){
        $this->review = $review;
    }

    public function findAll() {
        return Review::all();
    }

    public function findById($review_id) {
        return Review::findOrFail($review_id);
    }

    public function store($data,$lipstickColor_id, $user) {
        $review = new Review();
        $review->comment = $data['comment'];
        $review->skin_color = $user->skin_color;
        $review->rating = $data['rating'];
        $review->user_id = $user->id;
        $review->lipstick_color_id = $lipstickColor_id;

        $review->save();

        return $review;
    }

    public function update($review_id, $lipstickColor_id, $user, $data) {
        $review = Review::findOrFail($review_id);
        $review->comment = $data['comment'];
        $review->skin_color = $user->skin_color;
        $review->rating = $data['rating'];
        $review->user_id = $user->id;
        $review->lipstick_color_id = $lipstickColor_id;
        $review->save();

        return $review;
    }

    public function deleteById($review_id) {
        $review = Review::findOrFail($review_id);

        $review->delete();

        return $review->id;
    }

    public function getModel()
    {
        return $this->review;
    }
}
