<?php namespace WangDong;

use Illuminate\Database\Eloquent\Model;

class GoodsCategory extends Model {

    public $timestamps = false;

    protected static $structure = [
        'left'			=> 'left',
        'right'			=> 'right',
        'level'			=> 'level',
        'position'		=> 'position',
        'name'          => 'name'
    ];


    protected $guarded = ['id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
        //添加事件
        self::creating(function($category){
            //更新位置
            static::where(static::$structure['position'],'>=',$category->position)->increment('position');
            //更新左边索引
            static::where(static::$structure['right'],'>=',$category->left)->increment('left',2);
            //更新右边索引
            static::where(static::$structure['right'],'>=',$category->right)->increment('right',2);

        });
    }

    public function parent(){
        return $this->belongsTo('\WangDong\GoodsCategory','parent_id');
    }

    public function children(){
        return $this->hasMany('\WangDong\GoodsCategory','parent_id');
    }

    public static function createNode($parent_id){
        $parent = static::findOrFail($parent_id);
        $children = $parent->children;
        return new static([
            static::$structure['left'] => $parent->right + 1,
            static::$structure['right'] => $parent->right + 2,
            static::$structure['postion'] => count($children),
            static::$structure['name']   => 'new node'
        ]);
    }

    public function getPath(){
        return static::where(function($query){
            $query->where(static::$structure['left'],'<',$this->left)->where(static::$structure['right'],'>',$this->right);
        })->orderBy(static::$structure['left'],'asc')->get();
    }

    public function getChildren($level= '*'){
        return static::where(function($query)use($level){
            $query->where(static::$structure['left'],'>',$this->left)->where(static::$structure['right'],'<',$this->right);
            if('*' != $level){
                $query->where(static::$structure['level'],'>=',$this->level + $level);
            }
        })->orderBy(static::$structure['left'],'asc')->get();
    }

}
