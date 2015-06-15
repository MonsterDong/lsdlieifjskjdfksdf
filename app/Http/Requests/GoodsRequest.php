<?php namespace WangDong\Http\Requests;

use WangDong\Http\Requests\Request;

class GoodsRequest extends Request {

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
		return [
            'title'    => 'required|between:1,64',
            'price'    => 'required|numeric',
            'unit_id'  => 'required|exists:units,id',
            'weight'   => 'required|numeric',
            'gc_id'    => 'required|exists:goods_categories,id'
		];
	}

}
