<!DOCTYPE html>
<html>
  <head>
    <title>Exempel</title>
  </head>
  <body>
    <?php
    // Spara formulär när du skickar
    if (isset($_POST['email'])) {
      require "saveForm.php";
    } 
      $html = file_get_contents("form.html");
      echo $html;

      //Php fil för att koppla upp dig mot databasen
      include "db.php";
      //Läser in värden från databasen och tabellen usercomments och gallery
      $stmt = $pdo->query('SELECT * FROM usercomments LEFT JOIN gallery ON usercomments.id = gallery.id');
      while ($row = $stmt->fetch())
      {
          $html = file_get_contents("template.html");
          $html = str_replace('<!---id--->', $row["id"], $html);
          $html = str_replace('<!---image_src--->', 'view.php?id=' . $row["id"], $html);
          $html = str_replace('<!---homepage--->', $row["homepage"], $html);
          $html = str_replace('<!---time--->', $row["time"], $html);
          $html = str_replace('<!---name--->', $row["name"], $html);
          $html = str_replace('<!---email--->', $row["email"], $html);
          $html = str_replace('<!---comment-->', $row["comment"], $html);
          echo $html;
      }


    ?>

   
  </body>
</html>