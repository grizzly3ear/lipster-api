<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

use App\Models\TrendGroup;

class TrendGroupRepository implements TrendGroupRepositoryInterface
{

    protected $trendGroup;

    public function __construct(TrendGroup $trendGroup){
        $this->trendGroup = $trendGroup;
    }

    public function findAll() {
        return TrendGroup::all();
    }

    public function findById($trend_group_id) {
        return TrendGroup::findOrFail($trend_group_id);
    }

    public function store($data) {
        $trendGroup = new TrendGroup();
        if (!is_null($data['image'])){

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/trendGroup/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $trendGroup->image = $url;
            $trendGroup->path = $file_path;
        }
        $trendGroup->name = $data['name'];
        $trendGroup->description = $data['description'];
        $trendGroup->release_date = $data['release_date'];
        $trendGroup->save();

        return $trendGroup;
    }

    public function update($trend_group_id, $data) {
        $trendGroup = $this->findById($trend_group_id);

        if (!is_null($data['image'])){
            Storage::disk('s3')->delete($trendGroup->path);

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/trendGroup/'. $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $trendGroup->image = $url;
            $trendGroup->path = $file_path;
        }
        $trendGroup->name = $data['name'];
        $trendGroup->description = $data['description'];
        $trendGroup->release_date = $data['release_date'];
        $trendGroup->save();

        return $trendGroup;
    }

    public function deleteById($trend_group_id) {
        $trendGroup = $this->findById($trend_group_id);

        Storage::disk('s3')->delete($trendGroup->path);

        $trendGroup->delete();

        return $trendGroup->id;
    }

    public function getModel()
    {
        return $this->trendGroup;
    }
}
