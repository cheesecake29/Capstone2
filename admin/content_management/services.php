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







                

               

                <label for="servicetitle" class="control-label">Service h1</label>
                <textarea name="servicetitle" id="servicetitle" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('servicetitle')  ?>  
                    </textarea>

                    <label for="servicep" class="control-label">Service p</label>
                <textarea name="servicep" id="servicep" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('servicep')  ?>  
                    </textarea>


                    <label for="service_description" class="control-label">Service Description</label>
                <textarea name="service_description" id="service_description" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('service_description')  ?>  
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
    function service_image(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#service_image').attr('src', e.target.result);
                _this.siblings('.custom-file-label').html(input.files[0].name)
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