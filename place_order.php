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
    width:  15%; 
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
                        <input class="input" type="number"name="phone_number" id="phone_number" rows="3" class="phone_number" placeholder="Phone"></input required>
               
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
                    <label for="customRadio1" class="custom-label">J&T </label><br>
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
                    <select  id="province" name="province" placeholder="Please select your province"class="option select2" required>
                  
                    
                    <option value="Select Province">Select Province</option>
                    <option type="varchar" value="abra" <?= (isset($province) && $province === 'abra') ? 'selected' : '' ?>>Abra</option>
    <option type="varchar" value="agusan_del_norte" <?= (isset($province) && $province === 'agusan_del_norte') ? 'selected' : '' ?>>Agusan del Norte</option>
    <option type="varchar" value="agusan_del_sur" <?= (isset($province) && $province === 'agusan_del_sur') ? 'selected' : '' ?>>Agusan del Sur</option>
    <option type="varchar" value="aklan" <?= (isset($province) && $province === 'aklan') ? 'selected' : '' ?>>Aklan</option>
    <option type="varchar" value="albay" <?= (isset($province) && $province === 'albay') ? 'selected' : '' ?>>Albay</option>
    <option type="varchar" value="antique" <?= (isset($province) && $province === 'antique') ? 'selected' : '' ?>>Antique</option>
    <option type="varchar" value="apayao" <?= (isset($province) && $province === 'apayao') ? 'selected' : '' ?>>Apayao</option>
    <option type="varchar" value="aurora" <?= (isset($province) && $province === 'aurora') ? 'selected' : '' ?>>Aurora</option>
    <option type="varchar" value="basilan" <?= (isset($province) && $province === 'basilan') ? 'selected' : '' ?>>Basilan</option>
    <option type="varchar" value="bataan" <?= (isset($province) && $province === 'bataan') ? 'selected' : '' ?>>Bataan</option>
    <option type="varchar" value="batanes" <?= (isset($province) && $province === 'batanes') ? 'selected' : '' ?>>Batanes</option>
    <option type="varchar" value="batangas" <?= (isset($province) && $province === 'batangas') ? 'selected' : '' ?>>Batangas</option>
    <option type="varchar" value="benguet" <?= (isset($province) && $province === 'benguet') ? 'selected' : '' ?>>Benguet</option>
    <option type="varchar" value="biliran" <?= (isset($province) && $province === 'biliran') ? 'selected' : '' ?>>Biliran</option>
    <option type="varchar" value="bohol" <?= (isset($province) && $province === 'bohol') ? 'selected' : '' ?>>Bohol</option>
    <option type="varchar" value="bukidnon" <?= (isset($province) && $province === 'bukidnon') ? 'selected' : '' ?>>Bukidnon</option>
    <option type="varchar" value="bulacan" <?= (isset($province) && $province === 'bulacan') ? 'selected' : '' ?>>Bulacan</option>
    <option type="varchar" value="cagayan" <?= (isset($province) && $province === 'cagayan') ? 'selected' : '' ?>>Cagayan</option>
    <option type="varchar" value="camarines_norte" <?= (isset($province) && $province === 'camarines_norte') ? 'selected' : '' ?>>Camarines Norte</option>
    <option type="varchar" value="camarines_sur" <?= (isset($province) && $province === 'camarines_sur') ? 'selected' : '' ?>>Camarines Sur</option>
    <option type="varchar" value="camiguin" <?= (isset($province) && $province === 'camiguin') ? 'selected' : '' ?>>Camiguin</option>
    <option type="varchar" value="capiz" <?= (isset($province) && $province === 'capiz') ? 'selected' : '' ?>>Capiz</option>
    <option type="varchar" value="catanduanes" <?= (isset($province) && $province === 'catanduanes') ? 'selected' : '' ?>>Catanduanes</option>
    <option type="varchar" value="cavite" <?= (isset($province) && $province === 'cavite') ? 'selected' : '' ?>>Cavite</option>
    <option type="varchar" value="cebu" <?= (isset($province) && $province === 'cebu') ? 'selected' : '' ?>>Cebu</option>
    <option type="varchar" value="compostela_valley" <?= (isset($province) && $province === 'compostela_valley') ? 'selected' : '' ?>>Compostela Valley</option>
    <option type="varchar" value="cotabato" <?= (isset($province) && $province === 'cotabato') ? 'selected' : '' ?>>Cotabato</option>
    <option type="varchar" value="davao_del_norte" <?= (isset($province) && $province === 'davao_del_norte') ? 'selected' : '' ?>>Davao del Norte</option>
    <option type="varchar" value="davao_del_sur" <?= (isset($province) && $province === 'davao_del_sur') ? 'selected' : '' ?>>Davao del Sur</option>
    <option type="varchar" value="davao_occidental" <?= (isset($province) && $province === 'davao_occidental') ? 'selected' : '' ?>>Davao Occidental</option>
    <option type="varchar" value="davao_oriental" <?= (isset($province) && $province === 'davao_oriental') ? 'selected' : '' ?>>Davao Oriental</option>
    <option type="varchar" value="dinagat_islands" <?= (isset($province) && $province === 'dinagat_islands') ? 'selected' : '' ?>>Dinagat Islands</option>
    <option type="varchar" value="eastern_samar" <?= (isset($province) && $province === 'eastern_samar') ? 'selected' : '' ?>>Eastern Samar</option>
    <option type="varchar" value="guimaras" <?= (isset($province) && $province === 'guimaras') ? 'selected' : '' ?>>Guimaras</option>
    <option type="varchar" value="ifugao" <?= (isset($province) && $province === 'ifugao') ? 'selected' : '' ?>>Ifugao</option>
    <option type="varchar" value="iloilo" <?= (isset($province) && $province === 'iloilo') ? 'selected' : '' ?>>Iloilo</option>
    <option type="varchar" value="isabela" <?= (isset($province) && $province === 'isabela') ? 'selected' : '' ?>>Isabela</option>
    <option type="varchar" value="kalinga" <?= (isset($province) && $province === 'kalinga') ? 'selected' : '' ?>>Kalinga</option>
    <option type="varchar" value="la_union" <?= (isset($province) && $province === 'la_union') ? 'selected' : '' ?>>La Union</option>
    <option type="varchar" value="laguna" <?= (isset($province) && $province === 'laguna') ? 'selected' : '' ?>>Laguna</option>
    <option type="varchar" value="lanao_del_norte" <?= (isset($province) && $province === 'lanao_del_norte') ? 'selected' : '' ?>>Lanao del Norte</option>
    <option type="varchar" value="lanao_del_sur" <?= (isset($province) && $province === 'lanao_del_sur') ? 'selected' : '' ?>>Lanao del Sur</option>
    <option type="varchar" value="leyte" <?= (isset($province) && $province === 'leyte') ? 'selected' : '' ?>>Leyte</option>
    <option type="varchar" value="maguindanao" <?= (isset($province) && $province === 'maguindanao') ? 'selected' : '' ?>>Maguindanao</option>
    <option type="varchar" value="marinduque" <?= (isset($province) && $province === 'marinduque') ? 'selected' : '' ?>>Marinduque</option>
    <option type="varchar" value="masbate" <?= (isset($province) && $province === 'masbate') ? 'selected' : '' ?>>Masbate</option>
    <option type="varchar" value="metro_manila" <?= (isset($province) && $province === 'metro_manila') ? 'selected' : '' ?>>Metro Manila</option>
    <option type="varchar" value="mindoro_occidental" <?= (isset($province) && $province === 'mindoro_occidental') ? 'selected' : '' ?>>Mindoro Occidental</option>
    <option type="varchar" value="mindoro_oriental" <?= (isset($province) && $province === 'mindoro_oriental') ? 'selected' : '' ?>>Mindoro Oriental</option>
    <option type="varchar" value="misamis_occidental" <?= (isset($province) && $province === 'misamis_occidental') ? 'selected' : '' ?>>Misamis Occidental</option>
    <option type="varchar" value="misamis_oriental" <?= (isset($province) && $province === 'misamis_oriental') ? 'selected' : '' ?>>Misamis Oriental</option>
    <option type="varchar" value="mountain_province" <?= (isset($province) && $province === 'mountain_province') ? 'selected' : '' ?>>Mountain Province</option>
    <option type="varchar" value="negros_occidental" <?= (isset($province) && $province === 'negros_occidental') ? 'selected' : '' ?>>Negros Occidental</option>
    <option type="varchar" value="negros_oriental" <?= (isset($province) && $province === 'negros_oriental') ? 'selected' : '' ?>>Negros Oriental</option>
    <option type="varchar" value="northern_samar" <?= (isset($province) && $province === 'northern_samar') ? 'selected' : '' ?>>Northern Samar</option>
    <option type="varchar" value="nueva_ecija" <?= (isset($province) && $province === 'nueva_ecija') ? 'selected' : '' ?>>Nueva Ecija</option>
    <option type="varchar" value="nueva_vizcaya" <?= (isset($province) && $province === 'nueva_vizcaya') ? 'selected' : '' ?>>Nueva Vizcaya</option>
    <option type="varchar" value="occidental_mindoro" <?= (isset($province) && $province === 'occidental_mindoro') ? 'selected' : '' ?>>Occidental Mindoro</option>
    <option type="varchar" value="oriental_mindoro" <?= (isset($province) && $province === 'oriental_mindoro') ? 'selected' : '' ?>>Oriental Mindoro</option>
    <option type="varchar" value="palawan" <?= (isset($province) && $province === 'palawan') ? 'selected' : '' ?>>Palawan</option>
    <option type="varchar" value="pampanga" <?= (isset($province) && $province === 'pampanga') ? 'selected' : '' ?>>Pampanga</option>
    <option type="varchar" value="pangasinan" <?= (isset($province) && $province === 'pangasinan') ? 'selected' : '' ?>>Pangasinan</option>
    <option type="varchar" value="quezon" <?= (isset($province) && $province === 'quezon') ? 'selected' : '' ?>>Quezon</option>
    <option type="varchar" value="quirino" <?= (isset($province) && $province === 'quirino') ? 'selected' : '' ?>>Quirino</option>
    <option type="varchar" value="rizal" <?= (isset($province) && $province === 'rizal') ? 'selected' : '' ?>>Rizal</option>
    <option type="varchar" value="romblon" <?= (isset($province) && $province === 'romblon') ? 'selected' : '' ?>>Romblon</option>
    <option type="varchar" value="samar" <?= (isset($province) && $province === 'samar') ? 'selected' : '' ?>>Samar</option>
    <option type="varchar" value="sarangani" <?= (isset($province) && $province === 'sarangani') ? 'selected' : '' ?>>Sarangani</option>
    <option type="varchar" value="siquijor" <?= (isset($province) && $province === 'siquijor') ? 'selected' : '' ?>>Siquijor</option>
    <option type="varchar" value="sorsogon" <?= (isset($province) && $province === 'sorsogon') ? 'selected' : '' ?>>Sorsogon</option>
    <option type="varchar" value="south_cotabato" <?= (isset($province) && $province === 'south_cotabato') ? 'selected' : '' ?>>South Cotabato</option>
    <option type="varchar" value="southern_leyte" <?= (isset($province) && $province === 'southern_leyte') ? 'selected' : '' ?>>Southern Leyte</option>
    <option type="varchar" value="sultan_kudarat" <?= (isset($province) && $province === 'sultan_kudarat') ? 'selected' : '' ?>>Sultan Kudarat</option>
    <option type="varchar" value="sulu" <?= (isset($province) && $province === 'sulu') ? 'selected' : '' ?>>Sulu</option>
    <option type="varchar" value="surigao_del_norte" <?= (isset($province) && $province === 'surigao_del_norte') ? 'selected' : '' ?>>Surigao del Norte</option>
    <option type="varchar" value="surigao_del_sur" <?= (isset($province) && $province === 'surigao_del_sur') ? 'selected' : '' ?>>Surigao del Sur</option>
    <option type="varchar" value="tarlac" <?= (isset($province) && $province === 'tarlac') ? 'selected' : '' ?>>Tarlac</option>
    <option type="varchar" value="tawi-tawi" <?= (isset($province) && $province === 'tawi-tawi') ? 'selected' : '' ?>>Tawi-Tawi</option>
    <option type="varchar" value="zambales" <?= (isset($province) && $province === 'zambales') ? 'selected' : '' ?>>Zambales</option>
    <option type="varchar" value="zamboanga_del_norte" <?= (isset($province) && $province === 'zamboanga_del_norte') ? 'selected' : '' ?>>Zamboanga del Norte</option>
    <option type="varchar" value="zamboanga_del_sur" <?= (isset($province) && $province === 'zamboanga_del_sur') ? 'selected' : '' ?>>Zamboanga del Sur</option>
    <option type="varchar" value="zamboanga_sibugay" <?= (isset($province) && $province === 'zamboanga_sibugay') ? 'selected' : '' ?>>Zamboanga Sibugay</option>
</select>
                   

                    <br>
                  
                    <select id="city" class="option">
                        <option  value="select">Select a City</option>
                    </select>

                   

                    <input name="addressline1" id="addressline1" rows="3" class="form-control form-control-sm rounded-0" placeholder="Address Line 1" value="<?= isset($addressline1) ? $addressline1 : "" ?>"></input required>
                    <input name="addressline2" id="addressline2" rows="3" class="form-control form-control-sm rounded-0" placeholder="Address Line 2 (Apartment, suite, etc, (optional))" value="<?= isset($addressline2) ? $addressline2: "" ?>"></input optional>


                       <div class="zip-city">
                       <div class="zip">
                       <input type="varchar"name="zipcode" id="zipcode" rows="3" class="zipcode" placeholder="Zip Code" value="<?= isset($zipcode) ? $zipcode: "" ?>"></input required>
                        </div>
                       
                       </div>

                       

                       </div>  <!--J&T-HOLDER-END-->

                     
                      

                   
                    
                   

                    
                    <div class="place-order form-group text-right">
                        <button class="btn btn-flat btn-primary">Place Order</button>
                    </div>

            </div>
          
            <div class="right">
                <div class="product-sum">
           <?php
            $total = 0;
                $cart = $conn->query("SELECT c.*,p.name, p.price, p.image_path,b.name as brand, cc.category FROM `cart_list` c inner join product_list p on c.product_id = p.id inner join brand_list b on p.brand_id = b.id inner join categories cc on p.category_id = cc.id where c.client_id = '{$_settings->userdata('id')}' order by p.name asc");
                while($row = $cart->fetch_assoc()):
                    $total += ($row['quantity'] * $row['price']);
      
                    ?> 
                    
                   
                        
                  
                    <a href="./?p=products/view_product&id=<?= $row['product_id'] ?>" class="sum-info">
                               
                                    <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-sum">
                                   
                                    
                                    <p class="name-sum"><?= $row['name'] ?></p>
                                   
                                    <p class="quantity-sum">Qty: <?= $row['quantity'] ?></p>
                                    
                                    <p class="price-sum"><?= $row['price'] ?></p>
                         </a>
                    <?php endwhile; ?>
                
              
               
               
                
            </div> 
            <h2 class="righth2">Total Price:  <?= number_format($total,2) ?></h2>

            </div> 
                </form>
            </div>
    
    </div>
</div>
<script>





               
const cityData = {
    abra: ["Bangued", "Boliney", "Bucay", "Bucloc", "Daguioman", "Danglas", "Dolores", "La Paz", "Lacub", "Lagangilang", "Lagayan", "Langiden", "Licuan-Baay", "Luba", "Malibcong", "Manabo", "Peñarrubia", "Pidigan", "Pilar", "Sallapadan", "San Isidro", "San Juan", "San Quintin", "Tayum", "Tineg", "Tubo", "Villaviciosa"],
    agusan_del_norte: ["Buenavista", "Butuan City", "Cabadbaran", "Carmen", "Jabonga", "Kitcharao", "Las Nieves", "Magallanes", "Nasipit", "Remedios T. Romualdez", "Santiago", "Tubay"],
    agusan_del_sur: ["Bayugan", "Bunawan", "Esperanza", "La Paz", "Loreto", "Prosperidad", "Rosario", "San Francisco", "San Luis", "Santa Josefa", "Sibagat", "Talacogon", "Trento", "Veruela"],
    aklan: ["Altavas", "Balete", "Banga", "Batan", "Buruanga", "Ibajay", "Kalibo", "Lezo", "Libacao", "Madalag", "Makato", "Malay", "Malinao", "Nabas", "New Washington", "Numancia", "Tangalan"],
    albay: ["Bacacay", "Camalig", "Daraga", "Guinobatan", "Jovellar", "Legazpi City", "Libon", "Ligao City", "Malilipot", "Malinao", "Manito", "Oas", "Pio Duran", "Polangui", "Rapu-Rapu", "Santo Domingo", "Tiwi"],
    antique: ["Anini-y", "Barbaza", "Belison", "Bugasong", "Caluya", "Culasi", "Hamtic", "Laua-an", "Libertad", "Pandan", "Patnongon", "San Jose", "San Remigio", "Sebaste", "Sibalom", "Tibiao", "Tobias Fornier", "Valderrama"],
    apayao: ["Calanasan", "Conner", "Flora", "Kabugao", "Luna", "Pudtol", "Santa Marcela"],
    aurora: ["Baler", "Casiguran", "Dilasag", "Dinalungan", "Dingalan", "Dipaculao", "Maria Aurora", "San Luis"],
    basilan: ["Akbar", "Al-Barka", "Hadarul", "Isabela City", "Lamitan", "Lantawan", "Maluso", "Sumisip", "Tabuan-Lasa", "Tipo-Tipo", "Tuburan", "Ungkaya Pukan"],
    bataan: ["Abucay", "Bagac", "Balanga City", "Dinalupihan", "Hermosa", "Limay", "Mariveles", "Morong", "Orani", "Orion", "Pilar", "Samal"],
    batanes: ["Basco", "Itbayat", "Ivana", "Mahatao", "Sabtang", "Uyugan"],
    batangas: ["Agoncillo", "Alitagtag", "Balayan", "Balete", "Bauan", "Calaca", "Calatagan", "Cuenca", "Ibaan", "Laurel", "Lemery", "Lian", "Lipa City", "Lobo", "Mabini", "Malvar", "Mataasnakahoy", "Nasugbu", "Padre Garcia", "Rosario", "San Jose", "San Juan", "San Luis", "San Nicolas", "San Pascual", "Santa Teresita", "Santo Tomas", "Taal", "Talisay", "Tanauan", "Taysan", "Tingloy", "Tuy"],
    benguet: ["Atok", "Baguio City", "Bakun", "Bokod", "Buguias", "Itogon", "Kabayan", "Kapangan", "Kibungan", "La Trinidad", "Mankayan", "Sablan", "Tuba", "Tublay"],
    biliran: ["Almeria", "Biliran", "Cabucgayan", "Caibiran", "Culaba", "Kawayan", "Maripipi", "Naval"],
    bohol: ["Alicia", "Anda", "Antequera", "Baclayon", "Balilihan", "Batuan", "Bien Unido", "Bilar", "Buenavista", "Calape", "Candijay", "Carmen", "Catigbian", "Clarin", "Corella", "Cortes", "Dagohoy", "Danao", "Dauis", "Dimiao", "Duero", "Garcia Hernandez", "Getafe", "Guindulman", "Inabanga", "Jagna", "Lila", "Loay", "Loboc", "Loon", "Mabini", "Maribojoc", "Panglao", "Pilar", "President Carlos P. Garcia", "Sagbayan", "San Isidro", "San Miguel", "Sevilla", "Sierra Bullones", "Sikatuna", "Tagbilaran City", "Talibon", "Trinidad", "Tubigon", "Ubay", "Valencia"],
    bukidnon: ["Baungon", "Cabanglasan", "Damulog", "Dangcagan", "Don Carlos", "Impasugong", "Kadingilan", "Kalilangan", "Kibawe", "Kitaotao", "Lantapan", "Libona", "Malaybalay City", "Malitbog", "Manolo Fortich", "Maramag", "Pangantucan", "Quezon", "San Fernando", "Sumilao", "Talakag", "Valencia City"],
    bulacan: ["Angat", "Balagtas", "Baliuag", "Bocaue", "Bulakan", "Bustos", "Calumpit", "Doña Remedios Trinidad", "Guiguinto", "Hagonoy", "Malolos City", "Marilao", "Meycauayan City", "Norzagaray", "Obando", "Pandi", "Paombong", "Plaridel", "Pulilan", "San Ildefonso", "San Jose del Monte City", "San Miguel", "San Rafael", "Santa Maria"],
    cagayan: ["Abulug", "Alcala", "Allacapan", "Amulung", "Aparri", "Baggao", "Ballesteros", "Buguey", "Calayan", "Camalaniugan", "Claveria", "Enrile", "Gattaran", "Gonzaga", "Iguig", "Lal-lo", "Lasam", "Pamplona", "Peñablanca", "Piat", "Rizal", "Sanchez-Mira", "Santa Ana", "Santa Praxedes", "Santa Teresita", "Santo Niño", "Solana", "Tuao", "Tuguegarao City"],
    camarines_norte: ["Basud", "Capalonga", "Daet", "Jose Panganiban", "Labo", "Mercedes", "Paracale", "San Lorenzo Ruiz", "San Vicente", "Santa Elena", "Talisay", "Vinzons"],
    camarines_sur: ["Baao", "Balatan", "Bato", "Bombon", "Buhi", "Bula", "Cabusao", "Calabanga", "Camaligan", "Canaman", "Caramoan", "Del Gallego", "Gainza", "Garchitorena", "Goa", "Iriga City", "Lagonoy", "Libmanan", "Lupi", "Magarao", "Milaor", "Minalabac", "Nabua", "Naga City", "Ocampo", "Pamplona", "Pasacao", "Pili", "Presentacion", "Ragay", "Sagñay", "San Fernando", "San Jose", "Sipocot", "Siruma", "Tigaon", "Tinambac"],
    camiguin: ["Catarman", "Guinsiliban", "Mahinog", "Mambajao"],
    capiz: ["Cuartero", "Dao", "Dumalag", "Dumarao", "Ivisan", "Jamindan", "Ma-ayon", "Mambusao", "Panay", "Panitan", "Pilar", "Pontevedra", "President Roxas", "Roxas City", "Sapian", "Sigma", "Tapaz"],
    catanduanes: ["Bagamanoc", "Baras", "Bato", "Caramoran", "Gigmoto", "Pandan", "Panganiban", "San Andres", "San Miguel", "Viga", "Virac"],
    cavite: ["Alfonso", "Amadeo", "Bacoor", "Carmona", "Cavite City", "Dasmariñas", "General Emilio Aguinaldo", "General Mariano Alvarez", "General Trias", "Imus", "Indang", "Kawit", "Magallanes", "Maragondon", "Mendez", "Naic", "Noveleta", "Rosario", "Silang", "Tagaytay City", "Tanza", "Ternate", "Trece Martires City"],
    cebu: ["Cebu City", "Mandaue", "Lapu-Lapu"],
    compostela_valley: ["Compostela", "Laak", "Mabini", "Maco", "Maragusan", "Mawab", "Monkayo", "Montevista", "Nabunturan", "New Bataan", "Pantukan"],
    cotabato: ["Alamada", "Aleosan", "Antipas", "Arakan", "Banisilan", "Carmen", "Kabacan", "Kidapawan City", "Libungan", "M'lang", "Magpet", "Makilala", "Matalam", "Midsayap", "Pigkawayan", "Pikit", "President Roxas", "Tulunan"],
    davao_del_norte: ["Asuncion", "Braulio E. Dujali", "Carmen", "Kapalong", "New Corella", "Panabo City", "Samal", "San Isidro", "Santo Tomas", "Tagum City", "Talaingod"],
    davao_del_sur: ["Bansalan", "Davao City", "Digos City", "Hagonoy", "Kiblawan", "Magsaysay", "Malalag", "Matanao", "Padada", "Santa Cruz", "Sulop"],
    davao_occidental: ["Don Marcelino", "Jose Abad Santos", "Malita", "Santa Maria", "Sarangani"],
    davao_oriental: ["Baganga", "Banaybanay", "Boston", "Caraga", "Cateel", "Governor Generoso", "Lupon", "Manay", "Mati City", "San Isidro", "Tarragona"],
    dinagat_islands: ["Basilisa", "Cagdianao", "Dinagat", "Loreto", "San Jose"],
    eastern_samar: ["Arteche", "Balangiga", "Balangkayan", "Borongan", "Can-avid", "Dolores", "General MacArthur", "Giporlos", "Guiuan", "Hernani", "Jipapad", "Lawaan", "Llorente", "Maslog", "Maydolong", "Mercedes", "Oras", "Quinapondan", "Salcedo", "San Julian", "San Policarpo", "Sulat", "Taft"],
    guimaras: ["Buenavista", "Jordan", "Nueva Valencia", "San Lorenzo", "Sibunag"],
    ifugao: ["Aguinaldo", "Alfonso Lista", "Asipulo", "Banaue", "Hingyon", "Hungduan", "Kiangan", "Lagawe", "Lamut", "Mayoyao", "Tinoc"],
    iloilo: ["Ajuy", "Alimodian", "Anilao", "Badiangan", "Balasan", "Banate", "Barotac Nuevo", "Barotac Viejo", "Batad", "Bingawan", "Cabatuan", "Calinog", "Carles", "Concepcion", "Dingle", "Duenas", "Dumangas", "Estancia", "Guimbal", "Igbaras", "Iloilo City", "Janiuay", "Lambunao", "Leganes", "Lemery", "Leon", "Maasin", "Miagao", "Mina", "New Lucena", "Oton", "Passi City", "Pavia", "Pototan", "San Dionisio", "San Enrique", "San Joaquin", "San Miguel"],
    isabela: ["Alicia", "Angadanan", "Aurora", "Benito Soliven", "Burgos", "Cabagan", "Cabatuan", "Cauayan", "Cordon", "Delfin Albano", "Dinapigue", "Divilacan", "Echague", "Gamu", "Ilagan", "Jones", "Luna", "Maconacon", "Mallig", "Naguilian", "Palanan", "Quezon", "Quirino", "Roxas", "San Agustin", "San Guillermo", "San Isidro", "San Manuel", "San Mariano", "San Mateo", "San Pablo", "Santa Maria", "Santiago", "Santo Tomas", "Tumauini"],
    kalinga: ["Balbalan", "Lubuagan", "Pasil", "Pinukpuk", "Rizal", "Tabuk City", "Tanudan", "Tinglayan"],
    la_union: ["Agoo", "Aringay", "Bacnotan", "Bagulin", "Balaoan", "Bangar", "Bauang", "Burgos", "Caba", "Luna", "Naguilian", "Pugo", "Rosario", "San Fernando", "San Gabriel", "San Juan", "Santo Tomas", "Santol", "Sudipen", "Tubao"],
    laguna: ["Alaminos", "Bay", "Biñan", "Cabuyao", "Calamba", "Calauan", "Cavinti", "Famy", "Kalayaan", "Liliw", "Los Baños", "Luisiana", "Lumban", "Mabitac", "Magdalena", "Nagcarlan", "Paete", "Pagsanjan", "Pakil", "Pangil", "Pila", "Rizal", "San Pablo", "San Pedro", "Santa Cruz", "Santa Maria", "Santa Rosa", "Siniloan", "Victoria"],
    lanao_del_norte: ["Bacolod", "Baloi", "Baroy", "Kapatagan", "Kauswagan", "Kolambugan", "Lala", "Linamon", "Magsaysay", "Maigo", "Matungao", "Munai", "Nunungan", "Pantao Ragat", "Pantar", "Poona Piagapo", "Salvador", "Sapad", "Sultan Naga Dimaporo", "Tagoloan", "Tangcal", "Tubod"],
    lanao_del_sur: ["Bacolod-Kalawi", "Balabagan", "Balindong", "Bayang", "Binidayan", "Buadiposo-Buntong", "Bubong", "Butig", "Calanogas", "Ditsaan-Ramain", "Ganassi", "Kapai", "Kapatagan", "Lumba-Bayabao", "Lumbaca-Unayan", "Lumbatan", "Lumbayanague", "Madalum", "Madamba", "Maguing", "Malabang", "Marantao", "Marawi", "Marogong", "Masiu", "Mulondo", "Pagayawan", "Piagapo", "Poona Bayabao", "Pualas", "Saguiaran", "Sultan Dumalondong", "Picong", "Tagoloan II", "Tamparan", "Taraka", "Tubaran", "Tugaya", "Wao"],
    leyte: ["Abuyog", "Alangalang", "Albuera", "Babatngon", "Barugo", "Bato", "Baybay", "Burauen", "Calubian", "Capoocan", "Carigara", "Dagami", "Dulag", "Hilongos", "Hindang", "Inopacan", "Isabel", "Jaro", "Javier", "Julita", "Kananga", "La Paz", "Leyte", "MacArthur", "Mahaplag", "Matag-ob", "Matalom", "Mayorga", "Merida", "Ormoc", "Palo", "Palompon", "Pastrana", "San Isidro", "San Miguel", "Santa Fe", "Tabango", "Tabontabon", "Tacloban", "Tanauan", "Tolosa", "Tunga"],
    maguindanao: ["Ampatuan", "Barira", "Buldon", "Datu Abdullah Sangki", "Datu Anggal Midtimbang", "Datu Blah T. Sinsuat", "Datu Hoffer Ampatuan", "Datu Odin Sinsuat", "Datu Paglas", "Datu Piang", "Datu Salibo", "Datu Saudi-Ampatuan", "Datu Unsay", "General Salipada K. Pendatun", "Guindulungan", "Kabuntalan", "Mamasapano", "Mangudadatu", "Matanog", "Northern Kabuntalan", "Pagalungan", "Paglat", "Pandag", "Parang", "Rajah Buayan", "Shariff Aguak", "Shariff Saydona Mustapha", "South Upi", "Sultan Kudarat", "Sultan Mastura", "Sultan sa Barongis", "Sultan Sumagka", "Talayan", "Talitay", "Upi"],
    marinduque: ["Boac", "Buenavista", "Gasan", "Mogpog", "Santa Cruz", "Torrijos"],
    masbate: ["Aroroy", "Baleno", "Balud", "Batuan", "Cataingan", "Cawayan", "Claveria", "Dimasalang", "Esperanza", "Mandaon", "Masbate City", "Milagros", "Mobo", "Monreal", "Palanas", "Pio V. Corpuz", "Placer", "San Fernando", "San Jacinto", "San Pascual", "Uson"],
    mindoro_occidental: ["Abra de Ilog", "Calintaan", "Looc", "Lubang", "Magsaysay", "Mamburao", "Paluan", "Rizal", "Sablayan", "San Jose", "Santa Cruz"],
    mindoro_oriental: ["Baco", "Bansud", "Bongabong", "Bulalacao", "Gloria", "Mansalay", "Naujan", "Pinamalayan", "Pola", "Puerto Galera", "Roxas", "San Teodoro", "Socorro", "Victoria"],
    misamis_occidental: ["Aloran", "Baliangao", "Bonifacio", "Calamba", "Clarin", "Concepcion", "Jimenez", "Lopez Jaena", "Oroquieta", "Ozamiz", "Panaon", "Plaridel", "Sapang Dalaga", "Sinacaban", "Tangub", "Tudela"],
    misamis_oriental: ["Alubijid", "Balingasag", "Balingoan", "Binuangan", "Cagayan de Oro", "Claveria", "El Salvador", "Gingoog", "Gitagum", "Initao", "Jasaan", "Kinoguitan", "Lagonglong", "Laguindingan", "Libertad", "Lugait", "Magsaysay", "Manticao", "Medina", "Naawan", "Opol", "Salay", "Sugbongcogon", "Tagoloan"],
    mountain_province: ["Barlig", "Bauko", "Besao", "Bontoc", "Natonin", "Paracelis", "Sabangan", "Sadanga", "Sagada", "Saguday", "Tadian"],
    negros_occidental: ["Bacolod", "Bago", "Binalbagan", "Cadiz", "Calatrava", "Candoni", "Cauayan", "Enrique B. Magalona", "Escalante", "Himamaylan", "Hinigaran", "Hinoba-an", "Ilog", "Isabela", "Kabankalan", "La Carlota", "La Castellana", "Manapla", "Moises Padilla", "Murcia", "Pontevedra", "Pulupandan", "Sagay", "Salvador Benedicto", "San Carlos", "San Enrique", "Silay", "Sipalay", "Talisay", "Toboso", "Valladolid"],
    negros_oriental: ["Amlan", "Ayungon", "Bacong", "Bais", "Basay", "Bayawan", "Bindoy", "Canlaon", "Dauin", "Dumaguete", "Guihulngan", "Jimalalud", "La Libertad", "Mabinay", "Manjuyod", "Pamplona", "San Jose", "Santa Catalina", "Siaton", "Sibulan", "Tanjay", "Tayasan", "Valencia", "Vallehermoso", "Zamboanguita"],
    northern_samar: ["Allen", "Biri", "Bobon", "Capul", "Catarman", "Catubig", "Gamay", "Laoang", "Lapinig", "Las Navas", "Lavezares", "Lope de Vega", "Mapanas", "Mondragon", "Palapag", "Pambujan", "Rosales", "San Antonio", "San Isidro", "San Jose", "San Roque", "San Vicente", "Silvino Lobos", "Victoria"],
    nueva_ecija: ["Aliaga", "Bongabon", "Cabiao", "Cabanatuan", "Cabiao", "Carranglan", "Cuyapo", "Gabaldon", "Gapan", "General Mamerto Natividad", "General Tinio", "Guimba", "Jaen", "Laur", "Licab", "Llanera", "Lupao", "Nampicuan", "Palayan", "Pantabangan", "Peñaranda", "Quezon", "Rizal", "San Antonio", "San Isidro", "San Jose City", "San Leonardo", "Santa Rosa", "Santo Domingo", "Talavera", "Talugtug", "Zaragoza"],
    nueva_vizcaya: ["Alfonso Castaneda", "Ambaguio", "Aritao", "Bagabag", "Bambang", "Bayombong", "Diadi", "Dupax del Norte", "Dupax del Sur", "Kasibu", "Kayapa", "Quezon", "Santa Fe", "Solano", "Villaverde"],
    occidental_mindoro: ["Abra de Ilog", "Calintaan", "Looc", "Lubang", "Magsaysay", "Mamburao", "Paluan", "Rizal", "Sablayan", "San Jose", "Santa Cruz"],
    oriental_mindoro: ["Baco", "Bansud", "Bongabong", "Bulalacao", "Gloria", "Mansalay", "Naujan", "Pinamalayan", "Pola", "Puerto Galera", "Roxas", "San Teodoro", "Socorro", "Victoria"],
    palawan: ["Aborlan", "Agutaya", "Araceli", "Balabac", "Bataraza", "Brooke's Point", "Busuanga", "Cagayancillo", "Coron", "Culion", "Cuyo", "Dumaran", "El Nido", "Kalayaan", "Linapacan", "Magsaysay", "Narra", "Puerto Princesa", "Quezon", "Rizal", "Roxas", "San Vicente", "Sofronio Española"],
    pampanga: ["Angeles", "Apalit", "Arayat", "Bacolor", "Candaba", "Floridablanca", "Guagua", "Lubao", "Mabalacat", "Macabebe", "Magalang", "Masantol", "Mexico", "Minalin", "Porac", "San Fernando", "San Luis", "San Simon", "Santa Ana", "Santa Rita", "Santo Tomas", "Sasmuan"],
    pangasinan: ["Agno", "Aguilar", "Alcala", "Anda", "Asingan", "Balungao", "Bani", "Basista", "Bautista", "Bayambang", "Binalonan", "Binmaley", "Bolinao", "Bugallon", "Burgos", "Calasiao", "Dagupan", "Dasol", "Infanta", "Labrador", "Laoac", "Lingayen", "Mabini", "Malasiqui", "Manaoag", "Mangaldan", "Mangatarem", "Mapandan", "Natividad", "Pozorrubio", "Rosales", "San Carlos", "San Fabian", "San Jacinto", "San Manuel", "San Nicolas", "San Quintin", "Santa Barbara", "Santa Maria", "Santo Tomas", "Sison", "Sual", "Tayug", "Umingan", "Urbiz"],
    quezon: ["Lucena", "Tayabas", "Candelaria", "Sariaya", "Catanauan"],
    samar: ["Calbayog", "Catbalogan", "Basey", "Paranas", "San Sebastian", "Santa Margarita", "Santa Rita", "Santo Nino", "Tagapul-an", "Almagro", "Calbiga", "Daram", "Gandara", "Hinabangan", "Jiabong", "Marabut", "Matuguinao", "Motiong", "Pagsanghan", "San Jorge", "San Jose de Buan", "Talalora", "Tarangnan", "Villareal", "Zumarraga"],
    sarangani: ["Alabel", "Glan", "Kiamba", "Maitum"],
    quirino: ["Aglipay", "Cabarroguis", "Diffun", "Maddela", "Nagtipunan", "Saguday"],
    rizal: ["Antipolo", "Angono", "Baras", "Binangonan", "Cainta", "Cardona", "Jalajala", "Morong", "Pililla", "Rodriguez", "San Mateo", "Tanay", "Taytay", "Teresa"],
    romblon: ["Alcantara", "Banton", "Cajidiocan", "Calatrava", "Concepcion", "Corcuera", "Ferrol", "Looc", "Magdiwang", "Odiongan", "Romblon", "San Agustin"],
    sorsogon: ["Bacon", "Bulusan", "Castilla", "Casiguran", "Donsol", "Gubat", "Irosin", "Juban", "Magallanes", "Matnog", "Pilar", "Prieto Diaz", "Santa Magdalena", "Sorsogon City"],
    south_cotabato: ["Banga", "General Santos City", "Koronadal", "Lake Sebu", "Norala", "Polomolok", "Santo Niño", "Surallah", "T'boli", "Tampakan", "Tantangan", "Tupi"],
    southern_leyte: ["Anahawan", "Bontoc", "Hinunangan", "Hinundayan", "Libagon", "Liloan", "Limasawa", "Maasin", "Macrohon", "Malitbog", "Padre Burgos", "Pintuyan", "Saint Bernard", "San Francisco", "San Juan", "San Ricardo", "Silago", "Sogod"],
    sultan_kudarat: ["Bagumbayan", "Columbio", "Esperanza", "Isulan", "Kalamansig", "Lambayong", "Lebak", "Lutayan", "Palimbang", "President Quirino", "Tacurong"],
    sulu: ["Hadji Panglima Tahil", "Indanan", "Jolo", "Kalingalan Caluang", "Lugus", "Luuk", "Maimbung", "Old Panamao", "Omar", "Pandami", "Panglima Estino", "Pangutaran", "Parang", "Pata", "Patikul", "Siasi", "Talipao", "Tapul", "Tongkil"],
    surigao_del_norte: ["Alegria", "Bacuag", "Burgos", "Claver", "Dapa", "Del Carmen", "General Luna", "Gigaquit", "Mainit", "Malimono", "Pilar", "Placer", "San Benito", "San Francisco", "San Isidro", "Santa Monica", "Sison", "Socorro", "Surigao City", "Tagana-an", "Tubod"],
    surigao_del_sur: ["Barobo", "Bayabas", "Bislig", "Cagwait", "Cantilan", "Carmen", "Carrascal", "Cortes", "Hinatuan", "Lanuza", "Lianga", "Lingig", "Madrid", "Marihatag", "San Agustin", "San Miguel", "Tagbina", "Tago"],
    tarlac: ["Anao", "Bamban", "Camiling", "Capas", "Concepcion", "Gerona", "La Paz", "Mayantoc", "Moncada", "Paniqui", "Pura", "Ramos", "San Clemente", "San Jose", "San Manuel", "Santa Ignacia", "Tarlac City", "Victoria"],
    tawi_tawi: ["Bongao", "Languyan", "Mapun", "Panglima Sugala", "Sapa-Sapa", "Sibutu", "Simunul", "Sitangkai", "South Ubian", "Tandubas", "Turtle Islands"],
    zambales: ["Botolan", "Cabangan", "Candelaria", "Castillejos", "Iba", "Masinloc", "Olongapo", "Palauig", "San Antonio", "San Felipe", "San Marcelino", "San Narciso", "Santa Cruz", "Subic"],
    zamboanga_del_norte: ["Bacungan", "Baliguian", "Dapitan", "Dipolog", "Godod", "Gutalac", "Jose Dalman", "Kalawit", "Katipunan", "La Libertad", "Labason", "Leon B. Postigo", "Liloy", "Manukan", "Mutia", "Piñan", "Polanco", "Pres. Manuel A. Roxas", "Rizal", "Salug", "Sergio Osmeña Sr.", "Siayan", "Sibuco", "Sibutad", "Sindangan", "Siocon", "Sirawai", "Tampilisan"],
    zamboanga_del_sur: ["Aurora", "Bayog", "Dimataling", "Dinas", "Dumalinao", "Dumingag", "Kumalarang", "Labangan", "Lakewood", "Lapuyan", "Mahayag", "Margosatubig", "Midsalip", "Molave", "Pagadian", "Pitogo", "Ramon Magsaysay", "San Miguel", "San Pablo", "Sominot", "Tabina", "Tambulig", "Tigbao", "Tukuran", "Vincenzo A. Sagun"],
    zamboanga_sibugay: ["Alicia", "Buug", "Diplahan", "Imelda", "Ipil", "Kabasalan", "Mabuhay", "Malangas", "Naga", "Olutanga", "Payao", "Roseller Lim", "Siay", "Talusan", "Titay", "Tungawan"],
    metro_manila: ["Caloocan", "Las Piñas", "Makati", "Malabon", "Mandaluyong", "Manila", "Marikina", "Muntinlupa", "Navotas", "Parañaque", "Pasay", "Pasig", "Pateros", "Quezon City", "San Juan", "Taguig", "Valenzuela"]
   
        };

        const provinceDropdown = document.getElementById("province");
        const cityDropdown = document.getElementById("city");

        provinceDropdown.addEventListener("change", function() {
            const selectedProvince = this.value;
            cityDropdown.length = 1; 
            cityDropdown.disabled = selectedProvince === "select"; 

            if (selectedProvince !== "select") {
                const cities = cityData[selectedProvince];
                for (let i = 0; i < cities.length; i++) {
                    const option = document.createElement("option");
                    option.value = cities[i];
                    option.text = cities[i];
                    cityDropdown.add(option);
                }
            }
        });

    
        $(function(){
        $('[name="order_type"]').change(function(){
       if($(this).val() ==2 || $(this).val() ==3 || $(this).val() ==4){
            $('.jnt-holder').hide('slow')
       }else{
            $('.jnt-holder').show('slow')
        }
    })

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