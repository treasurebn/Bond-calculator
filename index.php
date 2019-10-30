
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron text-center">
  <h1>Calculate Your Mortgage Loan Using Our Mortgage calculator!</h1> 
</div>
<div class="container">
    <form method="post">
        <div class="form-group">
            <input type="text" name="loan"  placeholder = "amount" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="text" name="interest" placeholder = "interest" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="text" name="term" placeholder = "term in years" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="text" name="down" placeholder = "down" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Calculate" name = "submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        </div>
    </form>
</div>

<div class="container">
    <form  method="post">
        <div class="form-group">
            <input type="text" name="name"  placeholder = "Enter your name to save" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Save" name = "save" class="btn btn-primary" required>
        </div>
    </form>
    </div>
    <div class="container">
    <form  method="post">
        <div class="form-group">
            <input type="text" name="name_d"  placeholder = "Enter your name to display prev data" class="form-control" required>
        </div>
        <input type="submit" value="Diplay" name = "display" class="btn btn-primary">
    </form>
    </div>
    <?php require('cal.php');?>
    
   
</body>
</html>