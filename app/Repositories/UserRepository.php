<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }


    public function findAll() {
        return User::all();
    }

    public function findById($user_id) {
        return User::findOrFail($user_id);
    }

    public function store($data) {
        return $this->user->create($data);
    }

    public function update($user_id, $data) {
        $user = User::findOrFail($user_id);
        if ($data['image'] != null){
            Storage::disk('s3')->delete($user->path);

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/user/'. $user_id. '/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $user->image = $url;
            $user->path = $file_path;
        }

        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->gender = $data['gender'];
        $user->skin_color = $data['skin_color'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    public function getModel()
    {
        return $this->user;
    }

    public function deleteById($user_id) {
        $user = User::findOrFail($user_id);

        Storage::disk('s3')->delete($user->path);

        $user->delete();

        return $user->id;
    }
}
