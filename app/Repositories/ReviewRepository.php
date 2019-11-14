<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository implements ReviewRepositoryInterface
{
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
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
=======
    public function store($data, $user) {
        $review = new Review();
        $review->comment = $data['comment'];
        $review->skin_color = $data['skin_color'];
        $review->rating = $data['rating'];
        $review->user_id = $user->id;
        $review->lipstick_color_id = $data['lipstick_color_id'];
        $review->save();

        return $review;



        // return $this->review->create($data);
    }

    public function update($review_id, $data) {
        $user = $data->user();

        $review = Review::findOrFail($review_id);
        $review->comment = $data->comment;
        $review->skin_color = $data->skin_color;
        $review->rating = $data->rating;
        $review->user_id = $user->id;
        $review->lipstick_color_id = $data->lipstick_color_id;
>>>>>>> Stashed changes
        $review->save();

        return $review;
    }

<<<<<<< Updated upstream
=======
    public function getModel()
    {
        return $this->review;
    }

>>>>>>> Stashed changes
    public function deleteById($review_id) {
        $review = Review::findOrFail($review_id);

        $review->delete();

        return $review->id;
    }
<<<<<<< Updated upstream

    public function getModel()
    {
        return $this->review;
    }
=======
>>>>>>> Stashed changes
}
