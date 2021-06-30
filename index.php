<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Noobie login</title>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="author" content="Zacheem" />
        <meta name="description" content="Easy peasy login for php beginners 😉" />

        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="assets/css/styles.css" rel="stylesheet" />

    </head>

    <?php  
     session_start(); 
     // You can use require_once() if you want instead of the direct connection
     // require_once("dbcon.php");

     $connect = new PDO("mysql:host=localhost;dbname=databaseName;charset=utf8", "User", "Password");

     try  
     {     
      if(isset($_POST["login"]))  
      {  
        if(empty($_POST["email"]) || empty($_POST["pass"])){  
             $message = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><b>x</b></button><label>All fields are required</label></div>';  
        }else{
            $statement = $connect->prepare("SELECT * FROM users WHERE email = :email or pass = :pass");  
            $statement->execute(  
                    array(  
                          'email' => $_POST["email"],
                          'pass'  => $_POST["pass"]
                         )  
                    );
            $result = $statement->fetchAll();
     
            if(sizeof($result) > 0){

                foreach($result as $row){

                    if($row["email"] == $_POST['email'] && $row["pass"] == $_POST['pass'])  
                     {    
                        $_SESSION["email"] = $_POST["email"];

                        print "<meta http-equiv='refresh' content='0;url=success.php'>";
                        // header("location:success.php");

                     }else{
                        $message = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><label>Wrong credentials</label></div>';
                      }  
                }

            }else{  
                 $message = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><label>Email & password not registered</label></div>';  
            }  
           }  
      }  
     }  
     catch(PDOException $error)  
     {  
       $message = $error->getMessage();  
     } 

    ?> 

    <body id="page-top">

        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Noobie login 😉</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menú
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <section class="page-section" id="contact">
            <div class="container">
                
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Log in</h2>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                       
                        <form method="post">
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Email Addres</label>
                                    <input class="form-control" name="email" type="text" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Password</label>
                                    <input class="form-control" name="pass" type="password" placeholder="Password"/>
                                </div>
                            </div>
                            <br/>
                            <?php  
                                if(isset($message))  
                                {  
                                     echo '<label class="text-danger">'.$message.'</label>';  
                                }  
                            ?> 
                            <div class="form-group">
                                <button class="btn btn-primary btn-xl" type="submit" name="login">LOGIN</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <!--Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            Elm Street
                            <br />
                            Springwood, Ohio
                        </p>
                    </div>

                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Follow me</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-telegram"></i></a>
                    </div>

                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">About</h4>
                        <p class="lead mb-0">Easy-peasy login for php beginners
                        </p>
                    </div>
                    
                </div>
            </div>
        </footer>

        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright © Noobie login 2021</small></div>
        </div>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Theme JS-->
        <script src="assets/js/scripts.js"></script>
    </body>
</html>