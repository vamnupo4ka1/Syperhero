
 <?php
///Безопасность измененеия
if (get_magic_quotes_gpc())
{
  $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
  while (list($key, $val) = each($process))
  {
    foreach ($val as $k => $v)
    {
      unset($process[$key][$k]);
      if (is_array($v))
      {
        $process[$key][stripslashes($k)] = $v;
        $process[] = &$process[$key][stripslashes($k)];
      }
      else
      {
        $process[$key][stripslashes($k)] = stripslashes($v);
      }
    }
  }
  unset($process);
}
//////Закончилась

try
{ 
$pdo= new PDO ('mysql:host=localhost;dbname=people','AA','123');
 $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
}
catch (PDOException $e)
 {
$error='Невозможно подключиться к БД:'.$e->getMessage();
}

if(isset($_POST["register"]))
{   
  try
  {
$name=$_POST['name']; 
$email=$_POST['email']; 
$Orderi=$_POST['Orderi']; 
$sql="INSERT INTO ordersi SET
    name=$name,
    email=$email,
    Orderi=$Orderi,
    odate=CURDATE()'";

    $s->execute($sql);
  }
    catch (PDOException $e)
  {
    $error = 'Error adding submitted joke: ' . $e->getMessage();
    exit();
  }
}
 ?> 