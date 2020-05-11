<?php
require_once('../model/validate.php');
$validate = new validate();
$errors = NULL;

$title = $validate->limparCampos($_POST['title']);
if (!$validate -> verTexto($title) && !$validate -> verTamanho($title, 3, 100)){
	$errors['title'] = 'Invalid Title!';
}

$description = $_POST['description'];

if(!empty($description)){
	$description = str_replace('<div>', '<br/>', $description);
	$description = str_replace('</div>', '', $description);
}

if(!empty($description)){
	$description = $validate->naoEscapar($description);
}

if(!empty($description)){
	if (!$validate -> verTamanho ($description, 3)){
	$errors['description']= "Invalid text!";
	}
	if (!$validate -> verTexto ($description)){
	$errors['description']= "Invalid text!";
	}
}
if($_GET['t']==1){
$pattern = '#^(?:https?://)?';    # Optional URL scheme. Either http or https.
$pattern .= '(?:www\.)?';         #  Optional www subdomain.
$pattern .= '(?:';                #  Group host alternatives:
$pattern .=   'youtu\.be/';       #    Either youtu.be,
$pattern .=   '|youtube\.com';    #    or youtube.com
$pattern .=   '(?:';              #    Group path alternatives:
$pattern .=     '/embed/';        #      Either /embed/,
$pattern .=     '|/v/';           #      or /v/,
$pattern .=     '|/watch\?v=';    #      or /watch?v=,    
$pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
$pattern .=   ')';                #    End path alternatives.
$pattern .= ')';                  #  End host alternatives.
$pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
$pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.
if(preg_match($pattern, $_POST['path'], $matches)) {
	$path = $matches[1];
}
else{
	$errors['path']="Invalid Youtube URL video!";
}
}
?>