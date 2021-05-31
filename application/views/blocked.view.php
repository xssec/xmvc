<!DOCTYPE html>
<html lang="en">
<head>
  <title>BLOCKED</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_PATH.'/public/images/favicon.png'?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <?php
  require_once ROOT."/application/functions/functionHtml.php";
  start_content();
  echo '
  <div class="align-items-center danger" style="padding: 10px 12px; background-color: #ffdddd; border-left: 6px solid #f44336;">
    <div class="col text-dark">
      <strong>Unauthorised</strong> access or use shall render the user liable to criminal and/or civil prosecution.
    </div>
  </div>';
  end_content();
  load_css('css/main.css');
  ?>

</body>
</html>
