<?php
namespace App;
class Mvc{
	public $PageDemander;
	public $Get;
	public $PageDisponible;
	public $PagePath;
	public $Replace;

	public function __construct($array)
	{
		$this->PageDisponible = $array;
		$this->RecupererInformationPage();
	}


	public function Template($file){
		require root.'/Pages/Templates/'.$file;
	}


	public function View($file){
		require root.'/Core/View/'.$file;
	}
	public function Controller($file){
		require root.'/core/controller/'.$file;
	}


	private function TransformUrl($CallBack){

		$CallBack = explode('/' , $CallBack);
		$CallBack = array_filter($CallBack);
		return $CallBack;
	}

	private function RecupererInformationPage(){
		if(!isset($_GET['page'])):
			die('Error Page: 01');
		endif;
		$PageInfo = $this->TransformUrl($_GET['page']);
		if(empty($PageInfo)):
			$this->PageDemander = 'home';
			$this->PagePath = 'core/controller/home.php';
		else:
			foreach($PageInfo as $key => $value):
				if($key==0):


					if(array_key_exists($value, $this->PageDisponible)):
						$this->PageDemander = $value;
						$this->PagePath = $this->PageDisponible[$value];
					else:
						$this->PageDemander = '404';
						$this->PagePath = 'core/controller/404.php';
					endif;
						
					
				elseif($key%2):
					if(isset($PageInfo[$key+1])): // Verifie que l'index à bien une valeur.
						$this->Get[$value] = $PageInfo[$key+1];
					endif;
				endif;
			endforeach;
		endif;

	}
}