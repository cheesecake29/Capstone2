<?php if ($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
</script>
<?php endif; ?>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">System Information</h5>
        </div>
        <div class="card-body">
            <form action="" id="system-frm">
                <div id="msg" class="form-group"></div>
                <div class="form-group">
                    <label for="name" class="control-label">System Name</label>
                    <textarea name="name" id="name" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('name')  ?>  
                    </textarea>

                    <label for="name" class="control-label">Home System Name</label>
                    <textarea name="homename" id="homename" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('homename')  ?>  
                    </textarea>

                    <label for="name" class="control-label">Home description</label>
                    <textarea name="homedes" id="homedes" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('homedes')  ?>  
                    </textarea>

                    


                   

                </div>
                <div class="form-group">
                    <label for="short_name" class="control-label">System Short Name</label>
                    <input type="text" class="form-control form-control-sm" name="short_name" id="short_name" value="<?php echo  $_settings->info('short_name') ?>">
                    <textarea name="short_name" id="short_name" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('short_name') ?>
                    </textarea>
                </div>



              
                <div class="form-group">
                    <label for="name" class="control-label">Contact</label> <br>
					<label class="label" for="phonenumber" style="font-size: 13px; color: #4A4A4B;">Phone Number</label>
                    <input type="number" class="form-control form-control-sm" name="phonenumber" id="phonenumber" value="<?php echo $_settings->info('phonenumber') ?>">
					<label class="label" for="address" style="font-size: 13px; color: #4A4A4B;">Address</label>
					<input type="text" class="form-control form-control-sm" name="address" id="address" value="<?php echo $_settings->info('address') ?>">
					<label class="label" for="email"style="font-size: 13px; color: #4A4A4B; ">Email</label>
					<input type="email" class="form-control form-control-sm" name="email" id="email" value="<?php echo $_settings->info('email') ?>">

                    <label class="label" for="link"style="font-size: 13px; color: #4A4A4B; ">Social Media Link</label>
					<input type="link" class="form-control form-control-sm" name="link" id="link" value="<?php echo $_settings->info('link') ?>">
                </div>

                
                
               
                <div class="form-group d-flex justify-content-center">
                    <img src="<?php echo validate_image($_settings->info('cover')) ?>" alt="" id="cimg2" class="img-fluid img-thumbnail">
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="col-md-12">
                <div class="row">
                    <button class="btn btn-sm btn-primary" form="system-frm">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
                _this.siblings('.custom-file-label').html(input.files[0].name)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function displayImg2(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                _this.siblings('.custom-file-label').html(input.files[0].name)
                $('#cimg2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function displayImg3(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                _this.siblings('.custom-file-label').html(input.files[0].name)
                $('#cimg3').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function(){
         $('.summernote').summernote({
                height: 200,
                toolbar: [
                    [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                    [ 'fontname', [ 'fontname' ] ],
                    [ 'fontsize', [ 'fontsize' ] ],
                    [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
                ]
            })
    })
</script>
