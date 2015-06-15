<?php namespace WangDong\Http\Requests;

use WangDong\Http\Requests\Request;

class MenuRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $default = [
            'name' => 'required|max:32',
            'url' => 'max:32',
            'iconv' => 'max:32',
            'parent_id' => 'required|integer',
            'weight' => 'integer'
        ];
        //如果是父菜单不可修改
        if($this->is('*/update/*')){
            unset($default['parent_id']);
        }
        return $default;
	}

}
