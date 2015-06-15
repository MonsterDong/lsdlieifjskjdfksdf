<?php namespace WangDong\Http\Requests;

use WangDong\Http\Requests\Request;

class UserRequest extends Request {

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'group_id' => 'exists:groups,id'
        ];
        //如果是修改则密码重置可选
        if($this->is('*/edit/*')){
            $default['password'] = 'min:6';
            unset($default['email']);
        }
		return $default;
	}

}
