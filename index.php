<?php require 'start.php';?>
<?php var_dump($user);?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
     <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/custom.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
  <style type="text/css">
    @import url("http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css")
  </style>
   <title>PayPal</title>
  </head>
  

  <body>
    <div class="container" style="margin-top: 65px;background-color: #ffffff;"><br>
       <div class="well">
             <form action="checkout.php" method="post">
                <div class="input-group">
                <label class="control-label">Pay with Paypal Right Here</label>&nbsp;
                    <input class="btn btn-lg" name="amount" placeholder="Enter amount in USD($)" required>&nbsp;
                    <input type="submit" name="pay" value="Pay" class="btn btn-default"/>
                </div>

<!--                --><?php //if($user->member): ?>
<!--                    <p>you are a member</p>-->
<!--                --><?php //else: ?>
<!--                    <p>you are not a member. <a href="">Become a member</a></p>-->
<!--                --><?php //endif;?>
             </form>
        </div>
    </div>
  </body>
  <br>
</html>