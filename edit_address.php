<?php

require_once('./../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `client_list`  where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }
}
?>

<div>
<div class="container-fluid">
    <form action="" id="edit_address">
        
       
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
            echo '<small class="label">Select Province</small>';
            echo '<select name="city" id="cities" disabled>

                    <option>Select City</option>
                </select>';
            echo '</div>';
            echo '</div>';

            ?>

            </div>


         
    </form>
</div>
</div>

<script>

$(function(){
  
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
    
       
        

       
        $('#edit_address').submit(function(e){
            e.preventDefault()
            var _this = $(this)
            $('.err-msg').remove();
            var el = $('<div>')
            el.hide()
            
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