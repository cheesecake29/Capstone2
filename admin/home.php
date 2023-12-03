<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
  a {
    color: black;
  }

  .client-content{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50%;
    border-radius: 10px 10px 0 0;
    background-color: #ffff;
    flex-direction: column;
    
  }


  </style>


<hr>
<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-copyright"></i></span>

              <div class="info-box-content">
                <a href="<?php echo base_url ?>admin/?page=maintenance/brands">
                <span class="info-box-text">Total Brands</span>
                <span class="info-box-number">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM brand_list where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
</a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              
              <span class="info-box-icon bg-light elevation-1"><i class="fas fa-th-list"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=maintenance/category">
                <span class="info-box-text">Total Category</span>
                <span class="info-box-number">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM categories where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
                  </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        
             
  
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th-list"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=maintenance/services">
                <span class="info-box-text">Services</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT id  FROM `service_list` where status = 1 ")->fetch_assoc()['id'];
                    echo number_format($services);
                  ?>
                    </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=clients">
                <span class="info-box-text">Registered Clients</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT  count(id) as total FROM `client_list` where status = 1 and delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                   </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=orders">
                <span class="info-box-text">Pending Orders</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `order_list` where status = 0 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                  </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=orders">
                <span class="info-box-text">Confirmed Orders</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `order_list` where status =  1")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                   </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=orders">
                <span class="info-box-text">Orders For Delivery</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `order_list` where status = 2 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                  </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=orders">
                <span class="info-box-text">On the Way Orders</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `order_list` where status = 3 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                  </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=orders">
                <span class="info-box-text">Delivered Orders</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `order_list` where status = 4 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                   </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
              <a href="<?php echo base_url ?>admin/?page=orders">
                <span class="info-box-text">Cancelled Orders</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(*) as total FROM `order_list` where status =5 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                   </a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
 


     

</div>


