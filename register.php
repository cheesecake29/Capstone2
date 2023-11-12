<?php require_once('./config.php') ?>

<!DOCTYPE html>
<html lang="en">
  <?php require_once('inc/header.php') ?>
 <!--- <link rel="stylesheet" href="registerstyle.css"> --->
  <body>
    <div class="container">
        <div class="left-signin ">
           
           
            <div>
                <form id="register-frm" action="" method="POST">
                     <input type="hidden" name="id">
                     <div>
    <small for="firstname">First Name</small>
    <input type="text" name="firstname" id="firstname" placeholder="Enter First Name" autofocus required>
</div>



            <div>
            <small>Last Name</small>
              <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name" required>
              
            </div>
           
            <div>
              <small>Email</small>
              <input type="email" name="email" id="email" placeholder="email" required>
             
            </div>
            

                        
                       
            <div>
              <div>
              <small>Password</small>
                <input type="password" name="password" id="password" placeholder="Type your password" required>
              </div>
              <div>
              <small>Confirm Password</small>
                <input type="password" id="cpassword" placeholder="Confirm Password" required>
              </div>


            </div>
            <div>
              <div>
                <a href="<?php echo base_url ?>">Back to Shop</a>
              </div>
              <div>
                <button type="submit">Register</button>
              </div>
            </div>
            <div>
              <div>
                <a href="<?php echo base_url.'login.php' ?>">Already have an Account</a>
              </div>
            </div>
                </form>
            </div>
        </div>
        <div class="right-signin">

         <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo"></center>
            
        </div>
    </div>
<script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="<?= base_url ?>dist/js/adminlte.min.js"></script> -->

<script>
  $(document).ready(function(){
    end_loader();
    $('.pass_type').click(function(){
      var type = $(this).attr('data-type')
      if(type == 'password'){
        $(this).attr('data-type','text')
        $(this).closest('.input-group').find('input').attr('type',"text")
        $(this).removeClass("fa-eye-slash")
        $(this).addClass("fa-eye")
      }else{
        $(this).attr('data-type','password')
        $(this).closest('.input-group').find('input').attr('type',"password")
        $(this).removeClass("fa-eye")
        $(this).addClass("fa-eye-slash")
      }
    })
    $('#register-frm').submit(function(e){
      e.preventDefault()
      var _this = $(this)
			 $('.err-msg').remove();
       var el = $('<div>')
            el.hide()
      if($('#password').val() != $('#cpassword').val()){
        el.addClass('alert alert-danger err-msg').text('Password does not match.');
        _this.prepend(el)
        el.show('slow')
        return false;
      }
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Users.php?f=save_client",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./login.php";
					}else if(resp.status == 'failed' && !!resp.msg){   
              el.addClass("alert alert-danger err-msg").text(resp.msg)
              _this.prepend(el)
              el.show('slow')
          }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
          $('html, body').scrollTop(0)
				}
			})
    })
  })
</script>
</body>
</html>