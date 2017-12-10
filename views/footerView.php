<?php

class footerView
{
	private $model;

	public function __construct(Model $model)
	{
		$this->model= $model;
	}

	public function output()
	{
		date_default_timezone_set("America/New_York");
		return '<footer> &copy; '.date("Y").' Powered by 	
			<img src="imgs/php.jpg"
			alt="PHP Logo">
			</footer>';
	}
}
?>