<script src="https://www.paypalobjects.com/api/checkout.js"></script>
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
    .label-info{
        font-style: bold;
        font-size: 25px;

        margin: 5% 0 1% 0;
    }

 

  

.card-body{
       border-radius: 10px;
      padding:2%;
        border: 1px solid #609AC4;
       border-radius: 4px;
       width: 100%;
       margin: 4% 2% 1% 2%;
}

            /* Add this CSS to your stylesheet */
            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }


    .left,
    .right{
            width: 50%;
            margin:2%;
            padding: 2%;
            background-color: #FFFFFF;
    }

    .right {
            position: sticky;
            top: 0;
            background-color: rgba(96, 154, 196, 0.7);
            height: 100vh; /* Set a height for the sticky container */
        }





  
    .place-order{
        margin:4% 0;;
    }

    .input-form-name {
        display: flex;
        flex-direction: row;
       
    }

    .zip-city {
        display: flex;
        flex-direction: row;
       
    }
   

    .fname,
    .lname{
        width: 50%;
        margin: 0 0 0 1%;

    }

    .zip{
        width: 50%;
        margin: 0 0 0 1%;

    }

    .option{
        padding:2%;
        margin: 2%;


    }

   small{
    margin:2%;
   }

   input:active{
    border-color: #004399;
   }

   .card-body .option{
    border-radius: 4px;
      padding:1%;
        border: 1px solid #609AC4;
       border-radius: 4px;
       width: 100%;
       margin: 0.5% 2%;
}

  .info-summer-form{
    display: flex;
        flex-direction: row;
        width: 100%;
  }

  .righth2{
    font-size: 25px;
  }

  .product-sum{
    display: flex;
    flex-direction: column;
  }

  .sum-info{
    display: flex;
    flex-direction: row ;
    justify-content: space-between;
    align-items: center;
    margin:0 7%;
  }
  .img-sum{
    width:  auto;
    height: 100px;

  }


.card-body .input{ 
    border-radius: 10px;
    padding: 2%; 
    border: 1px solid #609AC4; 
    border-radius: 4px; 
    width: 100%; 
    margin: 5px 0; /* Adjust the margin as needed */ 
}

 .order-type{
    margin: 5% 0;

 } 

 .ordertype {
    margin: 2% 0;
 }



  
</style>


<div class="content ">

    <div class="container">
       
           
            <div class="card-body">
           

                <form action="" id="place_order" class="info-summer-form">

            <div class="left">

            <h1 class="label-info"><strong>Contact</strong></h1>  
                <div class="form-group">
                        
                        <input class="input" type="email" name="email" id="email" placeholder="yourmail@gmail.com" required value="<?= isset($email) ? $email : "" ?>">
                        <input class="input" type="number"name="phone_number" id="phone_number" rows="3" class="phone_number" placeholder="Phone"
                        value="<?= isset($contact) ? $contact : "" ?>"></input required>
               
                </div>

                <h1 class="label-info"><strong>Delivery</strong></h1> 

                
                    <div class="form-group">

                    <div class ="input-form-name">

                    <div class ="fname">
                    <input class="input" type="text" name="firstname" id="firstname" placeholder="First Name" autofocus value="<?= isset($firstname) ? $firstname : "" ?>" required>
                    </div>

                    <div class ="lname">
                    <input class="input" type="text" name="lastname" id="lastname" placeholder="Last Name" required value="<?= isset($lastname) ? $lastname : "" ?>">
                    </div>

                    </div>

                    </div>
                        <div class="order-type">
                     <p for="" class="ordertype">Order Type</p>

                     <div class ="ordertype">
                     <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio1" name="order_type" value="1" checked>
                    <label for="customRadio1" class="custom-label">JRS </label><br>
                    </div>

                <div class ="ordertype">  
                    <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio2" name="order_type" value="2">
                    <label for="customRadio2" class="custom-label">Lalamove (Shipping fee care of buyer)</label><br>
                    </div>
                    

                    <div class ="ordertype">
                    <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio3" name="order_type" value="3">
                    <label for="customRadio3" class="custom-label">Pick up (No shipping fee)</label><br>
                    </div>

                    <div class ="ordertype">
                    <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio4" name="order_type" value="4">
                    <label for="customRadio4" class="custom-label">Meet up (Shipping fee care of buyer)</label><br>
                    </div>
                    
                    </div>


                    <div class="province jnt-holder">
                    <small class="label">Province</small>
                    <!-- <select  id="province" name="province" placeholder="Please select your province"class="option select2" required>

	                    <option type="varchar" value="bataan" <?= (isset($province) && $province === 'bataan') ? 'selected' : '' ?>>Bataan</option>
                    </select> -->
                    <?php
                            $api_url_province = 'https://ph-locations-api.buonzz.com/v1/provinces';
                            $response1 = file_get_contents($api_url_province);
                            
                            // Handle JSON data
                            $provinces = json_decode($response1, true);
                            $selectedProvinceId = $province;

                                if ($provinces['data'] && is_array($provinces['data'])) {
                                    echo '<select name="province" id="provinces">';
                                    foreach ($provinces['data'] as $option) {
                                        $optionId = $option['id'];
                                        $optionName = $option['name'];
                                        
                                        $selected1 = ($optionId === $selectedProvinceId) ? 'selected' : '';
                                        echo '<option value="' . $optionId . '" ' . $selected1 . '>' . $optionName . '</option>';
                                    }
                                    echo '</select>';
                                } else {
                                    echo 'Failed to fetch or decode data.';
                                }

                                /*** */
                                $api_url_city = 'https://ph-locations-api.buonzz.com/v1/cities';
                                $response2 = file_get_contents($api_url_city);
                                
                                // Handle JSON data
                                $cities = json_decode($response2, true);
                                $selectedCityId = $city;

                                    if ($cities['data'] && is_array($cities['data'])) {
                                        echo '<select name="city" id="cities">';
                                        foreach ($cities['data'] as $option) {
                                            $optionId = $option['id'];
                                            $optionName = $option['name'];
                                            
                                            $selected2 = ($optionId === $selectedCityId) ? 'selected' : '';
                                            echo '<option value="' . $optionId . '" ' . $selected2 . '>' . $optionName . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo 'Failed to fetch or decode data.';
                                    }
                        ?>

                    <br>
                    <input name="addressline1" id="addressline1" rows="3" class="form-control form-control-sm rounded-0" placeholder="Address Line 1" value="<?= isset($addressline1) ? $addressline1 : "" ?>"></input required>
                    <input name="addressline2" id="addressline2" rows="3" class="form-control form-control-sm rounded-0" placeholder="Address Line 2 (Apartment, suite, etc, (optional))" value="<?= isset($addressline2) ? $addressline2: "" ?>"></input optional>


                       <div class="zip-city">
                       <div class="zip">
                       <input type="varchar"name="zipcode" id="zipcode" rows="3" class="zipcode" placeholder="Zip Code" value="<?= isset($zipcode) ? $zipcode: "" ?>"></input required>
                        </div>
                       
                       </div>

                       </div>  <!--J&T-HOLDER-END-->

                       <div class="pick-up-holder">
                            <small class="label">Pick-Up Address</small>
                            <select name="pickup" id="puAddressDropdown">
                                <option value="pu_dasma">BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE</option>
                                <option value="pu_makati">EVANGELISTA ST. COR ARGUELLES PETRON STATION MAKATI CITY</option>
                            </select>
                        </div>

                        <div class="meet-up-holder">
                            <small class="label">Meet Up Address</small>
                            <select name="meetup" id="muAddressDropdown">
                                <option value="mu_dasma" id="opt_dasma">DASMARINAS AREA</option>
                                <option value="mu_imus" id="opt_imus">IMUS AGUINALDO HIGHWAY</option>
                                <option value="mu_bacoor" id="opt_bacoor">BACOOR AGUINALDO HIGHWAY</option>
                                <option value="mu_zapote" id="opt_zapote">ZAPOTE PALENGKE</option>
                                <option value="mu_laspinas" id="opt_laspinas">LAS PINAS HOSPITAL</option>
                                <option value="mu_sucat" id="opt_sucat">SM SUCAT BUILDING 2</option>
                                <option value="mu_airport" id="opt_airport">AIRPORT ROAD</option>
                                <option value="mu_other" id="opt_other">OTHER</option>
                            </select>
                        </div>

                        <div class="other-meet-up">
                            <input type="text" placeholder="Enter Meeting Point" name="othermu"/>
                        </div>
                    
                    <div class="place-order form-group text-right">
                        <button class="btn btn-flat btn-primary">Place Order</button>
                    </div>

                    <!-- TODO: saving of meet up address -->

            </div>
          
            <div class="right">
                <div class="product-sum">
                    <?php
                    $total = 0;
                    $cart = $conn->query("SELECT c.*, p.name, p.price, p.image_path, p.weight, b.name as brand, cc.category, v.* FROM `cart_list` c
                                    INNER JOIN product_list p ON c.product_id = p.id
                                    INNER JOIN brand_list b ON p.brand_id = b.id
                                    INNER JOIN categories cc ON p.category_id = cc.id
                                    INNER JOIN product_variations v ON p.variation_id = v.id
                                    WHERE c.client_id = '{$_settings->userdata('id')}' ORDER BY p.name ASC");
                    ?>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th width="25%">Image</th>
                                <th>Product Name</th>
                                <th>Variation</th>
                                <th>Weight</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $cart->fetch_assoc()) : ?>
                                <tr>
                                    <td width="25%"><img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-sum"></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['variation_name'] ?></td>
                                    <td><?= $row['weight'] ?></td>
                                    <td><?= $row['quantity'] ?></td>
                                    <td><?= $row['price'] ?></td>
                                </tr>
                                <?php
                                $total += ($row['quantity'] * $row['price']);
                                $shipping = 0;
                                if($row['weight'] == "500g and below"){
                                    $shipping = 117;
                                }
                                else if($row['weight'] == "500g – 1kg"){
                                    $shipping = 200;
                                }
                                else if($row['weight'] == "1kg – 3kg"){
                                    $shipping = 300;
                                }
                                else if($row['weight'] == "3kg – 4kg"){
                                    $shipping = 400;
                                }
                                else if($row['weight'] == "4kg – 5kg"){
                                    $shipping = 500;
                                }
                                else if($row['weight'] == "5kg – 6kg"){
                                    $shipping = 600;
                                }
                                $total = $total + $shipping;
                                ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <h4 class="righth2">Shipping Fee: <?= number_format($shipping, 2) ?></h2>
                    <h2 class="righth2">Total Price: <?= number_format($total, 2) ?></h2>
                </div>
            </div>


            </form>
    
    </div>
</div>
<script>
$(function(){
    $('.pick-up-holder').hide('slow');
    $('.meet-up-holder').hide('slow');
    $('.other-meet-up').hide('slow');
    fetchCities();
    setOtherMeetup();
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

    function setOtherMeetup(){
        document.getElementById('muAddressDropdown').addEventListener('change', function() {
        let selectedValue = this.value;
        console.log(selectedValue);

        if(selectedValue === 'mu_other'){
            $('.other-meet-up').show('slow');
        }else{
            $('.other-meet-up').hide('slow');
        }

        });

    }
    


    $('[name="order_type"]').change(function() {
    if ($(this).val() == 1) {
        $('.jnt-holder').show('slow');
        $('.pick-up-holder').hide('slow'); 
        $('.meet-up-holder').hide('slow'); 
    }
    else if ($(this).val() == 2) {
        $('.jnt-holder').hide('slow');
        $('.pick-up-holder').hide('slow');
        $('.meet-up-holder').hide('slow'); 
    } else if ($(this).val() == 3) {
        $('.jnt-holder').hide('slow');
        $('.pick-up-holder').show('slow'); 
        $('.meet-up-holder').hide('slow'); 
    } else if ($(this).val() == 4) {
        $('.jnt-holder').hide('slow');
        $('.pick-up-holder').hide('slow'); 
        $('.meet-up-holder').show('slow'); 
    }else {
        $('.jnt-holder').show('slow'); 
        $('.pick-up-holder').hide('slow');
        $('.meet-up-holder').hide('slow'); 
    }
});



        $('#place_order').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=place_order",
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
						location.replace('./?p=my_orders');
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
    })
   
</script>