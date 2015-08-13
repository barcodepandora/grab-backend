<?php namespace grability\repositories;

class CalculusRepository {

	//
	private $pT;
	private $pN;
	private $pM;
	private $matrix;
	private $pinput;
	private $ainput;

	/**
	 * Create a new repository instance.
	 *
	 * @return void
	 */

	public function __construct()
	{
	
	}
		
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function doit($id)
	{
		return 'Sandy';
	}

	/**
	 * Do all.
	 */
	public function doAll($pinput)
	{
		
		$this->pinput = $pinput;
		$this->pT = $this->getT($this->pinput);
		$this->pN = $this->getN($this->pinput);
	}

	/**
	 * Gets T.
	 */
	public function getT($pinput)
	{
		$this->ainput = explode("\n", $pinput);
		$this->pT = -1;
		if ( (int)$this->ainput[0] > 0 ) {
		
			$this->pT = (int)$this->ainput[0];
		}
		return $this->pT;
	}

	/**
	 * Gets N.
	 */	
	public function getN($pinput)
	{

		$this->ainput = explode("\n", $pinput);
		$this->pN = -1;
		$blocks = explode(" ", $this->ainput[1])[0]; // Numero de bloques
		if ( (int)$blocks > 0 ) {
		
			$this->pN = (int)$blocks;
		}
		return $this->pN;
	}

	/**
	 * Gets M.
	 */	
	public function getM($pinput)
	{

		$this->ainput = explode("\n", $pinput);
		$this->pM = -1;
		$does = explode(" ", $this->ainput[1])[1]; // Numero de instrucciones
		if ( (int)$does > 0 ) {
		
			$this->pM = (int)$does;
		}
		return $this->pM;
	}
			
	/**
	 * Builds matrix.
	 */	
	public function buildMatrix()
	{

		$this->matrix = array();
		for($i = 0; $i < $this->pN; $i++) {
		
			$this->matrix[$i] = array();
			for($j = 0; $j < $this->pN; $j++) {
			
				$this->matrix[$i][$j] = array();
				for($k = 0; $k < $this->pN; $k++) {
				
					$this->matrix[$i][$j][$k] = 0;
				}
			}
		}		
		
		//$matrix[0][1][1] = 20;
		
		return $this->matrix;
	}

	/**
	 * Validates coordinates.
	 */	
	public function isOfficial($coordinate)
	{

		$official = -1;
		if ( ($coordinate - 1) >= 0 && ($coordinate - 1) < $this->pN ) {
		
			$official = $coordinate;
		}
		return $official;
	}			

	/**
	 * Hace UPDATE.
	 */	
	public function doUpdate($doit)
	{

		$i = $this->isOfficial( (int)$doit[1] );
		$j = $this->isOfficial( (int)$doit[2] );
		$k = $this->isOfficial( (int)$doit[3] );
		if ( $i > -1 && $j > -1 && $k > -1 ) { // Los valores son oficiales y actualiza la matriz
		
			$this->matrix[$i - 1][$j - 1][$k - 1] = (int)$doit[4];
		}		
	}			

	/**
	 * Hace QUERY.
	 */	
	public function doQuery($doit)
	{

		$sum = 0;
		
		$x1 = $this->isOfficial( (int)$doit[1] );
		$y1 = $this->isOfficial( (int)$doit[2] );
		$z1 = $this->isOfficial( (int)$doit[3] );
		$x2 = $this->isOfficial( (int)$doit[4] );
		$y2 = $this->isOfficial( (int)$doit[5] );
		$z2 = $this->isOfficial( (int)$doit[6] );
		if ( $x1 > -1 && $y1 > -1 && $z1 > -1 && $x2 > -1 && $y2 > -1 && $z2 > -1 ) { // Los valores son oficiales
		
			if ( $x1 <= $x2 && $y1 <= $y2 && $z1 <= $z2 ) {  // x1 es mayor o igual que x2

				$i = $x1 - 1; do {

					$j = $y1 - 1; do {

						$k = $z1 - 1; do {

							$sum = $sum + $this->matrix[$i][$j][$k];				
							$k++;
						} while ($k < $z2);
						$j++;
					} while ($j < $y2);
					$i++;
				} while ($i < $x2);
			}
		}
		return (string)$sum;
	}			
	
	/**
	 * Computes matrix.
	 */	
	public function compute($pinput)
	{

		$result = ""; // Resultado de la operacion total
		$counting = 1; // Contador de todas las lineas
		
		$this->ainput = explode("\n", $pinput); // Numero de lineas T | N,M | UPDATE ...
		
		$this->pT = (int)$this->ainput[0]; // Numero de operaciones
		
		for($c = 0; $c < $this->pT; $c++) {
		
			$blocks = explode(" ", $this->ainput[$counting])[0]; // Numero de bloques
			$this->pN = (int)$blocks;
			$this->matrix = $this->buildMatrix(); // Creamos la matriz
			
			$does = explode(" ", $this->ainput[$counting])[1]; // Numero de instrucciones
			$this->pM = (int)$does;

			$counting++;
			for($d = 0; $d < $this->pM; $d++) { // Recorremos las instrucciones de cada operacion
		
				$doit = explode(" ", $this->ainput[$counting + $d]); // Una instruccion desde la linea 2 en {0 ... M-1} 
			
				$action = $doit[0];
				if ( $action == "UPDATE" ) { // Hacemos UPDATE

					$this->doUpdate($doit);
				} elseif ( $action == "QUERY" ) { // Hacemos QUERY que devuelve un reusltado

					$result = $result. $this->doQuery($doit) . "\n" ;
				}
			}
			$counting += ($this->pM); // Hacemos que counting sea igual a la linea siguiente N,M
		}
		
		return $result;
	}		
}
