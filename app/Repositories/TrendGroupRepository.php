<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        // $trendGroup->release_date = $data['release_date'];
        $trendGroup->save();

        return $trendGroup;
    }

    public function update($trend_group_id, $data) {
        $trendGroup = $this->findById($trend_group_id);
        if (!is_null($data['image'])){

            if(Str::substr($data['image'], 0, 4) == "http"){
                $trendGroup->image = $data['image'];
            }else{
            Storage::disk('s3')->delete($trendGroup->path);

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/trendGroup/'. $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $trendGroup->image = $url;
            $trendGroup->path = $file_path;
            }
        }
        $trendGroup->name = $data['name'];
        $trendGroup->description = $data['description'];
        $trendGroup->release_date = $data['release_date'];
        $trendGroup->save();

        return $trendGroup;
    }

    public function deleteById($request, $trend_group_id) {
        $trendGroup = $this->findById($trend_group_id);

        Storage::disk('s3')->delete($trendGroup->path);

        if(!is_null($request['force'])){
            if($request['force']){
                $trendGroup->delete();
                return 1;
            }else{
                if(count($trendGroup->trends)){
                    return 0;
                } else {
                    $trendGroup->delete();

                    return 1;
                }
            }
        }
    }

    public function getModel()
    {
        return $this->trendGroup;
    }
}
