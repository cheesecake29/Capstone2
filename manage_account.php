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
            width: 50%;
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
    .input-form-contact
    {
        display: inline-block;
        border: 1px solid #B3B3B3 ;
        margin: 2% 3%;
        width:  50%;
        
        border-radius: 5px;
    }

  

 

    .input-form input,
    .input-form-fname input,
    .input-form-lname input,
    .input-form-email input,
    .input-form-contact input
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
    .input-form-contact small
    {
        display: block;
        font-size: 12px;
        color: gray;
        margin: 1% 3% ;

       
    }

   
.fname-lname-holder,
.contact-email-holder{
    display: flex;
    flex-direction: row;
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

                        <div class="fname-lname-holder">
                        <div class ="input-form-fname">
                               <small class="label">First Name:</small>
                                <input type="text" name="firstname" id="firstname" placeholder="Enter First Name" autofocus value="<?= isset($firstname) ? $firstname : "" ?>" required>
                                
                            </div>

                         

                            <div class ="input-form-lname">
                                <small class="label">Last Name:</small>
                                <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name" required value="<?= isset($lastname) ? $lastname : "" ?>">
                                
                            </div>

                            </div>

                            <div class="contact-email-holder">

                            <div class ="input-form-email">
                            <small class="label">Email:</small>
                                <input type="email" name="email" id="email" placeholder="arnoldtvmotoshop@gmail.com" required value="<?= isset($email) ? $email : "" ?>">
                               
                               
                            </div>

                            <div class ="input-form-contact">
                            <small class="label">Contact:</small>
                                
                                <input type="text" name="contact" id="contact" placeholder="Contact Number" value="<?= isset($contact) ? $contact : "" ?>" required>
                               
                            </div>
                            </div>



                           

                    <br>

                   <select   name="region" placeholder="Please select your region" class="option" id="region" onchange="populateProvinces()" required >

                   <option type="varchar">Select Region</option>  <option type="varchar" value="metro_manila" <?= (isset($region) && $region === 'metro_manila') ? 'selected' : '' ?>>Metro Manila</option>
                   <option type="varchar" value="luzon" <?= (isset($region) && $region === 'luzon') ? 'selected' : '' ?>>Luzon</option>
                   <option type="varchar" value="visayas" <?= (isset($region) && $region === 'visayas') ? 'selected' : '' ?>>Visayas</option>
                   <option type="varchar" value="mindanao" <?= (isset($region) && $region === 'mindanao') ? 'selected' : '' ?>>Mindanao</option>
                 
                  
                   

                   </select>

                   
                    <select  id="province" name="province" placeholder="Select Province"class="option" onchange="populateCities()" disabled required>
                   
              
                  <option type="varchar">Select Province</option>
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
                  
                    <select  class="option" name="city" id="city" onchange="populateBarangays()" disabled>
                        <option type="varchar" value="">Select a City</option>
                        <option type="varchar" value="Bangue" <?= (isset($city) && $city === 'Bangue') ? 'selected' : '' ?>>Bangue</option>
  
                    </select>

                    
                <select id="barangay" disabled>
                    <option value="">Select Barangay</option>
                </select>

                    


                  

                    
                    

                    <input name="addressline1" id="addressline1" rows="3" class="form-control form-control-sm rounded-0" placeholder="Address Line 1" value="<?= isset($addressline1) ? $addressline1 : "" ?>"></input required>
                    <input name="addressline2" id="addressline2" rows="3" class="form-control form-control-sm rounded-0" placeholder="Address Line 2 (Apartment, suite, etc, (optional))"value="<?= isset($addressline2) ? $addressline2 : "" ?>"></input optional>

                         <div class="zip">
                        <small >Zip Code</small>
                        <input type="varchar" name="zipcode" id="zipcode" placeholder="Zip Code" value="<?= isset($zipcode) ? $zipcode : "" ?>" required>

                    </div>

                    <div class="update-info">
                                <button  type="submit">SAVE CHANGES</button>
                            </div>

                  

                            </div>

                            <div class="right">
                        
                           

                        
                            <div class="input-form">
                            <small class="label">Current Password:</small>
                            <div class="password-container">
                                <input type="password" name="oldpassword" id="oldpassword" placeholder="">
                                <span class="password-toggle"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                            </div>
                        </div>
                        <div><small class="label-rem" color=red;><em>(Input your password before updating your datails)</em></small></div>                 

                                                
                                                    <div><small class="label-rem"><em>(Fill the password fields only if you want to update your password)</em></small></div>
                                                    <div class="input-form">
                                                    
                            <small class="label">New Password:</small>
                            <div class="password-container">
                                <input type="password" name="password" id="password" placeholder="">
                                <span class="password-toggle"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                            </div>
                        </div>





                           
                        <div class="input-form">
                            <small class="label">Confirm New Password:</small>
                            <div class="password-container">
                                <input type="password" id="cpassword" placeholder="">
                                <span class="password-toggle"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                            </div>
                        </div>

                        <div class="update-info">
                                <button  type="submit">SAVE CHANGES</button>
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


const provinces = {
    metro_manila: ["metro manila"],
luzon: [
    "abra", "aklan", "albay", "antique", "apayao", "aurora", "bataan", "batanes", "batangas", "benguet",
    "biliran", "bohol", "bulacan", "cagayan", "camarines norte", "camarines sur", "cavite", "isabela", "la union",
    "laguna", "marinduque", "masbate", "nueva ecija", "nueva vizcaya", "occidental mindoro", "oriental mindoro", "palawan",
    "pampanga", "pangasinan", "quezon", "quirino", "rizal", "romblon", "sorsogon", "tarlac", "zambales",
],
visayas: [
    "aklan", "antique", "biliran", "bohol", "capiz", "cebu", "guimaras", "iloilo", "leyte", "negros occidental",
    "negros oriental", "northern samar", "samar", "siquijor",
],
mindanao: [
    "agusan del norte", "agusan del sur", "basilan", "bukidnon", "cotabato", "davao del norte", "davao del sur", "davao occidental", "davao oriental",
    "dinagat islands", "compostela valley", "lanao del norte", "lanao del sur", "maguindanao", "misamis occidental", "misamis oriental",
    "sarangani", "south cotabato", "sultan kudarat", "sulu", "surigao del norte", "surigao del sur", "tawi-tawi", "zamboanga del norte",
    "zamboanga del sur", "zamboanga sibugay",
]

};

    

    const cities = {
        
        "abra": ["bangued", "boliney", "bucay", "bucloc", "daguioman", "danglas", "dolores", "la paz", "lacub", "lagangilang", "lagayan", "langiden", "licuan-baay", "luba", "malibcong", "manabo", "peñarrubia", "pidigan", "pilar", "sallapadan", "san isidro", "san juan", "san quintin", "tayum", "tineg", "tubo", "villaviciosa"],
  "agusan_del_norte": ["buenavista", "butuan city", "cabadbaran", "carmen", "jabonga", "kitcharao", "las nieves", "magallanes", "nasipit", "remedios t. romualdez", "santiago", "tubay"],
  "agusan_del_sur": ["bayugan", "bunawan", "esperanza", "la paz", "loreto", "prosperidad", "rosario", "san francisco", "san luis", "santa josefa", "sibagat", "talacogon", "trento", "veruela"],
  "aklan": ["altavas", "balete", "banga", "batan", "buruanga", "ibajay", "kalibo", "lezo", "libacao", "madalag", "makato", "malay", "malinao", "nabas", "new washington", "numancia", "tangalan"],
  "albay": ["bacacay", "camalig", "daraga", "guinobatan", "jovellar", "legazpi city", "libon", "ligao city", "malilipot", "malinao", "manito", "oas", "pio duran", "polangui", "rapu-rapu", "santo domingo", "tiwi"],
  "antique": ["anini-y", "barbaza", "belison", "bugasong", "caluya", "culasi", "hamtic", "laua-an", "libertad", "pandan", "patnongon", "san jose", "san remigio", "sebaste", "sibalom", "tibiao", "tobias fornier", "valderrama"],
  "apayao": ["calanasan", "conner", "flora", "kabugao", "luna", "pudtol", "santa marcela"],
  "aurora": ["baler", "casiguran", "dilasag", "dinalungan", "dingalan", "dipaculao", "maria aurora", "san luis"],
  "basilan": ["akbar", "al-barka", "hadarul", "isabela city", "lamitan", "lantawan", "maluso", "sumisip", "tabuan-lasa", "tipo-tipo", "tuburan", "ungkaya pukan"],
  "bataan": ["abucay", "bagac", "balanga city", "dinalupihan", "hermosa", "limay", "mariveles", "morong", "orani", "orion", "pilar", "samal"],
  "batanes": ["basco", "itbayat", "ivana", "mahatao", "sabtang", "uyugan"],
  "batangas": ["agoncillo", "alitagtag", "balayan", "balete", "bauan", "calaca", "calatagan", "cuenca", "ilaan", "laurel", "lemery", "lian", "lipa city", "lobo", "mabini", "malvar", "mataasnakahoy", "nasugbu", "padre garcia", "rosario", "san jose", "san juan", "san luis", "san nicolas", "san pascual", "santa teresita", "santo tomas", "taal", "talisay", "tanauan", "taysan", "tingloy", "tuy"],
  "benguet": ["atok", "baguio city", "bakun", "bokod", "buguias", "itogon", "kabayan", "kapangan", "kibungan", "la trinidad", "mankayan", "sablan", "tuba", "tublay"],
  "biliran": ["biliran", "cabucgayan", "caibiran", "culaba", "kawayan", "maripipi", "naval"],
"biliran": ["Almeria", "Biliran", "Cabucgayan", "Caibiran", "Culaba", "Kawayan", "Maripipi", "Naval"],
"bohol": ["alicia", "anda", "antequera", "baclayon", "balilihan", "batuan", "bien unido", "bilar", "buenavista", "calape", "candijay", "carmen", "catigbian", "clarin", "corella", "cortes", "dagohoy", "danao", "dauis", "dimiao", "duero", "garcia hernandez", "guindulman", "inabanga", "jagna", "lila", "loay", "loboc", "loon", "mabini", "maribojoc", "panglao", "pilar", "president carlos p. garcia", "sagbayan", "san isidro", "san miguel", "sevilla", "sierra bullones", "sikatuna", "tagbilaran city", "talibon", "trinidad", "tubigon", "ubay", "valencia"],
"bukidnon": ["baungon", "cabanglasan", "damulog", "dangcagan", "don carlos", "impasugong", "kadingilan", "kalilangan", "kibawe", "kitaotao", "lantapan", "libona", "malaybalay city", "malitbog", "manolo fortich", "maramag", "pangantucan", "quezon", "san fernando", "sumilao", "talakag", "valencia city"],
"bulacan": ["angat", "balagtas", "baliuag", "bocaue", "bulakan", "bustos", "calumpit", "dona remedios trinidad", "guiguinto", "hagonoy", "malolos city", "marilao", "meycauayan city", "norzagaray", "obando", "pandi", "paombong", "plaridel", "pulilan", "san ildefonso", "san jose del monte", "san miguel", "san rafael", "santa maria"],
"cagayan": ["abulug", "alcala", "allacapan", "amulung", "aparri", "baggao", "ballesteros", "buguey", "calayan", "camalaniugan", "claveria", "enrile", "gattaran", "gonzaga", "iguig", "lal-lo", "lasam", "pamplona", "peñablanca", "piat", "rizal", "sanchez-mira", "santa ana", "santa praxedes", "santa teresita", "santo niño", "solana", "tuao", "tuguegarao city"],
"cagayan_de_oro": ["alubijid", "balingasag", "balingoan", "binuangan", "cagayan de oro city", "claveria", "el salvador", "gingoog city", "gitagum", "initao", "jasaan", "kinoguitan", "laguindingan", "laguilayan", "libertad", "lugait", "magsaysay", "manticao", "medina", "naawan", "opol", "salay", "sugbongcogon", "tagoloan", "talisayan", "villanueva"],
"caloocan": ["caloocan city"],
"cavite": ["alfonso", "amadeo", "bacoor", "carmona", "cavite city", "dasmariñas", "general emilio aguinaldo", "general mariano alvarez", "general trias", "imus", "indang", "kawit", "magallanes", "maragondon", "mendez-nuñez", "naic", "noveleta", "rosario", "silang", "tagaytay", "tanza", "ternate"],
"cebu": ["alcantara", "alcoy", "alegria", "aloguinsan", "argao", "asturias", "badian", "balamban", "bantayan", "barili", "bogo city", "boljoon", "borbon", "carcar city", "carmen", "catmon", "cebu city", "compostela", "consolacion", "cordova", "daanbantayan", "dalaguete", "danao city", "dumanjug", "ginatilan", "lapu-lapu city", "liloan", "mactan", "madridejos", "malabuyoc", "mandaue city", "medellin", "minglanilla", "moalboal", "naga", "oslob", "pilar", "pinamungahan", "poro", "ronda", "samboan", "san fernando", "san francisco", "san remigio", "santa fe", "santander", "sibonga", "sogod", "tabogon", "tabuelan", "talisay city", "toledo city", "tuburan", "tudela"],
"city_of_isabela": ["balun", "lamitan city", "maluso", "sumisip", "tipo-tipo"],
"cotabato": ["alamada", "aleosan", "antipas", "arakan", "banisilan", "carmen", "kabacan", "kidapawan city", "libungan", "m'lang", "magpet", "makilala", "matalam", "midsayap", "pigcawayan", "pikit", "president roxas", "tulunan"],
"davao_del_norte": ["asuncion", "braulio e. dujali", "carmen", "island garden city of samal", "kapalong", "new corella", "panabo", "san isidro", "santo tomas", "tagum city", "talaingod"],
"davao_del_sur": ["bansalan", "davao city", "digos city", "hagonoy", "kiblawan", "magsaysay", "malalag", "matanao", "padada", "santa cruz", "santa maria", "sarangani", "sulop"],
"davao_occidental": ["don marcelino", "jose abad santos", "malita", "santa maria", "sarangani"],
"davao_oriental": ["baganga", "banaybanay", "boston", "caraga", "cateel", "governor generoso", "lupon", "manay", "mati city", "san isidro", "tarragona"],
"dinagat_islands": ["basilisa", "cagdianao", "dinagat", "libjo", "loreto", "san jose", "tubajon"],
"guimaras": ["buenavista", "jordan", "nueva valencia", "san lorenzo", "sibunag"],
"ifugao": ["aguinaldo", "alfonso lista", "asipulo", "banaue", "hingyon", "hungduan", "kiangan", "lagawe", "lamut", "mayoyao", "tinoc"],
"iloilo": ["ajuy", "alimodian", "anilao", "badiangan", "balasan", "balete", "banate", "barotac nuevo", "barotac viejo", "batad", "bingawan", "cabatuan", "calinog", "carles", "concepcion", "dingle", "dueñas", "dumangas", "estancia", "guimbal", "igbaras", "iloilo city", "janiuay", "lambunao", "leganes", "lemery", "leon", "maasin", "miagao", "mina", "new lucena", "oton", "passi city", "pavia", "pototan", "san dionisio", "san enrique", "san joaquin", "san miguel", "santa barbara", "sara", "tigbauan", "tubungan", "zarraga"],
"isabela": ["alicia", "angadanan", "aurora", "benito soliven", "burgos", "cabagan", "cabatuan", "cauayan city", "cordon", "delfin albano", "dinapigue", "divilacan", "echague", "gamu", "ilagan city", "jones", "luna", "maconacon", "mallig", "naguilian", "palanan", "quezon", "quirino", "ramon", "reina mercedes", "roxas", "san agustin", "san guillermo", "san isidro", "san manuel", "san mariano", "san mateo", "san pablo", "santa maria", "santiago city", "santo tomas", "tumauini"],
"kalinga": ["balbalan", "lubuagan", "pasil", "pinukpuk", "rizal", "tabuk city", "tanudan", "tinglayan"],
"la_union": ["agoo", "aringay", "bacnotan", "bagulin", "balaoan", "bangar", "bauang", "burgos", "caba", "luna", "naguilian", "pugo", "rosario", "san fernando city", "san gabriel", "san juan", "santo tomas", "santol", "sudipen", "tubao"],
"laguna": ["alaminos", "bay", "biñan city", "cabuyao city", "calamba city", "calauan", "cavinti", "famy", "kalayaan", "liliw", "los baños", "luisiana", "lumban", "mabitac", "magdalena", "nagcarlan", "pagsanjan", "pakil", "pangil", "pila", "rizal", "san pablo city", "san pedro city", "santa cruz", "santa maria", "santa rosa city", "siniloan", "victoria"],
"lanao_del_norte": ["bacolod", "baloi", "baroy", "kapatagan", "kauswagan", "kolambugan", "lala", "linamon", "magsaysay", "maigo", "matungao", "munai", "nunungan", "pantao ragat", "pantar", "poona piagapo", "salvador", "sapad", "sultan naga dimaporo", "tagoloan", "tangcal", "tubod"],
"lanao_del_sur": ["amai manabilang", "bacolod-kalawi", "balabagan", "balindong", "bayang", "binidayan", "buadiposo-buntong", "bubong", "butig", "calanogas", "ditsaan-ramain", "ganassi", "kapai", "kapatagan", "lumba-bayabao", "lumbaca-unayan", "lumbatan", "lumbayanague", "madalum", "madamba", "maguing", "malabang", "marantao", "marawi city", "marogong", "masiu", "mulondo", "pagayawan", "piagapo", "poona bayabao", "pualas", "saguiaran", "sultan dumalondong", "tagoloan ii", "tamparan", "taraka", "tubaran", "tugaya", "wao"],
"leyte": ["abuyog", "alangalang", "albuera", "babatngon", "barugo", "bato", "baybay city", "burauen", "calubian", "capoocan", "carigara", "dagami", "dulag", "hilongos", "hindang", "inopacan", "isabel", "jaro", "javier", "julita", "kananga", "la paz", "leyte", "macarthur", "mahaplag", "matag-ob", "matalom", "mayorga", "merida", "ormoc city", "palo", "palompon", "pastrana", "san isidro", "san miguel", "santa fe", "tabango", "tabontabon", "tacloban city", "tanauan", "tolosa", "tunga", "villaba"],
"maguindanao": ["ampatuan", "barira", "buldon", "buluan", "cotabato city", "datu abdullah sangki", "datu anggal midtimbang", "datu blah t. sinsuat", "datu hoffer ampatuan", "datu odin sinsuat", "datu paglas", "datu piang", "datu salibo", "datu saudi-ampatuan", "datu unsay", "general salipada k. pendatun", "guindulungan", "kabuntalan", "mamasapano", "mangudadatu", "matanog", "northern kabuntalan", "pagalungan", "paglat", "pandag", "parang", "rajah buayan", "shariff aguak", "shariff saydona mustapha", "south upi", "sultan kudarat", "sultan mastura", "sultan sa barongis", "sultan sumagka", "talayan", "talitay", "upi"],
    "marinduque": ["boac", "buenavista", "gasan", "mogpog", "santa cruz", "torrijos"],
    "masbate": ["aroroy", "baleno", "balud", "batuan", "cataingan", "cawayan", "claveria", "dimasalang", "esperanza", "mandaon", "masbate city", "milagros", "mobo", "monreal", "palanas", "pio v. corpuz", "placer", "san fernando", "san jacinto", "san pascual", "uson"],
    "metro_manila": ["caloocan", "las piñas", "makati", "malabon", "mandaluyong", "manila", "marikina", "muntinlupa", "navotas", "parañaque", "pasay", "pasig", "pateros", "quezon city", "san juan", "taguig", "valenzuela"],
    "misamis_occidental": ["aloran", "baliangao", "bonifacio", "calamba", "clarin", "concepcion", "don victoriano chiongbian", "jimenez", "lopez jaena", "oroquieta city", "ozamiz city", "panaon", "plaridel", "sapang dalaga", "sinacaban", "tangub city", "tudela"],
    "misamis_oriental": ["alubijid", "balingasag", "balingoan", "binuangan", "cagayan de oro city", "claveria", "el salvador city", "gitagum", "initao", "jasaan", "kinoguitan", "lagonglong", "laguindingan", "libertad", "magsaysay", "manticao", "medina", "naawan", "opol", "salay", "sugbongcogon", "tagoloan"],
    "mountain_province": ["barlig", "bauko", "besao", "bontoc", "natonin", "paracelis", "sabangan", "sadanga", "sagada", "sagada", "tadian"],
    "negros_occidental": ["bacolod city", "bago city", "binalbagan", "cadiz city", "calatrava", "candoni", "cauayan", "enrique b. magalona", "escalante city", "himamaylan city", "hinigaran", "hinoba-an", "ilog", "isabela", "kabankalan city", "la carlota city", "la castellana", "manapla", "moises padilla", "murcia", "pontevedra", "pulupandan", "sagay city", "salvador benedicto", "san carlos city", "san enrique", "silay city", "sipalay city", "talisay city", "toboso", "valladolid", "victorias city"],
    "negros_oriental": ["amlan", "ayungon", "bacong", "bais city", "basay", "bayawan city", "bindoy", "canlaon city", "dauin", "dumaguete city", "guihulngan city", "jimalalud", "la libertad", "mabinay", "manjuyod", "pamplona", "san jose", "santa catalina", "siaton", "sibulan", "tanjay city", "tayasan", "valencia", "vallehermoso", "zamboanguita"],
    "northern_samar": ["allen", "biri", "bobon", "capul", "catarman", "catubig", "gamay", "laoang", "lapinig", "las navas", "lavezares", "mapanas", "mondragon", "palapag", "pambujan", "rosario", "san antonio", "san isidro", "san jose", "san roque", "san vicente", "silvino lobos", "victoria"],
    "nueva_ecija": ["aliaga", "bongabon", "cabanatuan city", "cabiao", "carranglan", "cuyapo", "gabaldon", "general mamerto natividad", "general tinio", "guimba", "jaen", "laur", "licab", "llanera", "lupao", "nampicuan", "palayan city", "pantabangan", "penaranda", "quezon", "rizal", "san antonio", "san isidro", "san jose city", "san leonardo", "santa rosa", "santo domingo", "science city of muñoz", "talavera", "talugtug", "zaragoza"],
    "occidental_mindoro": ["abra de ilog", "calintaan", "looc", "lubang", "magsaysay", "mamburao", "paluan", "rizal", "sablayan", "san jose", "santa cruz"],
    "oriental_mindoro": ["baco", "bansud", "bongabong", "bulalacao", "gloria", "mansalay", "naujan", "pinamalayan", "pola", "puerto galera", "roxas", "san teodoro", "socorro", "victoria"],
    "palawan": ["aborlan", "agutaya", "araceli", "balabac", "bataraza", "brooke's point", "busuanga", "cagayancillo", "coron", "culion", "cuyo", "dumaran", "el nido", "kalayaan", "linapacan", "magsaysay", "narra", "puerto princesa", "quezon", "rizal", "roxas", "san vicente", "sofronio española"],
    "pampanga": ["angeles", "apalit", "arayat", "bacolor", "candaba", "floridablanca", "guagua", "lubao", "mabalacat", "macabebe", "magalang", "masantol", "mexico", "minalin", "porac", "san fernando", "san luis", "san simon", "santa ana", "santa rita", "santo tomas", "sasmuan"],
    "pangasinan": ["agno", "aguilar", "alcala", "anda", "asingan", "balungao", "bani", "basista", "bautista", "bayambang", "binalonan", "binmaley", "bolinao", "bugallon", "burgos", "calasiao", "dagupan", "dasol", "infanta", "labrador", "laoac", "lingayen", "mabini", "malasiqui", "manaoag", "mangaldan", "mangatarem", "mapandan", "natividad", "pozorrubio", "rosales", "san carlos", "san fabian", "san jacinto", "san manuel", "san nicolas", "san quintin", "santa barbara", "santa maria", "santo tomas", "sison", "sual", "tayug", "umingan", "urbiz"],
    "quezon": ["lucena", "tayabas", "candelaria", "sariaya", "catanauan"],
    "samar": ["calbayog", "catbalogan", "basey", "paranas", "san sebastian", "santa margarita", "santa rita", "santo nino", "tagapul-an", "almagro", "calbiga", "daram", "gandara", "hinabangan", "jiabong", "marabut", "matuguinao", "motiong", "pagsanghan", "san jorge", "san jose de buan", "talalora", "tarangnan", "villareal", "zumarraga"],
    "sarangani": ["alabel", "glan", "kiamba", "maitum"],
    "quirino": ["aglipay", "cabarroguis", "diffun", "maddela", "nagtipunan", "saguday"],
    "rizal": ["antipolo", "angono", "baras", "binangonan", "cainta", "cardona", "jalajala", "morong", "pililla", "rodriguez", "san mateo", "tanay", "taytay", "teresa"],
    "romblon": ["alcantara", "banton", "cajidiocan", "calatrava", "concepcion", "corcuera", "ferrol", "looc", "magdiwang", "odiongan", "romblon", "san agustin"],
    "sorsogon": ["bacon", "bulusan", "castilla", "casiguran", "donsol", "gubat", "irosin", "juban", "magallanes", "matnog", "pilar", "prieto diaz", "santa magdalena", "sorsogon city"],
    "south_cotabato": ["banga", "general santos city", "koronadal", "lake sebu", "norala", "polomolok", "santo niño", "surallah", "t'boli", "tampakan", "tantangan", "tupi"],
    "southern_leyte": ["anahawan", "bontoc", "hinunangan", "hinundayan", "libagon", "liloan", "limasawa", "maasin", "macrohon", "malitbog", "padre burgos", "pintuyan", "saint bernard", "san francisco", "san juan", "san ricardo", "silago", "sogod"],
    "sultan_kudarat": ["bagumbayan", "columbio", "esperanza", "isulan", "kalamansig", "lambayong", "lebak", "lutayan", "palimbang", "president quirino", "tacurong"],
    "sulu": ["hadji panglima tahil", "indanan", "jolo", "kalingalan caluang", "lugus", "luuk", "maimbung", "old panamao", "omar", "pandami", "panglima estino", "pangutaran", "parang", "pata", "patikul", "siasi", "talipao", "tapul", "tongkil"],
    "surigao_del_norte": ["alegria", "bacuag", "burgos", "claver", "dapa", "del carmen", "general luna", "gigaquit", "mainit", "malimono", "pilar", "placer", "san benito", "san francisco", "san isidro", "santa monica", "sison", "socorro", "surigao city", "tagana-an", "tubod"],
    "surigao_del_sur": ["barobo", "bayabas", "bislig", "cagwait", "cantilan", "carmen", "carrascal", "cortes", "hinatuan", "lanuza", "lianga", "lingig", "madrid", "marihatag", "san agustin", "san miguel", "tagbina", "tago"],
    "tarlac": ["anao", "bamban", "camiling", "capas", "concepcion", "gerona", "la paz", "mayantoc", "moncada", "paniqui", "pura", "ramos", "san clemente", "san jose", "san manuel", "santa ignacia", "tarlac city", "victoria"],
    "tawi_tawi": ["bongao", "languyan", "mapun", "panglima sugala", "sapa-sapa", "sibutu", "simunul", "sitangkai", "south ubian", "tandubas", "turtle islands"],
    "zambales": ["botolan", "cabangan", "candelaria", "castillejos", "iba", "masinloc", "olongapo", "palauig", "san antonio", "san felipe", "san marcelino", "san narciso", "santa cruz", "subic"],
    "zamboanga_del_norte": ["bacungan", "baliguian", "dapitan", "dipolog", "godod", "gutalac", "jose dalman", "kalawit", "katipunan", "la libertad", "labason", "leon b. postigo", "liloy", "manukan", "mutia", "piñan", "polanco", "pres. manuel a. roxas", "rizal", "salug", "sergio osmeña sr.", "siayan", "sibuco", "sibutad", "sindangan", "siocon", "sirawai", "tampilisan"],
    "zamboanga_del_sur": ["aurora", "bayog", "dimataling", "dinas", "dumalinao", "dumingag", "kumalarang", "labangan", "lakewood", "lapuyan", "mahayag", "margosatubig", "midsalip", "molave", "pagadian", "pitogo", "ramon magsaysay", "san miguel", "san pablo", "sominot", "tabina", "tambulig", "tigbao", "tukuran", "vincenzo a. sagun"],
    "zamboanga_sibugay": ["alicia", "buug", "diplahan", "imelda", "ipil", "kabasalan", "mabuhay", "malangas", "naga", "olutanga", "payao", "roseller lim", "siay", "talusan", "titay", "tungawan"],
    
   
        };

      

        function populateProvinces() {
      const regionSelect = document.getElementById("region");
      const provinceSelect = document.getElementById("province");
      const citySelect = document.getElementById("city");
      const barangaySelect = document.getElementById("barangay");

      const selectedRegion = regionSelect.value;

      // Clear the province, city, and barangay dropdowns
      provinceSelect.innerHTML = "<option value=''>Select Province</option>";
      citySelect.innerHTML = "<option value=''>Select Region First</option>";
      barangaySelect.innerHTML = "<option value=''>Select City First</option>";

      if (selectedRegion) {
        const regionProvinces = provinces[selectedRegion];
        for (const province of regionProvinces) {
          const option = document.createElement("option");
          option.value = province;
          option.text = province;
          provinceSelect.appendChild(option);
        }

        provinceSelect.disabled = false;
      } else {
        provinceSelect.disabled = true;
      }
    }

    function populateCities() {
      const provinceSelect = document.getElementById("province");
      const citySelect = document.getElementById("city");
      const barangaySelect = document.getElementById("barangay");

      const selectedProvince = provinceSelect.value;

      // Clear the city and barangay dropdowns
      citySelect.innerHTML = "<option value=''>Select Province First</option>";
      barangaySelect.innerHTML = "<option value=''>Select City First</option>";

      if (selectedProvince) {
        const provinceCities = cities[selectedProvince];
        for (const city of provinceCities) {
          const option = document.createElement("option");
          option.value = city;
          option.text = city;
          citySelect.appendChild(option);
        }

        citySelect.disabled = false;
      } else {
        citySelect.disabled = true;
      }
    }

    function populateBarangays() {
      const citySelect = document.getElementById("city");
      const barangaySelect = document.getElementById("barangay");

      const selectedCity = citySelect.value;

      // Clear the barangay dropdown
      barangaySelect.innerHTML = "<option value=''>Select City First</option>";

      if (selectedCity) {
        const cityBarangays = barangays[selectedCity];
        for (const barangay of cityBarangays) {
          const option = document.createElement("option");
          option.value = barangay;
          option.text = barangay;
          barangaySelect.appendChild(option);
        }

        barangaySelect.disabled = false;
      } else {
        barangaySelect.disabled = true;
      }
    }
       
 
    $(function(){
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
