<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">Logo & Style</h5>
        </div>
        <div class="card-body">
            <form action="" id="system-frm">
                <div id="msg" class="form-group"></div>







                <div class="form-group">
                    <label for="" class="control-label">System Logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="cimg" name="img" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="cimg">Choose file</label>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-center">
                    <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                </div>


                <label for="systitle" class="control-label">System Title</label>
                <input name="systitle" id="systitle" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('systitle')  ?>  
                </input>

                <label for="sysname" class="control-label">System Name</label>
                <textarea name="sysname" id="sysname" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('sysname')  ?>  
                    </textarea>


                <label for="sys_shortname" class="control-label">System Shortcut Name</label>
                <textarea name="sys_shortname" id="sys_shortname" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('sys_shortname')  ?>  
                    </textarea>



                <div>


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
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
                _this.siblings('.custom-file-label').html(input.files[0].name)
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).ready(function() {
        var summernoteInstance = $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],

                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']], // Include the font size dropdown
                ['color', ['color']],


                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36', '48', '64', '82', '150'],
            fontNames: ['Arial', 'Times New Roman', 'Courier New', 'Custom Font', 'Montserrat'],
        });



    });
</script>