
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Miss Teen Mantahan 2019</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-image: url('assets/images/logo1.png');">
  <form action="view.php" method="post">
    <h3>Login Account</h3>
    <div class="group">
      <input name = "username" type="text" placeholder="Enter username" required>
      <label>Username</label>
    </div>
    <div class="group">
      <input name = "password" type="password" placeholder="Enter password" required>
      <label>Password</label>
    </div>
    <button id = "submit" ng-click='submit' class="button buttonBlue">Login</button>
    <p id = "failed" class="alert alert-danger"></p>
  </form>
  
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/angular.min.js"></script>
  <script type="text/javascript" src="assets/js/sweetalert2.all.js"></script>
  <script type="text/javascript" src="assets/js/index.js"></script>
</body>
</html>
