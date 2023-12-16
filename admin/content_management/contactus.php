<?php if ($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
</script>
<?php endif; ?>
<style>
    .img-fluid.img-thumbnail {
    width: 30%;
    height: 20%;
  
}
</style>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">Contact Us</h5>
        </div>
        <div class="card-body">
            <form action="" id="system-frm">
                <div id="msg" class="form-group"></div>
               
                


            
              
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

                    <label class="label" for="map"style="font-size: 13px; color: #4A4A4B; ">Google Map</label>
					<input type="map" class="form-control form-control-sm" name="map" id="map" value="<?php echo $_settings->info('map') ?>">

                </div>

                <div class="form-group">
                    <label for="" class="control-label">System Logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="coimg" name="contactus1" onchange="displayImg4(this,$(this))">
                        <label class="custom-file-label" for="coimg">Choose file</label>
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
        function displayImg4(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#coimg').attr('src', e.target.result);
                _this.siblings('.custom-file-label').html(input.files[0].name)
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
$(document).ready(function(){
    var summernoteInstance = $('.summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']], // Include the font size dropdown
            ['color', ['color']],
            ['para', ['ol', 'ul', 'paragraph', 'height']],
            ['table', ['table']],
            ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
        ],
        fontSizes: ['8pt', '10pt', '12pt', '14pt', '16pt', '18pt', '20pt', '24pt', '28pt', '32pt', '36pt', '40pt', '48pt', '56pt', '64pt'],
        fontNames: ['Arial', 'Times New Roman', 'Courier New', 'Custom Font', 'Montserrat'], 

    });

    // Add a listener for the font size dropdown change event
    $('.note-fontsize').on('change', function (event) {
        var fontSize = $(this).val();
        summernoteInstance.summernote('fontSize', fontSize);
    });

    // Add a listener for the "Set Custom Font Size" button
    $('#setCustomFontSize').on('click', function (event) {
        var customFontSize = $('#customFontSize').val();
        summernoteInstance.summernote('fontSize', customFontSize);
    });

    // Add a listener for the "fontname" dropdown change event
    $('.note-fontname').on('change', function (event) {
        var fontName = $(this).val();
        if (fontName === 'Custom Font') {
            // Handle the custom font upload here
            // You can use a file input to allow users to upload a custom font file
        } else {
            summernoteInstance.summernote('fontName', fontName);
        }
    });
});
</script>
