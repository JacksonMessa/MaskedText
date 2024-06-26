<?php
class maskController extends controller{

	private $dados;

	public function __construct(){
		parent::__construct();
		$this->dados = array();
	}

	public function index(){
		output_header(false,'método de consulta invalido');
	}

	public function mask(){
		if(isset($_GET['mask']) && !empty($_GET['mask'])){
			$mask = $_GET['mask'];
			$object_mask = new Mask();
			if($object_mask->get($mask)!=null){
				$mask = $object_mask->get($mask)['mascara'];
				$_GET['mask_char'] = '*';
			}
		}else{
			output_header(false,'O parâmetro de máscara não foi enviado');
		}

		if(isset($_GET['text'])){
			$text = $_GET['text'];
		}else{
			output_header(false,'O parâmetro de texto não foi enviado');
		}

		if(isset($_GET['mask_char']) && !empty($_GET['mask_char'])){
			$mask_char = $_GET['mask_char'];
		}else{
			$mask_char = '*';
		}

		if(strlen($text)>substr_count($mask,$mask_char)){
			$dados["Tamanho_texto"] = strlen($text);
			$dados["Tamanho_mascara"] = substr_count($mask,$mask_char);
			output_header(false,'O texto é maior do que a máscara',$dados);
		}
		$masked_text = "";
		$mask = str_split($mask);
		$i=0;
		foreach($mask as $key => $char) {
			if($char==$mask_char){
				if(isset($text[$i])){
					$masked_text .= $text[$i];
					$i++;
				}else{
					output_header(true,'Texto mascarado com sucesso',$masked_text);
				}
			}else{
				$masked_text .= $char;
			}
			
		}
		output_header(true,'Texto mascarado com sucesso',$masked_text);

	}

	public function unmask(){
		if(isset($_GET['mask']) && !empty($_GET['mask'])){
			$mask = $_GET['mask'];
			$object_mask = new Mask();
			if($object_mask->get($mask)!=null){
				$mask = $object_mask->get($mask)['mascara'];
				$_GET['mask_char'] = '*';
			}
		}else{
			output_header(false,'O parâmetro de máscara não foi enviado');
		}

		if(isset($_GET['text'])){
			$text = $_GET['text'];
		}else{
			output_header(false,'O parâmetro de texto não foi enviado');
		}

		if(isset($_GET['mask_char']) && !empty($_GET['mask_char'])){
			$mask_char = $_GET['mask_char'];
		}else{
			$mask_char = '*';
		}

		if(strlen($text)>strlen($mask)){
			$dados["Tamanho_texto"] = strlen($text);
			$dados["Tamanho_mascara"] = strlen($mask);
			output_header(false,'O texto é maior do que a máscara',$dados);
		}
		$unmasked_text = "";
		$mask = str_split($mask);
		$i=0;
		foreach ($mask as $key =>  $char) {
			if($char==$mask_char){
				if(isset($text[$key])){
					$unmasked_text .= $text[$key];
				}else{
					output_header(true,'Texto desmascarado com sucesso',$unmasked_text);
				}
			}

		}
		output_header(true,'Texto desmascarado com sucesso',$unmasked_text);

	}

	public function listMask(){
		$mask = new Mask();

		$retorno = $mask->getAll();
		
		if(count($retorno)>0){
			output_header(true,'Consulta Realizada',$retorno);
		}else{
			output_header(false,'Nenhum dado encontrado');
		}
		
	}

	public function setInputMask(){
		
		if (isset($_POST['mask'])) {
			$mask = $_POST['mask'];
		}else{
			output_header(false,'O parâmetro de máscara não foi enviado');
		}
		if(isset($_POST['input']) && !empty($_POST['input'])){
			try {
		        $doc = new DOMDocument('1.0');
		        $input = new DOMDocument('1.0');
		        $input->loadHTML($_POST['input']);
		        $input = $input->getElementsByTagName('input');
		        $input = $input->item(0);
			    $input->setAttribute('oninput',"mask(this.value,'$mask',this.id)");
			    $input->setAttribute('onkeydown',"set_key(this.value)");
			    $object_mask = new Mask();
				if($object_mask->get($mask)!=null){
					$mask = $object_mask->get($mask)['mascara'];
				}
				$input->setAttribute('maxlength',strlen($mask));

			    $inputMask = file_get_contents(".\util\inputMaks.js");
			    $script = new DOMDocument('1.0');
		        $script->loadHTML($inputMask);


				$input = $doc->importNode($input, true);
				$input = $doc->appendChild($input);
				$input->formatOutput = true;
				$retorno = $doc->saveHTML();

				$retornoScript = substr($script->saveHTML(), 119);
				output_input_script(true,'input retornado',$retorno,$retornoScript);
				
			} catch (Exception $e) {
				output_header(false,'input inválido',$e);
			}
		}else{
			output_header(false,'O parâmetro de input não foi enviado');
		}
	}


}
?>