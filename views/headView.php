<?php
class HeadView
{
	private $model;
	
	public function __construct(Model $model)
	{
		$this->model= $model;
	}

	public function output()
	{
		return '<head>
		<meta charset="UTF-8">
		<title>'.ucwords($this->model->page).'</title>
		<link rel="icon" type="image/png" href="imgs/phpLogo.png"/>
		<link rel="stylesheet" href="css/style.css">
		</head>
		<body>';
	}
}
?>