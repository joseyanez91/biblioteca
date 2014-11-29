<?php
//require_once'config.php';

$tokenIn = sha1(rand(0,999).rand(999,9999).rand(1,300));
$_SESSION['token_'] = $tokenIn;

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Expires" content="0" /> 
    <meta http-equiv="Pragma" content="no-cache" />
    <title><?php //echo $tt; ?></title>
    <link rel="icon" href="<?php// echo $icon;?>" >
    <link rel="stylesheet" href="css/normalize.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css">
    <link rel="stylesheet" href="css/template.css" type="text/css">
    <link rel="stylesheet" href="css/t_login.css" type="text/css">

</head>

<body>

<div class="container">
<head>
    <div class="row">
        <div class="container text-center">
            <!--<img src="img/logo.png" height="75" width="311" alt="logo">-->
        </div>
    </div>
</head>
<section>
    <div class="row">       
        <div class="loginBox">
            <p class="text-muted text-center text-lowercase"> Iniciar Secion <?php echo $tokenIn; ?><br></p>
            <form class="formLogin" action="conexion.php" method="post">            
                <div id="nombre-group">
                    <input type="text"      name="nombre"       class="form-control input-lg" placeholder="Nombre de usuario" autofocus autocomplete="off">
                </div>
                <div id="pass-group">
                    <input type="password"  name="pass"         class="form-control input-lg" placeholder="Contraseña" autocomplete="off">
                </div>
                <div id="pass-group">
                    <input type="hidden"    name="token" value="<?php echo $tokenIn; ?>" />
                </div>
                <input type="submit"    class="btn btn-success btn-block btn-lg" value="Entrar">            
                
            </form> 
            <div class="text-center text-info option"><a href="">Recuperar contraseña</a></div>   
            <div class="mensaje" style="display:none"></div>        
        </div>        
    </div>    
</section>
<footer>
    <div class="row">
        <div class="text-center text-muted">
            <!--<p>Sistemas de administración y gestion del flujo de caja e inventario.</p>-->
            <p>sistema web desarrollado por:</p>
            <p>
                <a href="https://www.facebook.com/pages/Alan-E-Fuentes/699026480163026" target="_blank" class="text-muted" title="(504)997-566-07"  data-placement="left">
                <strong><?php //echo $dev."© 2010-".date("Y")?></strong>
                </a>
            </p>
        </div>
    </div>
</footer>
</div>


<!-- ENDHTML -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/eventos.js"></script>
<script type="text/javascript" src="js/spin.js"></script>
<script type="text/javascript">
/*TODO CODE*/
$(document).ready(function() {
    $('footer div > p a').tooltip();
    //FUNCION PARA PASAR INPUT DE MAYUSCULAS A MINUSCULAS
    /*$('input').keyup(function(){
        this.value = this.value.toLowerCase();
    });/*
    //============================================
    /*$(document).ajaxStart(function(){
        alert('hola');
        $.aniGif();     
    });
    
    $(document).ajaxStop(function(){
        alert('adios');
        $.aniGif();     
    });     */
    $('.loginBox form').submit(function(){
       //alert($('.loginBox form').serialize());
        $.ajax({
            type:'POST',
            url: "conexion.php",
            cache:false,
            data: $('.loginBox form').serialize(),
            dataType: "json",
            success: function(data){                        
                var unoDos=0;           
                $('.alert').remove();
                
                if ( !data.success) {                   
                    //alert('nada');
                    
                    // manejo de errores para el nombre ---------------
                    if (data.errors.nombre) {
                        unoDos++;                   
                        $('.loginBox .mensaje').fadeIn('fast').append('<div class="alert alert-danger text-uppercase" role="alert">' + data.errors.nombre + '</div>');
                        $('.option').css('margin-bottom','15px');
                    }   
                    // manejo de errores para el pass ---------------
                    if (data.errors.pass) {
                        unoDos++;
                        $('.loginBox .mensaje').fadeIn('fast').append('<div class="alert alert-danger text-uppercase" role="alert">' + data.errors.pass + '</div>');
                        $('.option').css('margin-bottom','15px');
                    }
                    // manejo de errores para el nombre o pass ---------------
                    if (data.errors.noUser) {
                        unoDos++;
                        $('.loginBox .mensaje').fadeIn('fast').append('<div class="alert alert-danger text-uppercase" role="alert">' + data.errors.noUser + '</div>');
                        $('.option').css('margin-bottom','15px');
                    }
                    if(unoDos==2){$('.loginBox').css({'height':'400px','overflow':'hidden'})}   
                
                //setTimeout("window.location.reload()",3000);               
                } else {
                     //si el usuario se ha identificado corectamente 
                    var valor_1 = data.datos.usuario;
                    var valor_2 = "<?php echo $tokenIn; ?>";
                    //alert(valor);
                    console.log(valor_2 );
                    $.ajax({
                        url: "config.php",
                        type: "POST",
                        cache:false,
                        async:false,
                        data: {
                            usuarioNombre: valor_1,
                            tokenID: valor_2
                            },
                        success: function(data){
                            //console.log(data);
                            $('.option').css('margin-bottom','15px');
                            $('.loginBox .mensaje').append('<div class="text-center"><img src="img/user-ok.png" alt=""></div>').fadeIn('fast',
                            function(){ setTimeout(" window.location.href = 'main.html'",2000 );                             
                            });                         
                            }                       
                        });         
                 }// FIN ELSE
            },
            error: function(jqXHR, textStatus, error){
                alert("error: " + jqXHR + " >> "+ textStatus+ " >> "+ error);
                }
        }); //fin AJAX
            
        return false;
    }); //FIN SUBMIT FORMS
    //==========================================================================
});//FIN JQUERY
</script>
</body>
</html>