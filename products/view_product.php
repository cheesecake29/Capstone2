<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT p.*, b.name as brand, c.category from `product_list` p inner join brand_list b on p.brand_id = b.id inner join categories c on p.category_id = c.id where p.id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        while ($row = $qry->fetch_assoc()) {
            foreach ($row as $k => $v) {
                $$k = stripslashes($v);
            }

          

          

            $stocks = $conn->query("SELECT SUM(quantity) FROM stock_list where product_id = '$id'")->fetch_array()[0];
            $out = $conn->query("SELECT SUM(quantity) FROM order_items where product_id = '{$id}' and order_id in (SELECT id FROM order_list where `status` != 5)")->fetch_array()[0];
            $stocks = $stocks > 0 ? $stocks : 0;
            $out = $out > 0 ? $out : 0;
            $available = $stocks - $out;
        }
    } else {
        echo "<script> alert('Unknown Product ID!'); location.replace('./?page=products');</script>";
    }
} else {
    echo "<script> alert('Product ID is required!'); location.replace('./?page=products');</script>";
}
?>


<head>


</head>
<style>
 
 


    .product-img{
        width:20em;
        height:17em;
        object-fit:scale-down;
        object-position:center center;
        border: none;
    }

    .card-body{
        display:flex;
        flex-direction: row;
        
    }

    .left,
    .right{
        width: 50%;
        margin: 0 0 0 0.5%;

    }

 


    .right{
        display: flex;
        flex-direction: column;
        
      

       
    }

    .brand_name{
        color:#004399;
        font-size:1.875rem;
    }

    .price{
        color:#004399;
        font-size:1.25rem;;
    }
    .desc{
        text-align:justify;
    }

    .ab{
        display:flex;
        flex-direction: row;

       

    }

    .add-cart
    {
        border:1px solid none;
        margin:10% 0%;
        padding:3% 5%;
        background-color: #004399;
        color:white;
        border-radius:2px;
        width: 100%;

    }

    .add-cart a {
    text-align: center;
    color: white;
    display: block;
    margin: 0 auto; /* This centers the link horizontally */
}


    

    .card-title{
        color:white;
    }

    .containerr{
      
        margin:0 4%;
        width: 80%;
    
    }

    .content {
        display: flex;
       justify-content: center;
       align-items: center;
      
      
    }


    .card{
        border: none;
        display: flex;
       justify-content: center;
       align-items: center;
    }

</style>
<div class="content ">
    <div class="containerr">
        <div class="card" >
          
            <div class="card-body">
               

                    <div class="left">
                    <div class="image col-md-12 text-center">
                    
           
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="Product Image <?= isset($name) ? $name : "" ?>" class="img-thumbnail product-img">
                        </div>
                    </div>
                </div>
                        </div>
                
                   
                    <div class="right">

                 
                        <div class="info">
                        <p class="brand_name"><strong><?= isset($name) ? $name : ''?></strong> </p>
                        
 
                        </div>
                        
                        <div class="info-desc" >
                            <small class="desc"><?= isset($description) ? html_entity_decode($description) : '' ?></small>
                        </div>


                        <div class="info">
                            <small>Compatible Models:    <?= isset($models) ? $models : '' ?></small>
                            
                        </div>

                        <small class="price">₱<strong><?= isset($price) ? number_format($price, 2) : '' ?></strong></small>


                       

                        

                        <div class="info">
                            <small>Category:     <strong><?= isset($category) ? $category : '' ?></strong></small>
                           
                        </div>

                      

                        <div class="info">
                        <small> Brand:     <strong><?= isset($brand) ? $brand : '' ?></strong></small>
                            
                        </div>

                      
                    
                        <div class="info">
                            <small>Available Stocks:     <strong> <?= isset($available) ? number_format($available) : '' ?></strong></small>
                           
                        </div>
                        <div class="ab">
                        <?php if ($available > 0): ?>
                            <div class="add-cart card-tools">
                                <a href="javascript:void(0)" id="add_to_cart" class="cart">Add to Cart</a>
                            </div>

                          
                        <?php else: ?>
                            <div class="out-of-stock">
                                <button class="btn btn-danger">Out of Stock</button>
                            </div>
                        <?php endif; ?>
                    </div>

                       
                 
                 
                    </div> 
                </div>
            </div>
        </div>
    </div>

   
</div>

  
       

    <script>

    $(function () {
    $('#add_to_cart').click(function () {
        addToCart();
    });

    $('#buy_now').click(function () {
        buyNow();
    });

    function addToCart() {
        $('#add_to_cart').click(function(){
            if("<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2 ?>" == 1){
                if('<?= $available > 0 ?>' == 1){
                    start_loader()
                    $.ajax({
                        url:_base_url_+"classes/Master.php?f=save_to_cart",
                        method:'POST',
                        data:{product_id: '<?= isset($id) ? $id : "" ?>',quantity:1},
                        dataType:'json',
                        error:err=>{
                            console.error(err)
                            alert_toast("An error occured","error")
                            end_loader();
                        },
                        success:function(resp){
                            if(resp.status =='success'){
                                update_cart_count(resp.cart_count);
                                alert_toast(" Product has been added to cart.",'success')
                            }else if(!!resp.msg){
                                alert_toast(resp.msg,'error')
                            }else{
                                alert_toast("An error occured","error")
                            }
                            end_loader();
                        }
                    })
                }
            }else{
                alert_toast(" Please Login First!",'warning')
            }
        })
    }

    function buyNow() {
        if ("<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2 ?>" == 1) {
            if ('<?= $available > 0 ?>' == 1) {
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=process_immediate_purchase", // Replace with the appropriate URL for immediate purchase
                    method: 'POST',
                    data: {
                        product_id: '<?= isset($id) ? $id : "" ?>',
                        quantity: 1
                    },
                    dataType: 'json',
                    error: err => {
                        console.error(err);
                        alert_toast("An error occurred", "error");
                        end_loader();
                    },
                    success: function (resp) {
                        if (resp.status == 'success') {
                            // Handle the success response for immediate purchase
                            alert_toast("Product has been purchased.", 'success');
                        } else if (!!resp.msg) {
                            alert_toast(resp.msg, 'error');
                        } else {
                            alert_toast("An error occurred", "error");
                        }
                        end_loader();
                    }
                });
            }
        } else {
            alert_toast("Please Login First!", 'warning');
        }
    }
});

    
    </script>
