<?php

use grabbackend\repositories\CalculusRepository;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalculusTest extends TestCase
{

	private $repository;
	private $testN;
	private $pinput;
	private $matrix;

	/**
	 * Create a new test case instance.
	 *
	 * @return void
	 */

	public function __construct()
	{
	
		$this->repository = new CalculusRepository();
		$this->testN = 4;
		//$this->pinput = "2\n2 2\nUPDATE 0 1 1 20";
		//$this->pinput = "2\n2 2\nUPDATE 1 2 2 20\nQUERY 1 2 2 2 2 2 20";
		$this->pinput = "2\n4 5\nUPDATE 2 2 2 4\nQUERY 1 1 1 3 3 3\nUPDATE 1 1 1 23\nQUERY 2 2 2 4 4 4\nQUERY 1 1 1 3 3 3\n2 4\nUPDATE 2 2 2 1\nQUERY 1 1 1 1 1 1\nQUERY 1 1 1 2 2 2\nQUERY 2 2 2 2 2 2";
		

	}
	
    /**
     * A basic functional test example.
     *
     * @return void
     */
    /*public function testGetN()
    {

        $this->visit('hola')
             ->see('Sandy');
    }
    
    public function testSandy()
    {

		$repository = new CalculusRepository();
		$user = $repository->doit(1);
        $this->assertTrue( $user == 'Sandy' );
        //$this->assertTrue(true);
    } */   

    /**
     * Tests T.
     */
    public function testGetT()
    {

		$pn = $this->repository->getT($this->pinput);
		//$pn = $repository->getT("3\n1 2");
		//$pn = $repository->getT("juan\n1 2");
        $this->assertTrue( $pn == 2 );
    } 
    
    /**
     * Tests N.
     */
    public function testGetN()
    {

		$pn = $this->repository->getN($this->pinput);
		//$pn = $repository->getN("3\n1 2");
		//$pn = $repository->getN("juan\njuan 2");
        $this->assertTrue( $pn == $this->testN );
    }

    /**
     * Tests matrix.
     */
    public function testMatrix()
    {

		$pt = $this->repository->getT($this->pinput);
		$pN = $this->repository->getN($this->pinput);
		$this->matrix = $this->repository->buildMatrix();

        $this->assertTrue( count($this->matrix) == $this->testN );
		for($i = 0; $i < $pN; $i++) {
		
			$this->assertTrue( count($this->matrix[$i]) == $this->testN );
			for($j = 0; $j < $pN; $j++) {
			
				$this->assertTrue( count($this->matrix[$i][$j]) == $this->testN );
				for($k = 0; $k < $pN; $k++) {
				
					$this->assertTrue( $this->matrix[$i][$j][$k] == 0 );
				}
			}
		}		
    }

    /**
     * Tests compute.
     */
    public function testCompute()
    {

		$pt = $this->repository->getT($this->pinput);
		$pN = $this->repository->getN($this->pinput);
		$pM = $this->repository->getM($this->pinput);
		
		//$this->matrix = $this->repository->buildMatrix();
		
		$exercise = $this->repository->compute($this->pinput);
		//$this->assertTrue( $exercise == "20" );
		$this->assertTrue( $exercise == "4\n4\n27\n0\n1\n1\n" );
    }
}
