<?php
header("Content-type: text/html; charset=utf-8");

if(empty($_POST['js'])){

$log =="";
$error="no"; //флаг наличия ошибки

		$posName = addslashes($_POST['posName']);
		$posName = htmlspecialchars($posName);
		$posName = stripslashes($posName);
		$posName = trim($posName);
		
		
		$posEmail = addslashes($_POST['posEmail']);
		$posEmail = htmlspecialchars($posEmail);
		$posEmail = stripslashes($posEmail);
		$posEmail = trim($posEmail);

		$posText = addslashes($_POST['posText']);
		$posText = htmlspecialchars($posText);
		$posText = stripslashes($posText);
		$posText = trim($posText);

//Проверка заполнения имени    
if(!$posName) {
$log.="<li>- Пожалуйста, заполните поле \"Ваше имя\"!</li>"; $error="yes"; }
//Проверка email адреса
			
if($posEmail == '')
                {
	$log .= "<li>- Пожалуйста, введите Ваш email!</li>";
	$error = "yes";
                  
                }			



//Проверка наличия введенного текста комментария
if (empty($posText))
{
	$log .= "<li>- Необходимо указать текст сообщения!</li>";
	$error = "yes";
}

//Проверка длины текста комментария
if(strlen($posText)>700)
{
	$log .= "<li>- Слишком длинный текст, в вашем распоряжении 700 символов!</li>";
	$error = "yes";
}

//Проверка на наличие длинных слов
$mas = preg_split("/[\s]+/",$posText);
foreach($mas as $index => $val)
{
  if (strlen($val)>30)
  {
	$log .= "<li>- Слишком длинные слова (более 30 символов) в тексте записи!</li>";
	$error = "yes";
	break;
  }
}
sleep(2);

//Если нет ошибок отправляем email  
if($error=="no")
{
//Отправка письма админу о новом заказе
$to = "Hogsmit_post_office@mail.com";
$mes = "Заказ $posName оставил Вам супера \n\n$posText";

$from = $posEmail;
$sub = '=?utf-8?B?'.base64_encode('Новый заказ на супера').'?=';
$headers = 'From: '.$from.'
';
$headers .= 'MIME-Version: 1.0
';
$headers .= 'Content-type: text/plain; charset=utf-8
';
mail($to, $sub, $mes, $headers);
echo "1"; 
}
else//если ошибки
{ 
		echo "<p style='font: 12px Verdana;'><font color=#FF3333><strong>Ошибка !</strong></font></p><ul style='list-style: none; font: 11px Verdana; color:#000; padding:5px; margin:4px 10px;'>".$log."</ul><br />"; //Нельзя отправлять пустые сообщения

}
}