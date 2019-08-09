<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Http\Resources\LipstickImageResource;
use App\Repositories\LipstickImageRepositoryInterface;
use App\Repositories\LipstickImageRepository;
use App\Models\LipstickImage;
use App\Models\LipstickColor;

class LipstickImageController extends Controller
{
    private $storageDisk = 's3';
    protected $lipstickImageRepository;

    public function __construct(LipstickImage $lipstickImage) {
        $this->lipstickImageRepository = new LipstickImageRepository($lipstickImage);
    }

    public function getAllLipstickImage () {
        $lipstickImages = $this->lipstickImageRepository->findAll();

        return LipstickImageResource::collection($lipstickImages);
    }

    public function getLipstickImageById ($lipstickImage_id) {
        $lipstickImage = $this->lipstickImageRepository->findById($lipstickImage_id);

        return new LipstickImageResource($lipstickImage);
    }

    public function createLipstickImage (Request $request) {
        $this->validate($request, [
            'image' => 'required|String',
            'lipstick_color_id' => 'required|Integer'
        ]);


        return $this->lipstickImageRepository->store($request->only($this->lipstickImageRepository->getModel()->fillable));
    }

    public function updateLipstickImageById (Request $request, $lipstickImage_id) {
        $this->validate($request, [
            'image' => 'required|String',
            'lipstick_color_id' => 'required|Integer'
        ]);

        $lipstickImage = $this->lipstickImageRepository->update($lipstickImage_id, $request);

        return new LipstickImageResource($lipstickImage);
    }

    public function storeFileToImage(Request $request){
        $this->validate($request, [
            'image' => 'required|String',
            'lipstick_color_id' => 'required|Integer'
        ]);

        return $this->lipstickImageRepository->store($request->only($this->lipstickImageRepository->getModel()->fillable));

        return new LipstickImageResource($lipstickImage);
    }

    public function deleteLipstickImageById ($lipstickImage_id) {
        $lipstickImage_id = $this->lipstickImageRepository->deleteById($lipstickImage_id);

        return $lipstickImage_id;
    }
}
