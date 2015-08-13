<?php namespace App\Http\Controllers;

use App\Http\Requests\CalculusRequest;
use grabbackend\repositories\CalculusRepository;

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
		return view('hola');
	}

	public function calculus(CalculusRequest $request)
	{
		$pinput = $request->text;
		
		$pt = $this->calculusR->getT($pinput);
		$pN = $this->calculusR->getN($pinput);
		$pM = $this->calculusR->getM($pinput);
		
		$exercise = $this->calculusR->compute($pinput);

		return view('results', compact('exercise'));
	}
	
}
