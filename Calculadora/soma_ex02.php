<?php
$v1 = $_GET["v1"] ?? 0;
$v2 = $_GET["v2"] ?? 0;
$op = $_GET["operacao"] ?? '+';

$result = 0;

switch ($op) {
  case '+':
    $result = $v1 + $v2;
    break;
  case '-':
    $result = $v1 - $v2;
    break;
  case '*':
    $result = $v1 * $v2;
    break;
  case '/':
    if ($v2 != 0) {
      $result = $v1 / $v2;
      break;
    }
    case 'sqrt':
      if($v1 > 0){
     $result =  sqrt($v1);
     break;
    } else{
      $result = sqrt($v2);
      break;

    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculadora</title>
</head>

<body>
  <?php echo "<h1>Resultado: $result</h1>"; ?>
  <?php echo "<h1>Operador: $$op</h1>"; ?>

</body>

</html>