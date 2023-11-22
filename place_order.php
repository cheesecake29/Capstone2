<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<?php
if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2) {
    $qry = $conn->query("SELECT * FROM `client_list` where id = '{$_settings->userdata('id')}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
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
    .label-info {
        font-style: bold;
        font-size: 25px;

        margin: 5% 0 1% 0;
    }

    .card-body {
        border-radius: 10px;
        padding: 2%;
        border: 1px solid #609AC4;
        border-radius: 4px;
        width: 100%;
    }

    /* Add this CSS to your stylesheet */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .left,
    .right {
        width: 50%;
        background-color: #FFFFFF;
    }

    .right {
        position: sticky;
        top: 0;
        background-color: rgba(96, 154, 196, 0.7);
        /* Set a height for the sticky container */
    }

    .place-order {
        margin: 4% 0;
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
    .lname {
        width: 50%;
        margin: 0 0 0 1%;
    }

    .zip {
        width: 50%;
        margin: 0 0 0 1%;
    }

    .option {
        padding: 2%;
        margin: 2%;
    }

    small {
        margin: 2%;
    }

    input:active {
        border-color: #004399;
    }

    .card-body .option {
        border-radius: 4px;
        padding: 1%;
        border: 1px solid #609AC4;
        border-radius: 4px;
        width: 100%;
        margin: 0.5% 2%;
    }

    .info-summer-form {
        display: flex;
        flex-direction: row;
        width: 100%;
    }

    .righth2 {
        font-size: 25px;
    }

    .product-sum {
        display: flex;
        flex-direction: column;
    }

    th,
    td,
    span {
        font-size: 14px;
    }

    .sum-info {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin: 0 7%;
    }

    .img-sum {
        width: auto;
        height: 50px;
    }

    .card-body .input {
        border-radius: 10px;
        padding: 2%;
        border: 1px solid #609AC4;
        border-radius: 4px;
        width: 100%;
        margin: 5px 0;
        /* Adjust the margin as needed */
    }

    .order-type {
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
                <div class="left mx-3">
                    <h1 class="label-info"><strong>Contact</strong></h1>
                    <div class="form-group">
                        <input class="input" type="email" name="email" id="email" placeholder="yourmail@gmail.com" required value="<?= isset($email) ? $email : "" ?>">
                        <input class="input" type="number" name="phone_number" id="phone_number" rows="3" class="phone_number" placeholder="Phone" value="<?= isset($contact) ? $contact : "" ?>"></input required>
                    </div>
                    <h1 class="label-info"><strong>Delivery</strong></h1>
                    <div class="form-group">
                        <div class="input-form-name">
                            <div class="fname">
                                <input class="input" type="text" name="firstname" id="firstname" placeholder="First Name" autofocus value="<?= isset($firstname) ? $firstname : "" ?>" required>
                            </div>
                            <div class="lname">
                                <input class="input" type="text" name="lastname" id="lastname" placeholder="Last Name" required value="<?= isset($lastname) ? $lastname : "" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="order-type">
                        <h1 class="label-info"><strong>Order Type</strong></h1>
                        <div class="ordertype">
                            <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio1" name="order_type" value="1" checked>
                            <label for="customRadio1" class="custom-label">JRS </label><br>
                        </div>
                        <div class="ordertype">
                            <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio2" name="order_type" value="2">
                            <label for="customRadio2" class="custom-label">Lalamove (Shipping fee care of buyer)</label><br>
                        </div>
                        <div class="ordertype">
                            <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio3" name="order_type" value="3">
                            <label for="customRadio3" class="custom-label">Pick up (No shipping fee)</label><br>
                        </div>
                        <div class="ordertype">
                            <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio4" name="order_type" value="4">
                            <label for="customRadio4" class="custom-label">Meet up (Shipping fee care of buyer)</label><br>
                        </div>
                    </div>

                    <div class="billing-address">
                        <h1 class="label-info"><strong>Billing Address</strong></h1>
                        <div class="custom-control custom-radio addresstype">
                            <input class="custom-control-input" type="radio" id="default" name="address_type" value="1" checked>
                            <label class="custom-control-label" for="default"><strong>Same as shipping address</strong></label>
                        </div>
                        <div class="custom-control custom-radio addresstype">
                            <input class="custom-control-input" type="radio" id="diff" name="address_type" value="2">
                            <label class="custom-control-label" for="diff"><strong>Use a different billing address</strong></label>
                        </div>
                            <div class="default-add">
                                <div class="province jnt-holder">
                                    <span class="custom-control-input custom-control-input-primary">Province</span>
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
                                        echo '<select name="province" id="provinces" class="form-control">';
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
                                        echo '<select name="city" id="cities" class="form-control">';
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
                                    <input name="addressline1" id="addressline1" rows="3" class="form-control rounded-0" placeholder="Address Line 1" value="<?= isset($addressline1) ? $addressline1 : "" ?>"></input>
                                    <input name="addressline2" id="addressline2" rows="3" class="form-control rounded-0" placeholder="Address Line 2 (Apartment, suite, etc, (optional))" value="<?= isset($addressline2) ? $addressline2 : "" ?>"></input>
                                    <input type="text" name="zipcode" id="zipcode" rows="3" class="form-control zipcode" placeholder="Zip Code" value="<?= isset($zipcode) ? $zipcode : "" ?>"></input>

                                </div> 
                            </div>

                            <div class="diff-add">
                                <div class="province jnt-holder">
                                    <span class="custom-control-input custom-control-input-primary">Province</span>

                                    <?php
                                    $api_url_province = 'https://ph-locations-api.buonzz.com/v1/provinces';
                                    $response1 = file_get_contents($api_url_province);

                                    // Handle JSON data
                                    $provinces = json_decode($response1, true);
                                    //$selectedProvinceId = $province;

                                    if ($provinces['data'] && is_array($provinces['data'])) {
                                        echo '<select name="province2" id="provinces2" class="form-control">';
                                        echo '<option value="0">-- Select Province --</option>';
                                        foreach ($provinces['data'] as $option) {
                                            $optionId = $option['id'];
                                            $optionName = $option['name'];

                                            //$selected1 = ($optionId === $selectedProvinceId) ? 'selected' : '';
                                            echo '<option value="' . $optionId . '">' . $optionName . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo 'Failed to fetch or decode data.';
                                    }
                                    ?>

                                    <?php
                                    $api_url_city = 'https://ph-locations-api.buonzz.com/v1/cities';
                                    $response2 = file_get_contents($api_url_city);
                                    // Handle JSON data
                                    $cities = json_decode($response2, true);
                                    //$selectedCityId = $city;

                                    if ($cities['data'] && is_array($cities['data'])) {
                                        echo '<select name="city2" id="cities2" class="form-control" disabled>';
                                        echo '<option value="0">-- Select City --</option>';
                                        foreach ($cities['data'] as $option) {
                                            $optionId = $option['id'];
                                            $optionName = $option['name'];

                                            //$selected2 = ($optionId === $selectedCityId) ? 'selected' : '';
                                            echo '<option value="' . $optionId . '">' . $optionName . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo 'Failed to fetch or decode data.';
                                    }
                                    ?>

                                    <input name="different_addressline1" id="different_addressline1" rows="3" class="form-control rounded-0" placeholder="Address Line 1 (Different Address)" value=""></input>
                                    <input name="different_addressline2" id="different_addressline2" rows="3" class="form-control rounded-0" placeholder="Address Line 2 (Different Address)" value=""></input>
                                    <input type="text" name="different_zipcode" id="different_zipcode" rows="3" class="form-control zipcode" placeholder="Zip Code (Different Address)" value=""></input>
                                </div>

                            </div>
                    </div>

                    <div class="pick-up-holder">
                        <h1 class="label-info"><strong>Pick-Up Address</strong></h1>
                        <select name="pickup" id="puAddressDropdown" class="form-control">
                            <option value="BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE">BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE</option>
                            <option value="EVANGELISTA ST. COR ARGUELLES PETRON STATION MAKATI CITY">EVANGELISTA ST. COR ARGUELLES PETRON STATION MAKATI CITY</option>
                        </select>
                    </div>

                    <div class="meet-up-holder">
                        <h1 class="label-info"><strong>Meet Up Address</strong></h1>
                        <select name="meetup" id="muAddressDropdown" class="form-control">
                            <?php
                            $getMeetupAddresses = $conn->query("SELECT * FROM `meet_up_address` where active = 1");
                            while ($rowAdd = $getMeetupAddresses->fetch_assoc()) :
                            ?>
                                <option value="<?= $rowAdd['text'] ?>" id="meetUpAddress-<?= $rowAdd['id'] ?>"><?= $rowAdd['text'] ?></option>
                            <?php endwhile; ?>
                            <option value="mu_other">OTHER</option>
                        </select>
                    </div>

                    <div class="other-meet-up">
                        <input type="text" class="form-control" placeholder="Enter Meeting Point" name="othermu" />
                    </div>

                    <div class="place-order form-group text-right">
                        <button class="btn btn-flat btn-primary">Place Order</button>
                    </div>

                    <!-- TODO: saving of meet up address -->

                </div>

                <div class="right mx-3">
                    <div class="product-sum h-100">
                        <?php
                        $total = 0;
                        $cart = $conn->query("SELECT c.*, p.name, p.image_path, p.weight, b.name as brand, cc.category, v.*, v.variation_price as price FROM `cart_list` c
                                    INNER JOIN product_list p ON c.product_id = p.id
                                    INNER JOIN brand_list b ON p.brand_id = b.id
                                    INNER JOIN categories cc ON p.category_id = cc.id
                                    INNER JOIN product_variations v ON c.variation_id = v.id
                                    WHERE c.client_id = '{$_settings->userdata('id')}' ORDER BY p.name ASC");
                        ?>
                        <div class="mx-3 py-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="25%" class="text-center">Image</th>
                                        <th>Product Name</th>
                                        <th>Variation</th>
                                        <th>Weight</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $shipping = 0;
                                    $totalItem = 0;
                                    while ($row = $cart->fetch_assoc()) : ?>
                                        <tr>
                                            <td width="25%" class="text-center">
                                                <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-sum">
                                            </td>
                                            <td>
                                                <span><?= $row['name'] ?></span>
                                            </td>
                                            <td>
                                                <span><?= $row['variation_name'] ?></span>
                                            </td>
                                            <td>
                                                <span><?= $row['weight'] ?></span>
                                            </td>
                                            <td>
                                                <span><?= $row['quantity'] ?></span>
                                            </td>
                                            <td>
                                                <span><?= number_format($row['price'], 2) ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                        $totalItem += ($row['quantity'] * $row['price']);
                                        switch ($row['weight']) {
                                            case "500g and below":
                                                $shipping += 117;
                                                break;
                                            case "500g – 1kg":
                                                $shipping += 200;
                                                break;
                                            case "1kg – 3kg":
                                                $shipping += 300;
                                                break;
                                            case "3kg – 4kg":
                                                $shipping += 400;
                                                break;
                                            case "4kg – 5kg":
                                                $shipping += 500;
                                                break;
                                            case "5kg – 6kg":
                                                $shipping += 600;
                                                break;
                                            default:
                                                $shipping += 0;
                                                break;
                                        }

                                        $total = $totalItem + $shipping;
                                        ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-auto mx-3 text-end">
                            <input name="shipping_amount" value="<?= $shipping ?>" type="hidden" />
                            <h5 id="sf">Shipping Fee: <?= number_format($shipping, 2) ?> </h5>
                            <h2 id="totalWithSf" class="righth2">Total Price: <?= number_format($total, 2) ?> </h2>
                            <h2 id="totalWithoutSf" class="righth2">Total Price: <?= number_format($totalItem, 2) ?> </h2>
                        </div>
                    </div>


            </form>

        </div>
    </div>
    <script>
        $(function() {
            let addressTypeVal = 1;
            $('.pick-up-holder').hide('slow');
            $('.meet-up-holder').hide('slow');
            $('.other-meet-up').hide('slow');
            $('.diff-add').hide('slow');
            $('#totalWithoutSf').hide('slow');
            $('.billing-address').show('slow');
            fetchCities();
            setOtherMeetup();

            function fetchCities() {
                document.getElementById('provinces2').addEventListener('change', function() {
                    let dropdown = this;
                    var selectedProvinceCode = this.value;
                    selectedProvince = dropdown.options[dropdown.selectedIndex].text;
                    console.log(selectedProvince);

                    // Fetch provinces based on the selected region
                    start_loader();
                    fetch('https://ph-locations-api.buonzz.com/v1/cities')
                        .then(response => response.json())
                        .then(data => {
                            var citiesDropdown = document.getElementById('cities2');
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
                                    //fetchSelectedCity();
                                });
                            } else {
                                var option = document.createElement('option');
                                option.text = 'No cities found';
                                citiesDropdown.appendChild(option);
                            }
                            end_loader();
                        })
                        .catch(error => {
                            console.error('Error fetching cities:', error);
                        });
                });
            }

            function setOtherMeetup() {
                document.getElementById('muAddressDropdown').addEventListener('change', function() {
                    let selectedValue = this.value;
                    console.log(selectedValue);

                    if (selectedValue === 'mu_other') {
                        $('.other-meet-up').show('slow');
                    } else {
                        $('.other-meet-up').hide('slow');
                    }
                });
            }
            $('[name="order_type"]').change(function() {
                if ($(this).val() == 1) {
                    $('.jnt-holder').show('slow');
                    $('.pick-up-holder').hide('slow');
                    $('.meet-up-holder').hide('slow');
                    $('#totalWithSf').show('slow');
                    $('#totalWithoutSf').hide('slow');
                    $('#sf').show('slow');
                    $('.billing-address').show('slow');
                } else if ($(this).val() == 2) {
                    $('.jnt-holder').hide('slow');
                    $('.pick-up-holder').hide('slow');
                    $('.meet-up-holder').hide('slow');
                    $('#totalWithSf').hide('slow');
                    $('#totalWithoutSf').show('slow');
                    $('.billing-address').hide('slow');
                    $('#sf').hide('slow');
                } else if ($(this).val() == 3) {
                    $('.jnt-holder').hide('slow');
                    $('.pick-up-holder').show('slow');
                    $('.meet-up-holder').hide('slow');
                    $('.other-up-holder').hide('slow');
                    $('#totalWithSf').hide('slow');
                    $('#totalWithoutSf').show('slow');
                    $('#sf').hide('slow');
                    $('.billing-address').hide('slow');
                } else if ($(this).val() == 4) {
                    $('.jnt-holder').hide('slow');
                    $('.pick-up-holder').hide('slow');
                    $('.meet-up-holder').show('slow');
                    $('#totalWithSf').hide('slow');
                    $('#totalWithoutSf').show('slow');
                    $('#sf').hide('slow');
                    $('.billing-address').hide('slow');
                } else {
                    $('.jnt-holder').show('slow');
                    $('.pick-up-holder').hide('slow');
                    $('.meet-up-holder').hide('slow');
                    $('#totalWithSf').hide('slow');
                    $('#totalWithoutSf').show('slow');
                    $('#sf').hide('slow');
                    $('.billing-address').show('slow');
                }
            });

            $('[name="address_type"]').change(function() {
                if ($(this).val() == 1) {
                    addressTypeVal = 1;
                    $('.default-add').show('slow');
                    $('.diff-add').hide('slow');
                }else{
                    addressTypeVal = 2;
                    $('.default-add').hide('slow');
                    $('.diff-add').show('slow');
                }

            });

            $('#place_order').submit(function(e) {
                e.preventDefault();
                var _this = $(this);
                var formData = new FormData($(this)[0]);

                formData.append('address_type', addressTypeVal);
                $('.err-msg').remove();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=place_order",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST',
                    dataType: 'json',
                    error: err => {
                        console.log(err)
                        alert_toast("An error occured", 'error');
                        end_loader();
                    },
                    success: function(resp) {
                        if (typeof resp == 'object' && resp.status == 'success') {
                            location.replace('./?p=my_orders');
                        } else if (resp.status == 'failed' && !!resp.msg) {
                            var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({
                                scrollTop: _this.closest('.card').offset().top
                            }, "fast");
                            end_loader()
                        } else {
                            alert_toast("An error occured", 'error');
                            end_loader();
                            console.log(resp)
                        }
                    }
                })
            })
        })
    </script>