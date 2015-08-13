<?php namespace App\Http\Controllers;

use grability\repositories\CalculusRepository;

class CalculusController extends Controller {

	protected $calculusR;
	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct(CalculusRepository $calculusR)
	{
	
		$this->calculusR = $calculusR;
	}
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function hola()
	{

		$liz = $this->calculusR->getN("2\n1 2");
		return view('hola', compact('liz'));
	}

	public function calculus()
	{
		return 'result';
	}
}
