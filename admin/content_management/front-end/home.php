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
                    <textarea name="homename" id="homename" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('homename')  ?>  
                    </textarea>

                    <label for="homedes" class="control-label">Home description</label>
                    <textarea name="homedes" id="homedes" cols="1" rows="1" class="form-control summernote">
                     <?php echo $_settings->info('homedes')  ?>  
                    </textarea>

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