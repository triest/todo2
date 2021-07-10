<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 22.07.2020
 * Time: 19:43
 */

namespace App\Service;


use App\Models\Album;
use App\Models\AlbumPhoto;
use App\Models\Lk\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumService
{
    public $user = null;

    public $image = null;

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    /**
     * @param Request|null $request
     */
    public function setRequest(?Request $request): void
    {
        $this->request = $request;
    }

    public $request = null;

    /**
     * AlbumService constructor.
     */
    public function __construct(User $user = null, Request $request = null)
    {
        if ($user == null) {
            $this->user = Auth::user();
        } else {
            $this->user = $user;
        }
        $this->request = $request;
    }

    public function getAlbums()
    {
        $albums = $this->user->albums()->get();
        if ($albums->isEmpty()) {
            $album = new Album();
            $album->name = "Основной альбом";
            $album->save();
            $this->user->albums()->save($album);
            $albums->push($album);
        }


        return $albums;
    }

    public function getAlbum($id)
    {
        return Album::select(['*'])->where('id', $id)->first();
    }

    public function uploadAlbumImage($album)
    {
        $path = $this->image->store('public/profile/album');
        $alpumPhoto = new AlbumPhoto();
        $alpumPhoto->url = 'storage/app/' . $path;
        $alpumPhoto->short_patch=$path;
        $alpumPhoto->save();
        $album->Photos()->save($alpumPhoto);

        return $alpumPhoto;
    }

    public function deletePhoto(AlbumPhoto $photo)
    {

        if (Storage::exists($photo->short_patch)&& Storage::delete($photo->short_patch)) {
            $photo->delete();
           return true;
        } else {
            return false;
        }
    }

}
