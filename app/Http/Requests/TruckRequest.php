<?php namespace WangDong\Http\Requests;

use WangDong\Http\Requests\Request;

class TruckRequest extends Request {

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
			'province' => 'required|max:12',
            'city' => 'required|max:12',
            'district' => 'required|max:12',
            'address' => 'required',
            'license_plate' => 'required|max:12'
		];
	}

}
