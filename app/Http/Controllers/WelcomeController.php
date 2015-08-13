<?php namespace App\Http\Controllers;

use grability\repositories\CalculusRepository;

class WelcomeController extends Controller {

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
	/*public function __construct()
	{
		$this->middleware('guest');
	}*/

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
		//$liz = $this->doit();
		
		$liz = $this->calculusR->doit(2);
		return view('hola', compact('liz'));
		//return view('hola');
	}

	public function doit()
	{
		return 'Lizzie';
	}
}
