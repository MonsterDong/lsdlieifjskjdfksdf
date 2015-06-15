<?php
/**
 * Created by PhpStorm.
 * User: dongdong
 * Date: 2015/5/12
 * Time: 10:05
 */

namespace WangDong\Services;
use Request;
use Validator;
use Config;
use Storage;

class GoodsImage {

    protected $cover_width = 246;

    protected $cover_height = 184;

    protected $cover_save_path;

    protected $storage;

    public function __construct(){
        $this->cover_save_path = Config::get("filesystems.disks.goodsimage.root");

        $this->storage = Storage::disk('goodsimage');
    }

    public function saveCover(){

        if(!Request::hasFile('cover-upload')){
            return false;
        }

        $cover = Request::file('cover-upload');

        $file = $cover->move($this->cover_save_path,time().'.'.$cover->getClientOriginalExtension());

        $validator = Validator::make(['file'=>$file],['file'=>'image']);

        if($validator->fails()){
            $this->storage->delete($file->getFilename());
            return false;
        }

        $image = getimagesize($file->getRealPath());

        if($image[0] != $this->cover_width || $image[1] != $this->cover_height){
            $this->storage->delete($file->getFilename());
            return false;
        }
        return $file;
    }
} 