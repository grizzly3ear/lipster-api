<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

use App\Models\LipstickImage;

class LipstickImageRepository implements LipstickImageRepositoryInterface
{

    protected $lipstickImage;

    public function __construct(LipstickImage $lipstickImage){
        $this->lipstickImage = $lipstickImage;
    }

    public function findAll() {
        return LipstickImage::all();
    }

    public function findById($lipstickImage_id) {
        return LipstickImage::findOrFail($lipstickImage_id);
    }

    public function store(array $data) {
        $images = new LipstickImage();
        if (!is_null($data['image'])){

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/lipstickColor/'. $data['lipstick_color_id']. '/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $images->image = $url;
            $images->path = $file_path;
        }
        $images->lipstick_color_id = $data['lipstick_color_id'];
        $images->save();

        return $images;
    }

    public function update($lipstickImage_id, $data) {
        if(!is_null($lipstickImage_id)){
            $lipstickImage = LipstickImage::findOrFail($lipstickImage_id);
        }else{
            $lipstickImage = new LipstickImage();
        }

        if (!is_null($data['image'])){
            if(!is_null($lipstickImage->path)){
                Storage::disk('s3')->delete($lipstickImage->path);
            }

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/lipstickColor/'. $data['lipstick_color_id']. '/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $lipstickImage->image = $url;
            $lipstickImage->path = $file_path;
        }
        $lipstickImage->lipstick_color_id = $data['lipstick_color_id'];
        $lipstickImage->save();

        return $lipstickImage;
    }

    public function deleteById($lipstickImage_id) {
        $lipstickImage = LipstickImage::findOrFail($lipstickImage_id);

        Storage::disk('s3')->delete($lipstickImage->path);

        $lipstickImage->delete();

        return $lipstickImage->id;
    }

    public function getModel()
    {
        return $this->lipstickImage;
    }
}
