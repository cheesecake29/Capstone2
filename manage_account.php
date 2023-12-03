<?php 
if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2){
    $qry = $conn->query("SELECT * FROM `client_list` where id = '{$_settings->userdata('id')}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    } else {
        echo "<script> alert('You are not allowed to access this page. Unknown User ID.'); location.replace('./') </script>";
    }
} else {
    echo "<script> alert('You are not allowed to access this page.'); location.replace('./') </script>";
}
?>

<style>
     .name {
        display: flex;
        justify-content: center;
        margin: 2% 0 0 0 ;
    }

    .register-frm {
    
       
        padding: 1%;
        flex-direction: column;
       
    }

    

    .label {
        text-align: left;
    }

    input {
        width: 100%;
        margin:1% 0;
        padding: 1%;
    }
    .left,
    .right{
            width: 70%;
            margin:2%;
            border: none;
            border-radius: 2px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 2%;
            background-color: #FFFFFF;

    }

    body{
        background-color: #F9F9F9;
    }

    /* Add this CSS for the password container */
.password-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Adjust the width of the password input and the button */
.password-container input {
    flex: 1; /* This will make the input take up available space */
    padding-right: 30px; /* Add some right padding for better spacing */
}

.password-toggle {
    cursor: pointer;
    padding-left: 10px; /* Add some left padding for better spacing */
}

.label-rem{
    margin-top:2%;
}

.input-container{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
  
.update{
    display:flex;
    justify-content: center;
    align-items: center;
} 

.zip{
        width: 50%;
        margin: 0 0 0 1%;

    }

    .option{
        padding:2%;
        margin: 2%;


    }

    .update-info {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
       


    }

    .update-info button{
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin: 2% 0;
        border:none;
        border-radius: 35px;
        background-color: #004399;
        padding: 1%;
        color: white;


    }


    .input-form-fname,
.input-form-lname,
.input-form-email,
.input-form-contact,
.input-form-zip,
.input-form-province,
.input-form-city,
.input-form-add1,
.input-form-add2,
.input-form-region {
    display: inline-block;
    border: 1px solid #B3B3B3;
    margin: 1%; /* Adjusted margin values */
    width: 48%; /* Adjusted width to accommodate two inline blocks in a row */
    box-sizing: border-box; /* Ensure padding and border are included in the width */
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    background-color: #FFFFFF;
   
}

.input-form-add1,
.input-form-add2,
.input-form-region {
    width: 98%; /* Adjusted width for full width with a slight margin */
}

 .address-holder{
    display: inline-block;
    border: 1px solid #B3B3B3;
    margin: 1%; /* Adjusted margin values */
    width: 98%;
    box-sizing: border-box; /* Ensure padding and border are included in the width */
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    background-color: #FFFFFF;
    padding: 2%; /* Add padding for better spacing */
 }

    .input-form input,
    .input-form-fname input,
    .input-form-lname input,
    .input-form-email input,
    .input-form-contact input,
    .input-form-add1 input,
    .input-form-add2 input,
    .input-form-zip input
    {
        outline: none;
        border: none;
        display:block;
        line-height: 1.2em;
        font-size: 14pt;
        padding: 2%;
   
    }

    

  

    .input-form small,
    .input-form-fname small,
    .input-form-lname small,
    .input-form-email small,
    .input-form-contact small,
    .input-form-add1 small,
    .input-form-add2 small,
    .input-form-zip small,
    .input-form-province small,
    .input-form-city small,
    .input-form-region small
    {
        display: block;
        font-size: 12px;
        color: #004399;
        margin: 1% 3% ;

       
    }

   
.fname-lname-holder,
.contact-email-holder
{
    display: flex;
    flex-direction: row;
}

.input-form-region select,
.input-form-province select,
.input-form-city select{
    font-size: 18px;
    width: 100%; /* Adjust the width as needed */
    outline: none;
    border: none;
    display: block;
    line-height: 1.2em;
    font-size: 14pt;
    padding: 2%;
}

.ad{
    color: #004399;
}


@media only screen and (max-width: 900px) {
        .name {
            margin: 5% 0; /* Adjusted margin for better spacing on smaller screens */
        }

        .left,
        .right {
            width: 100%;
            margin: 2%;
            padding: 2%; /* Adjusted padding for better spacing on smaller screens */
        }

        .fname-lname-holder,
        .contact-email-holder {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .input-form,
        .input-form-fname,
        .input-form-lname,
        .input-form-email,
        .input-form-contact,
        .input-form-add1,
        .input-form-add2,
        .input-form-zip,
        .input-form-province,
        .input-form-city,
        .input-form-region {
            width: 100%;
            margin: 2% 0; /* Adjusted margin for better spacing on smaller screens */
        }

        .address-holder,
        .password-container {
            width: 100%;
        }

        .input-form input,
        .input-form-fname input,
        .input-form-lname input,
        .input-form-email input,
        .input-form-contact input,
        .input-form-add1 input,
        .input-form-add2 input,
        .input-form-zip input,
        .input-form-province select,
        .input-form-city select,
        .input-form-region select {
            width: 100%;
            padding: 2%;
            margin: 1% 0; /* Adjusted margin for better spacing on smaller screens */
        }

        .update-info button {
            margin: 2% 0;
        }
    }
  


</style>

<div class="content">
    <div>
        <div>
            
            <div>
                <div>
                <div class="name">
                <h4>Manage Account Details/Credentials</h4>
            </div>

            <form id="register-frm" class="register-frm" action="" method="post">
                <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">

                <div class="input-container">
                    <div class="left">
                        <h4 style="font-weight: bold; font-size: 20px; margin: 0 3%;">Personal Details</h4>

                        <!-- First Name and Last Name inputs -->
                        <div class="fname-lname-holder">
                            <!-- First Name input -->
                            <div class ="input-form-fname">
                                <small class="label">First Name:</small>
                                <input type="text" name="firstname" id="firstname" placeholder="Enter First Name" autofocus value="<?= isset($firstname) ? $firstname : "" ?>" onkeydown="return allowOnlyLetters(event)" required>
                            </div>

                            <!-- Last Name input -->
                            <div class ="input-form-lname">
                                <small class="label">Last Name:</small>
                                <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name" required value="<?= isset($lastname) ? $lastname : "" ?>" onkeydown="return allowOnlyLetters(event)" required>
                            </div>
                        </div>

                        <!-- Email and Contact inputs -->
                        <div class="contact-email-holder">
                            <!-- Email input -->
                            <div class="input-form-email">
                                <small class="label">Email:</small>
                                <input type="email" name="email" id="email" placeholder="arnoldtvmotoshop@gmail.com" required value="<?= isset($email) ? $email : "" ?>">
                            </div>

                            <!-- Contact input -->
                            <div class="input-form-contact">
                                <small class="label">Contact:</small>
                                <input type="text" name="contact" id="contact" placeholder="Contact Number" value="<?= isset($contact) ? $contact : "" ?>" onkeydown="return allowOnlyNumbers(event)" required>
                            </div>
                        </div>
                        <br>
                        <h4 style="font-weight: bold; font-size: 20px; margin: 0 3%;">Default Address</h4>

                        <div class="col-md-12">

                            <?php
                            $api_url_region = 'https://ph-locations-api.buonzz.com/v1/regions';
                            $response1 = file_get_contents($api_url_region);

                            // Handle JSON data
                            $regions = json_decode($response1, true);

                            if ($regions['data'] && is_array($regions['data'])) {
                                echo '<div class="input-form-region">';
                                echo '<small class="label">Select Region</small>';
                                echo '<select name="region" id="regions">';
                                foreach ($regions['data'] as $option) {
                                    echo '<option value="' . $option['id'] . '">' . $option['name'] . '</option>';
                                }
                                echo '</select>';
                                echo '</div>';
                            } else {
                                echo 'Failed to fetch or decode data.';
                            }


                            echo '<div class="province-city-holder">';
                            echo '<div class="input-form-province">';
                            echo '<small class="label">Select Province</small>';
                            echo '<select name="province" id="provinces" disabled>

                                    <option>Select Province</option>
                                </select>';
                            echo '</div>';

                            echo '<div class="input-form-city">';
                            echo '<small class="label">Select City</small>';
                            echo '<select name="city" id="cities" disabled>

                                    <option>Select City</option>
                                </select>';
                            echo '</div>';
                            echo '</div>';

                            ?>

                            </div>


                          
                       


                            <div class="addresses">
                        <?php
                             //get region name
                             $api_url1 = 'https://ph-locations-api.buonzz.com/v1/regions';
                             $response3 = file_get_contents($api_url1);
 
                             $regions = json_decode($response3, true);
 
                             $regionCode = $region;
 
                             $regionName = null;
 
                             
 
                             foreach ($regions['data'] as $region) {
                                 if ($region['id'] === $regionCode) {
                                     $regionName = $region['name'];
                                     break; 
                                 }
                             }

                            //get province name
                            $api_url = 'https://ph-locations-api.buonzz.com/v1/provinces';
                            $response = file_get_contents($api_url);

                            $provinces = json_decode($response, true);

                            $provinceCode = $province;

                            $provinceName = null;

                            foreach ($provinces['data'] as $province) {
                                if ($province['id'] === $provinceCode) {
                                    $provinceName = $province['name'];
                                    break; 
                                }
                            }

                            //get city name
                            $api_url2 = 'https://ph-locations-api.buonzz.com/v1/cities';
                            $response2 = file_get_contents($api_url2);

                            $cities = json_decode($response2, true);

                            $cityCode = $city;

                            $cityName = null;



                            foreach ($cities['data'] as $city) {
                                if ($city['id'] === $cityCode) {
                                    $cityName = $city['name'];
                                    break; 
                                }
                            }

                             
                            echo '<div class="address-holder">';
                            echo '<b><p>Customer Address: </p></b>';
                            echo '<small class="ad">Region: </small>' . $regionName ;
                            echo '<br>' ;
                            echo '<small class="ad">Province: </small>' . $provinceName ;
                            echo '<br>' ;
                            echo '<small  class="ad">City:  </small>' . $cityName ;
                            echo '</div>';


                        ?>


                </div>
              <!-- <button class="btn btn-primary btn-flat btn-sm" type="button" id="edit_address"><i class="fa fa-edit"></i>Edit address</button> -->
                            
                        <!-- Address inputs (Address Line 1, Address Line 2, Zip Code) -->
                        <div class ="input-form-add1">
                        <small class="label">Address Line 1</small>
                        <input name="addressline1" id="addressline1" rows="3" class="form-control form-control-sm rounded-0" placeholder="Address Line 1" value="<?= isset($addressline1) ? $addressline1 : "" ?>" required>
                        </div>

                        <div class ="input-form-add2">
                        <small class="label">Address Line 2</small>
                        <input name="addressline2" id="addressline2" rows="3" class="form-control form-control-sm rounded-0" placeholder="Address Line 2 (Apartment, suite, etc, (optional))" value="<?= isset($addressline2) ? $addressline2 : "" ?>" optional>
                        </div>

                        <div class="input-form-zip">
                            <small>Zip Code</small>
                            <input type="varchar" name="zipcode" id="zipcode" placeholder="Zip Code" value="<?= isset($zipcode) ? $zipcode : "" ?>" onkeydown="return allowOnlyNumbers(event)" required>
                        </div>
                           
                        

                        <!-- Update button -->
                        <div class="update-info">
                            <button type="submit">SAVE CHANGES</button>
                        </div>
                    </div>

                    <!-- Right side for Password fields -->
                    <div class="right">
                        <!-- Current Password input -->
                        <div class="input-form">
                            <small class="label">Current Password:</small>
                            <div class="password-container">
                                <input type="password" name="oldpassword" id="oldpassword" placeholder="">
                                <span class="password-toggle"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                            </div>
                        </div>
                        
                        <!-- New Password inputs -->
                        <div><small class="label-rem"><em>(Fill the password fields only if you want to update your password)</em></small></div>
                        <div class="input-form">
                            <small class="label">New Password:</small>
                            <div class="password-container">
                                <input type="password" name="password" id="password" placeholder="">
                                <span class="password-toggle"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                            </div>
                        </div>
                        
                        <!-- Confirm New Password input -->
                        <div class="input-form">
                            <small class="label">Confirm New Password:</small>
                            <div class="password-container">
                                <input type="password" id="cpassword" placeholder="">
                                <span class="password-toggle"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                            </div>
                        </div>
                        
                        <!-- Update button -->
                        <div class="update-info">
                            <button type="submit">SAVE CHANGES</button>
                        </div>
                    </div>
                </div>

            </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function allowOnlyLetters(event) {
        // Check if the key pressed is a letter
        if (event.key.match(/[A-Za-z]/)) {
            return true;  // Allow the key press
        } else {
            return false; // Prevent the key press
        }
    }


    function allowOnlyNumbers(event) {
    // Check if the key pressed is a number or the backspace key
    if (event.key.match(/[0-9]/) || event.keyCode === 8 /* Backspace */) {
        return true;  // Allow the key press
    } else {
        return false; // Prevent the key press
    }
}
$(function(){
    $('#edit_address').click(function(){
        uni_modal("Edit Address", "edit_address.php","mid-large");
    })
    });

    $(function(){
    fetchProvince();
    fetchCities();
    let selectedProvince = '';
    let selectedCity = '';

    function fetchProvince(){
        document.getElementById('regions').addEventListener('change', function() {
        var selectedRegion = this.value;

        // Fetch provinces based on the selected region
        fetch('https://ph-locations-api.buonzz.com/v1/provinces')
            .then(response => response.json())
            .then(data => {
                var provincesDropdown = document.getElementById('provinces');
                provincesDropdown.innerHTML = ''; // Clear previous options
                provincesDropdown.removeAttribute('disabled');

                let filteredProvinces = data['data'].filter(province => province.region_code === selectedRegion);

                if (filteredProvinces && Array.isArray(filteredProvinces)) {
                    filteredProvinces.forEach(function(province) {
                        var option = document.createElement('option');
                        option.value = province['id'];
                        option.text = province['name'];
                        provincesDropdown.appendChild(option);
                    });
                } else {
                    var option = document.createElement('option');
                    option.text = 'No provinces found';
                    provincesDropdown.appendChild(option);
                }
            })
            .catch(error => {
                console.error('Error fetching provinces:', error);
            });
        });
    }

    function fetchCities(){
        document.getElementById('provinces').addEventListener('change', function() {
        let dropdown = this;
        var selectedProvinceCode = this.value;
        selectedProvince = dropdown.options[dropdown.selectedIndex].text;
        console.log(selectedProvince);

        // Fetch provinces based on the selected region
        fetch('https://ph-locations-api.buonzz.com/v1/cities')
            .then(response => response.json())
            .then(data => {
                var citiesDropdown = document.getElementById('cities');
                citiesDropdown.innerHTML = ''; // Clear previous options
                citiesDropdown.removeAttribute('disabled');

                let filteredCities = data['data'].filter(city => city.province_code === selectedProvinceCode);
                console.log(filteredCities);

                if (filteredCities && Array.isArray(filteredCities)) {
                    filteredCities.forEach(function(city) {
                        var option = document.createElement('option');
                        option.value = city['id'];
                        option.text = city['name'];
                        citiesDropdown.appendChild(option);
                        fetchSelectedCity();
                    });
                } else {
                    var option = document.createElement('option');
                    option.text = 'No cities found';
                    citiesDropdown.appendChild(option);
                }
            })
            .catch(error => {
                console.error('Error fetching cities:', error);
            });
        });
    }

    function fetchSelectedCity(){
        document.getElementById('cities').addEventListener('change', function() {
            let dropdown = this;
            selectedCity = dropdown.options[dropdown.selectedIndex].text;
            console.log(selectedCity);
        });
        
    }

    
       
        

        $('.pass_type').click(function(){
            var type = $(this).attr('data-type')
            if(type == 'password'){
                $(this).attr('data-type','text')
                $(this).closest('input-group').find('input').attr('type',"text")
                $(this).removeClass("fa-eye-slash")
                $(this).addClass("fa-eye")
            } else {
                $(this).attr('data-type','password')
                $(this).closest('input-group').find('input').attr('type',"password")
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
                    alert_toast("An error occurred",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        location.reload();
                    } else if(resp.status == 'failed' && !!resp.msg){   
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                    } else {
                        alert_toast("An error occurred",'error');
                        end_loader();
                        console.log(resp)
                    }
                    end_loader();
                    $('html, body').scrollTop(0)
                }
            })
        })
    })
</script>