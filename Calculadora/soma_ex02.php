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
    case 'inversao':
      if($v1 != 0){
        $result =  $v1 * -1;
        break;
       } else{
         $result = $v2 * -1;
         break;
       } 
         case '1/x':
          if($v1 != NULL){
            $result =  1/$v1;
            break;
           } else{
           $result = 1/$v2;
             break;
           } 
           case 'sen':
            if($v1 != NULL){
              $result =  sin($v1);
              break;
             } else{
               $result =  sin($v2);
               break;
             } 
             case 'cos':
              if($v1 != NULL){
                $result = cos($v1);
                break;
              } else{
                $result = cos($v2);
              }
              case 'tan':
                if($v1 != NULL){
                  $result = tan($v1);
                  break;
                } else{
                  $result = tan($v2);
                }
                case 'log':
                  if($v1 != NULL){
                    $result =  (log($v1)) ;
                    break;
                   } else{
                     $result = (log($v2)) ;
                     break;
                   }

                   default: 
                   $result = 'Erro';
                   break;
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
