<?php

	function output_header($status = true
		                  ,$titulo = null
		                  ,$dados  = array()
		                  ,$versao = 'v1'){

		header("Content-Type: application/json;charset=utf-8");
		echo json_encode(
			array('status' => $status
		         ,'titulo' => $titulo
		         ,'dados'  => $dados
		         ) ,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
		);

		//finalizar a execução
		exit;
	}

	function output_input_script($status = true
		                  ,$titulo = null
		                  ,$input  = null
		                  ,$script  = null
		                  ,$versao = 'v1'){

		header("Content-Type: application/json;charset=utf-8");
		echo json_encode(
			array('status' => $status
		         ,'titulo' => $titulo
		         ,'input'  => $input
		         ,'script'  => $script
		         ) ,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
		);

		//finalizar a execução
		exit;
	}
?>