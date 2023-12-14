<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<?php
$selectedValue = "";

include 'sendemailporder.php';
$total = 0;
$unAvailableDays = [];
$api_url_province = 'https://ph-locations-api.buonzz.com/v1/provinces';
$response1 = file_get_contents($api_url_province);
$api_url_city = 'https://ph-locations-api.buonzz.com/v1/cities';
$response2 = file_get_contents($api_url_city);
$all_order_config = $conn->query("SELECT * from order_config where is_all = 1 limit 1")->fetch_assoc();
$unavailableDates = $conn->query("SELECT * from unavailable_dates");
while ($unavailDate = $unavailableDates->fetch_assoc()) {
    array_push($unAvailableDays, $unavailDate);
}
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

    /* .left,
    .right {
        width: 50%;
        background-color: #FFFFFF;
    }

    .right {
        position: sticky;
        top: 0;
        background-color: rgba(96, 154, 196, 0.7);
    } */

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
        margin: unset !important;
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

    input,
    button,
    select:focus {
        box-shadow: unset !important;
    }

    .min-vh-5 {
        min-height: 5vh;
    }

    .min-vh-35 {
        min-height: 35vh;
    }


    .ui-datepicker {
        min-width: 300px;
    }

    .ui-datepicker .ui-datepicker-calendar {
        background: #fff;
    }

    .ui-datepicker table {
        width: 100%;
    }


    .ui-datepicker table td,
    .ui-datepicker table td th {
        border: 1px solid #1A547E;
        padding: 5px;
    }

    .ui-datepicker>table .ui-datepicker-unselectable {
        background-color: #1A547E;
        color: white;
    }

    .ui-datepicker>table .ui-datepicker-unselectable .ui-state-default {
        border: unset;
    }

    .ui-datepicker-header .ui-datepicker-prev {
        position: absolute;
        padding: 5px;
        color: white;
        left: 8px;
        cursor: pointer;
    }

    .ui-datepicker-header .ui-datepicker-title {
        width: 100%;
        text-align: center;
    }

    .ui-datepicker-header .ui-datepicker-next {
        position: absolute;
        padding: 5px;
        color: white;
        right: 8px;
        cursor: pointer;
    }

    .ui-datepicker-header {
        display: flex;
        align-items: center;
        background: #1A547E;
        min-height: 35px;
        color: white;
    }


    .ui-state-default,
    .ui-widget-content .ui-state-default,
    .ui-widget-header .ui-state-default {
        border-width: 1px 0 0 1px;
    }

    th {
        color: white;

    }

    thead {
        background-color: #0062CC;
        border: none;
    }

    .card-body {
        background-color: white;
    }
</style>
<div class="content ">
    <div class="container">
        <div class="card-body">
            <form action="" id="place_order" class="info-summer-form d-flex flex-column">
                <div class="d-flex flex-column w-100">
                    <div class="mx-1">
                        <div class="product-sum h-100">
                            <?php
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

                                            $total = $totalItem;
                                            ?>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-auto mx-3 text-end min-vh-5">
                                <input name="shipping_amount" value="<?= $shipping ?>" type="hidden" />
                                <p id="sf"><i>Shipping Fees Notice: Our system does not include shipping fees. Please note that shipping costs will be applied separately during checkout</i></p>
                                <h2 id="totalWithSf" class="righth2">Total Price: <?= number_format($total, 2) ?> </h2>
                                <h2 id="totalWithoutSf" class="righth2" style="display: none;">Total Price: <?= number_format($totalItem, 2) ?> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="mx-1">
                        <h1 class="label-info mt-3"><strong>Contact <span style="color: red;">*</span></strong></h1>
                        <div class="dropdown-divider my-3"></div>
                        <div class="form-group">
                            <input class="form-control mb-2" type="email" name="email" id="email" placeholder="yourmail@gmail.com" required value="<?= isset($email) ? $email : "" ?>">
                            <input class="form-control mb-2" type="text" name="phone_number" id="phone_number" rows="3" class="phone_number" placeholder="Phone" value="<?= isset($contact) ? $contact : "" ?>" onkeydown="return allowOnlyNumbers(event)" maxlength="11" required>
                        </div>
                        <h1 class="label-info mt-3"><strong>Delivery</strong></h1>
                        <div class="dropdown-divider my-3"></div>
                        <div class="form-group">
                            <div class="input-form-name">
                                <div class="fname">
                                    <input class="form-control" type="text" name="firstname" id="firstname" placeholder="First Name" autofocus value="<?= isset($firstname) ? $firstname : "" ?>" onkeydown="return allowOnlyLetters(event)" required>
                                </div>
                                <div class="lname">
                                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name" required value="<?= isset($lastname) ? $lastname : "" ?>" onkeydown="return allowOnlyLetters(event)" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-100 min-vh-35 mt-3">
                            <div class="w-50 order-type-container">
                                <h1 class="label-info mt-2"><strong>Order Type</strong></h1>
                                <div class="dropdown-divider my-3"></div>
                                <div class="order-type">
                                    <div class="my-1">
                                        <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio1" name="order_type" value="1" checked>
                                        <label for="customRadio1" class="custom-label">JRS </label><br>
                                    </div>
                                    <div class="my-1">
                                        <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio2" name="order_type" value="2">
                                        <label for="customRadio2" class="custom-label">Lalamove (Shipping fee care of buyer)</label><br>
                                    </div>
                                    <div class="my-1">
                                        <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio3" name="order_type" value="3">
                                        <label for="customRadio3" class="custom-label">Pick up (No shipping fee)</label><br>
                                    </div>
                                    <div class="my-1">
                                        <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio4" name="order_type" value="4">
                                        <label for="customRadio4" class="custom-label">Meet up (No shipping fee)</label><br>
                                    </div>
                                </div>
                                <div class="place-order form-group text-right">
                                    <?php if ((int)$total > (int)($all_order_config['value'] ?? 0)) : ?>
                                        <h1 id="warning-label" class="text-danger">Sorry! You've reached the order limit <?= isset($all_order_config) ? number_format($all_order_config['value']) : '' ?></h1>
                                    <?php else : ?>
                                        <button class="btn btn-flat btn-primary" type="submit" name="submit">
                                            Place Order
                                        </button>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="w-50 billing-address-container">
                                <div class="billing-address">
                                    <h1 class="label-info mt-2"><strong>Billing Address</strong></h1>
                                    <div class="dropdown-divider my-3"></div>
                                    <div class="custom-control custom-radio addresstype">
                                        <input class="custom-control-input" type="radio" id="default" name="address_type" value="1" checked>
                                        <label class="custom-control-label" for="default">Same as shipping address</label>
                                    </div>
                                    <div class="custom-control custom-radio addresstype">
                                        <input class="custom-control-input" type="radio" id="diff" name="address_type" value="2">
                                        <label class="custom-control-label" for="diff">Use a different billing address</label>
                                    </div>
                                    <!-- this will show bu default -->
                                    <div class="default-add">
                                        <div class="province jnt-holder">
                                            <span class="custom-control-input custom-control-input-primary">Province</span>
                                            <?php

                                            // Handle JSON data
                                            $provinces = json_decode($response1, true);
                                            $selectedProvinceId = $province;

                                            if ($provinces['data'] && is_array($provinces['data'])) {
                                                foreach ($provinces['data'] as $option) {
                                                    $optionId = $option['id'];
                                                    $optionName = $option['name'];

                                                    if ($optionId === $selectedProvinceId) {
                                                        $selectedValue = $optionName;
                                                        break;
                                                    }
                                                }
                                                echo '<input type="text" name="province" id="provinceInput" class="form-control mb-1" value="' . $selectedValue . '" required  readonly>';
                                            } else {
                                                echo 'Failed to fetch or decode data.';
                                            }


                                            echo '<span class="custom-control-input custom-control-input-primary">Cities</span>';
                                            // Handle JSON data
                                            $cities = json_decode($response2, true);
                                            $selectedCityId = $city;

                                            if ($cities['data'] && is_array($cities['data'])) {
                                                foreach ($cities['data'] as $option) {
                                                    $optionId = $option['id'];
                                                    $optionName = $option['name'];

                                                    if ($optionId === $selectedCityId) {
                                                        $selectedValue = $optionName;
                                                        break; // Break the loop when the selected value is found
                                                    }
                                                }
                                                // Display the input field with the selected value
                                                echo '<input type="text" name="city" id="cityInput" class="form-control mb-1" value="' . $selectedValue . '" required  readonly>';
                                            } else {
                                                echo 'Failed to fetch or decode data.';
                                            }

                                            ?>
                                            <span class="custom-control-input custom-control-input-primary">Address Line 1</span>
                                            <input name="addressline1" id="addressline1" rows="3" class="form-control mb-1 rounded-0" placeholder="Streeet, Blk, Lot, and brgy" value="<?= isset($addressline1) ? $addressline1 : "" ?>" required readonly></input>
                                            <span class="custom-control-input custom-control-input-primary">Address Line 2</span>
                                            <input name="addressline2" id="addressline2" rows="3" class="form-control mb-1 rounded-0" placeholder="(Apartment, suite, etc, (optional))" value="<?= isset($addressline2) ? $addressline2 : "" ?>" required readonly></input>
                                            <span class="custom-control-input custom-control-input-primary">Zip code</span>
                                            <input type="text" name="zipcode" id="zipcode" rows="3" class="form-control mb-1 zipcode" placeholder="Zip Code" value="<?= isset($zipcode) ? $zipcode : "N/A" ?>" onkeydown="return allowOnlyNumbers(event)" required readonly></input>

                                        </div>
                                    </div>

                                    <!-- this will show when user select "Use a different billing address" -->
                                    <div class="diff-add" style="display: none;">
                                        <div class="province jnt-holder">
                                            <span class="custom-control-input custom-control-input-primary">Province</span>

                                            <?php
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

<input name="different_addressline1" id="different_addressline1" rows="3" class="form-control rounded-0" placeholder="Address Line 1 (Different Address)" value="" ></input>
<input name="different_addressline2" id="different_addressline2" rows="3" class="form-control rounded-0" placeholder="Address Line 2 (Different Address)" value="" ></input>
<input type="text" name="different_zipcode" id="different_zipcode" rows="3" class="form-control zipcode" placeholder="Zip Code (Different Address)" value=""></input>

                                        </div>

                                    </div>
                                </div>
                                <!-- this will show when user select "Pick up" -->
                                <div class="pick-up-holder" style="display: none;">
                                    <h1 class="label-info mt-2"><strong>Pick-Up Address</strong></h1>
                                    <div class="dropdown-divider my-3"></div>
                                    <select name="pickup" id="puAddressDropdown" class="form-control mb-1">
                                        <option value="BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE">BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE</option>
                                        <option value="EVANGELISTA ST. COR ARGUELLES PETRON STATION MAKATI CITY">EVANGELISTA ST. COR ARGUELLES PETRON STATION MAKATI CITY</option>
                                    </select>
                                </div>

                                <!-- this will show when user select "Meet up" -->
                                <div class="meet-up-holder" style="display: none;">
                                    <h1 class="label-info mt-2"><strong>Meet Up Address</strong></h1>
                                    <div class="dropdown-divider my-3"></div>
                                    <select name="meetup" id="muAddressDropdown" class="form-control mb-1">
                                        <?php
                                        $getMeetupAddresses = $conn->query("SELECT * FROM `meet_up_address` where active = 1");
                                        while ($rowAdd = $getMeetupAddresses->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $rowAdd['text'] ?>" id="meetUpAddress-<?= $rowAdd['id'] ?>"><?= $rowAdd['text'] ?></option>
                                        <?php endwhile; ?>
                                        <option value="mu_other">OTHER</option>
                                    </select>
                                    <!-- this will show when user select "Meet up -> Others" -->
                                    <div class="other-meet-up">
                                        <input type="text" class="form-control mb-1" placeholder="Enter Meeting Point" name="othermu" />
                                    </div>
                                </div>
                                <div class="date_picker" style="display: none;">
                                    <div class="d-flex" id="date_picker">
                                        <input name="meetup_date" id="meetup_datepicker" class="date-time-input form-control mb-1" placeholder="Select a date">
                                        <input name="meetup_time" id="meetup_timepicker" disabled class="date-time-input form-control mb-1" placeholder="Select a time">
                                    </div>
                                    <button type="button" onclick="showAvailability()" class="btn btn-link text-decoration-none px-0 text-primary">Check Calendar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="calendar_modal" role='dialog'>
        <div class="modal-dialog modal-lg modal-dialog-end" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="calendar_div">
                        <?php
                        include_once('./calendar.php');
                        echo getCalendar();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function allowOnlyLetters(event) {
        // Check if the key pressed is a letter
        if (event.key.match(/[A-Za-z]/)) {
            return true; // Allow the key press
        } else {
            return false; // Prevent the key press
        }
    }

    function allowOnlyNumbers(event) {
        // Check if the key pressed is a number or the backspace key
        if (event.key.match(/[0-9]/) || event.keyCode === 8 /* Backspace */ ) {
            return true; // Allow the key press
        } else {
            return false; // Prevent the key press
        }

    }

    function showAvailability() {
        $('#calendar_modal').modal('show');
    }
    const unavailableDates = JSON.parse(JSON.stringify(<?= json_encode($unAvailableDays) ?>));
    var dates = unavailableDates.filter(item => item.duration < 1).flatMap(item => item.schedule);
    console.log(dates);
    $("#meetup_datepicker").datepicker({
        todayHighlight: true,
        minDate: 1,
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function(date) {
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [dates.indexOf(string) == -1];
        },
        onSelect: function(date) {
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=retrieve_availability",
                data: {
                    date
                },
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
                        const unavailableHours = [];
                        resp.data.forEach((item) => {
                            const amp = item[0].slice(item[0].length - 2, item[0].length);
                            const hoursInterval =
                                parseInt(item[0].slice(0, 2)) + 1 <= 9 ?
                                `0${parseInt(item[0].slice(0, 2)) + 1}:${item[0].slice(3, 5)} ${amp}` :
                                `${parseInt(item[0].slice(0, 2)) + 1}:${item[0].slice(3, 5)} ${amp}`;
                            item.push(hoursInterval);
                        });
                        const unavailableTimeFromDate = unavailableDates.filter(item => item.schedule === date);
                        console.log(unavailableTimeFromDate);
                        if (unavailableTimeFromDate.length > 0) {
                            unavailableTimeFromDate.forEach(item => {
                                resp.data.push([item.from_hours, item.to_hours]);
                            })
                        }
                        console.log(resp.data);
                        $("#meetup_timepicker").removeAttr('disabled')
                        $("#meetup_timepicker").timepicker({
                            minTime: '8am',
                            maxTime: '6pm',
                            timeFormat: 'h:i a',
                            step: 60,
                            dropdown: true,
                            scrollbar: true,
                            disableTimeRanges: resp.data
                        });
                    } else {
                        alert_toast("An error occured", 'error');
                        end_loader();
                        console.log(resp)
                    }

                }
            })
        }
    });
    $(function() {

        let addressTypeVal = 1;
        $('.pick-up-holder').hide('slow');
        $('.meet-up-holder').hide('slow');
        $('.date_picker').hide('slow');
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
                $('.date_picker').hide('slow');
                $('#date_picker > input').removeAttr('required');
                $('#totalWithSf').show('slow');
                $('#totalWithoutSf').hide('slow');
                $('#sf').show('slow');
                $('.billing-address').show('slow');
                $('#zipcode').prop('required', true);

            } else if ($(this).val() == 2) {
                $('.jnt-holder').hide('slow');
                $('.pick-up-holder').hide('slow');
                $('.meet-up-holder').hide('slow');
                $('.date_picker').hide('slow');
                $('#date_picker > input').removeAttr('required');
                $('#totalWithSf').hide('slow');
                $('#totalWithoutSf').show('slow');
                $('.billing-address').hide('slow');
                $('#sf').hide('slow');
                $('#zipcode').removeAttr('required');
            } else if ($(this).val() == 3) {
                $('.jnt-holder').hide('slow');
                $('.pick-up-holder').show('slow');
                $('.date_picker').show('slow');
                $('.date_picker > input').prop('required', true);
                $('#date_picker').children('input').prop('required', true);
                $('.meet-up-holder').hide('slow');
                $('.other-up-holder').hide('slow');
                $('#totalWithSf').hide('slow');
                $('#totalWithoutSf').show('slow');
                $('#sf').hide('slow');
                $('.billing-address').hide('slow');
                $('#zipcode').removeAttr('required');
            } else if ($(this).val() == 4) {
                $('.jnt-holder').hide('slow');
                $('.pick-up-holder').hide('slow');
                $('.meet-up-holder').show('slow');
                $('.date_picker').show('slow');
                $('#date_picker').children('input').prop('required', true);
                $('#totalWithSf').hide('slow');
                $('#totalWithoutSf').show('slow');
                $('#sf').hide('slow');
                $('.billing-address').hide('slow');
                $('#zipcode').removeAttr('required');
            } else {
                $('.jnt-holder').show('slow');
                $('.pick-up-holder').hide('slow');
                $('.meet-up-holder').hide('slow');
                $('.date_picker').hide('slow');
                $('#date_picker > input').removeAttr('required');
                $('#totalWithSf').hide('slow');
                $('#totalWithoutSf').show('slow');
                $('#sf').hide('slow');
                $('.billing-address').show('slow');
                $('#zipcode').removeAttr('required');
            }
        });

        $('[name="address_type"]').change(function() {
            if ($(this).val() == 1) {
                addressTypeVal = 1;
                $('.default-add').show('slow');
                $('.diff-add').hide('slow');
            } else {
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