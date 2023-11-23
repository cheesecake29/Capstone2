<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">Home</h5>
        </div>
        <div class="card-body">
            <form action="" id="system-frm">
                <div id="msg" class="form-group"></div>
                <div class="form-group">
                    <label for="name" class="control-label">Home System Name</label>
                    <textarea name="homename1" id="homename1" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('homename1')  ?>  
                    </textarea>

                    <label for="name" class="control-label">Home description</label>
                    <textarea name="homedes1" id="homedes1" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('homedes1')  ?>  
                    </textarea>

                    <label class="label" for="link" style="font-size: 13px; color: #4A4A4B; ">Social Media Link</label>
                    <input type="link" class="form-control form-control-sm" name="link" id="link" value="<?php echo $_settings->info('link') ?>">

                    <div class="form-group">
                        <label for="" class="control-label">Website Cover</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input rounded-circle" id="customFile" name="cover" onchange="displayImg2(this,$(this))">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-center">
                        <img src="<?php echo validate_image($_settings->info('cover')) ?>" alt="" id="cimg2" class="img-fluid img-thumbnail">
                    </div>
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
    function displayImg2(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                _this.siblings('.custom-file-label').html(input.files[0].name)
                $('#cimg2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $('.summernote').summernote({
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontSizes', ['fontsize']], // Include the font size dropdown
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48', '64', '82', '150'],
            fontNames: ['Arial', 'Times New Roman', 'Courier New', 'Custom Font', 'Montserrat']
        });


    });
</script>