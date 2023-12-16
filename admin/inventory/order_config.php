<?php
$order_config = $conn->query("SELECT og.*, pl.id as product_id from order_config og left join product_list pl on pl.id = og.product_id order by og.product_id;");
?>

<style>
  .upper-content {
    display: flex;
    
  }

  .order-configuration {
    background-color: white;
    width: 100%;
  }



  

  .config-body form .upper-content .d-flex {
    margin-top: 10px;
    justify-content: center;
  }

  .order-config-list table {
    width: 100%;
    overflow-x: auto;
  }


  .config-body form .upper-content .mr-2 {
    margin-right: 0;
    margin-bottom: 10px;
    width: 100%; /* Set width to 100% */
  }



  @media only screen and (max-width: 375px) {
  /* 320px - 480px: Mobile devices */
  .config-body form .upper-content .d-flex {
    flex-direction: column;
    align-items: center;
    padding: 1%;
  }
  
}

@media only screen and (max-width: 768px) {
    /* Adjust the max-width as needed */
    .config-body form .upper-content {
      flex-direction: column;
      align-items: center;
      padding: 1%;
    }

    .config-body form .upper-content .mr-2 {
      margin-bottom: 0;
      padding: 1%;
    }
  }

@media only screen and (min-width: 769px) and (max-width: 1024px) {
  /* 769px - 1024px: Small screens, laptops */
  .config-body form .upper-content .d-flex {
    flex-direction: row;
    justify-content: center;
    padding: 1%;
  }

}

@media only screen and (min-width: 1025px) and (max-width: 1200px) {
  /* 1025px - 1200px: Desktops, large screens */
  .config-body form .upper-content .d-flex {
    flex-direction: row;
    justify-content: center;
    padding: 1%;
  }
}

@media only screen and (min-width: 1201px) {
  /* 1201px and more: Extra large screens, TV */
  .config-body form .upper-content .d-flex {
    flex-direction: row;
    justify-content: center;
    padding: 1%;
  }
}

  
</style>

<div class="order-configuration">
    
    <div class="dropdown-divider my-3"></div>
    <div class="config-body">
        <form id="order-config" action="">
            <div class="upper-content d-flex align-items-end">
                <div class="mr-2">
                    <label for="max-price" class="control-label">Product</label>
                    <select name="type" id="type" class="custom-select select2" required>
                        <!-- <option value="" disabled selected> Select product</option> -->
                        <option value="All" disabled selected> All</option>
                        <!-- <?php
                                $result = $conn->query("SELECT * from product_list where delete_flag = 0");
                                while ($row = $result->fetch_assoc()) :
                                ?> -->
                        <!-- <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option> -->
                        <!-- <?php endwhile; ?> -->
                    </select>
                </div>
            <div class="mr-2">
                    <label for="max-price" class="control-label">Maximum price limit <?= isset($type) ? $type : '' ?></label>
                    <input name="max-price" id="max-price" type="text" class="form-control rounded-0 CurrencyInput" value="<?php echo isset($value) ? $value : ''; ?>" required>
                </div>
                <!-- <div class="mr-2">
                    <label for="max-quantity" class="control-label">Maximum order quantity</label>
                    <input name="max-quantity" id="max-quantity" type="number" class="form-control rounded-0" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
                </div> -->
                <div class="d-flex align-items-end">
                    <button class="btn btn-flat btn-primary" type="submit">Save</button>
                </div>
            </div>
        </form>
        <div class="order-config-list mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Max Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row = $order_config->fetch_assoc()) :
                    ?>
                        <tr>
                            <th scope="row"><?= isset($row['product_id']) ? $row['product_id'] : 'All' ?></th>
                            <th><?= isset($row['name']) ? $row['name']  : 'All' ?></th>
                            <td><?= number_format($row['value']) ?></td>
                            <td><button class="btn btn-link text-danger delete_config" data-id="<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <?php
                while ($row = $order_config->fetch_assoc()) :
                ?>
                    <tr>
                        <th scope="row"><?= isset($row['product_id']) ? $row['product_id'] : 'All' ?></th>
                        <th><?= isset($row['name']) ? $row['name'] : 'All' ?></th>
                        <td><?= number_format($row['value']) ?></td>
                        <td>
                            <button class="btn btn-danger delete-row" data-product-id="<?= $row['product_id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                            </table>
            
        </div>
    </div>
</div>

<script>

$(document).ready(function () {
    // ... your existing code ...

    // Delete button click event
    $('.delete-row').on('click', function () {
    const productId = $(this).data('product-id');
    const currentRow = $(this); // Store the reference to this element

    // Confirm deletion
    if (confirm('Are you sure you want to delete this record?')) {
        // Send AJAX request to delete the record
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_config",
            data: { productId },
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    // Remove the row from the table
                    currentRow.closest('tr').remove();
                    alert_toast('Order config successfully deleted', 'success');
                } else {
                    alert_toast("An error occurred", 'error');
                    console.log(resp);
                }
            }
        });
    }
});

    // ... your existing code ...
});
    function formatToCurrencyOnly(value) {
        return parseFloat(value).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        });
    }

    function formatToCurrency(element, value) {
        if (value) {
            element.value = formatToCurrencyOnly(value)
        }
    }

    function formatInputValue(element, value) {
        const inputValue = value + event.key; // Obtaining the input value with the new key
        const numericRegex = /^\d*$/; // Validate numeric input with max 2 decimal places
        console.log(inputValue)
        if (!numericRegex.test(inputValue) && event.key !== '.') {
            event.preventDefault(); // Prevent entering non-numeric characters except for the dot
        }
    }

    function removeOrderConfigConf(id) {
        _conf("Are you sure to delete this permanently?", "removeOrderConfig", [])
    }

    $(document).ready(function() {
        $('.delete_config').click(function() {
            _conf("Are you sure to delete this product permanently?", "removeOrderConfig", [$(this).attr('data-id')])
        })
        const currenctInput = document.getElementsByClassName('CurrencyInput');
        for (let i = 0; i < currenctInput.length; i++) {
            formatToCurrency(currenctInput[i], currenctInput[i].value);
        }

        $('input.CurrencyInput').on('blur', function() {
            const value = this.value.replace(/,/g, '');
            formatToCurrency(this, value);
        });
        $('input.CurrencyInput').on('keypress', function() {
            const value = this.value.replace(/,/g, '');
            formatInputValue(this, value);
        });
        const currencyToNumber = (currency) => {
            if (currency) {
                return Number(currency.toString().replace(/[$,]/g, ''));
            }
            return 0;
        }
        // max order config submission
        $('#order-config').submit(function(e) {
            e.preventDefault();
            const formData = new FormData($(this)[0]);
            // Display the values
            var configType = formData.get('type');
            var configPrice = formData.get('max-price');
            var configQuantity = formData.get('max-quantity');
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_order_config",
                data: {
                    configType,
                    configPrice: currencyToNumber(configPrice),
                    configQuantity: 0
                },
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                success: function(resp) {
                    console.log(resp)
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.href = './?page=inventory/order_config';
                    } else {
                        alert_toast("An error occured", 'error');
                        console.log(resp)
                    }
                }
            })
        })

        $('select').on('change', function() {
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=find_order_config",
                data: {
                    productId: this.value,
                },
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {

                        if (resp.data && resp.data.length > 0) {
                            const data = JSON.parse(resp.data) || {};
                            $('#max-price').val(formatToCurrencyOnly(data['value']))
                            $('#max-quantity').val(data['quantity'])
                        } else {

                            $('#max-price').val('')
                            $('#max-quantity').val('')
                        }
                    } else {
                        alert_toast("An error occured", 'error');
                        console.log(resp)
                    }
                }
            })
        });
    })

    function removeOrderConfig(id) {
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_order_config",
            data: {
                configId: id
            },
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            success: function(resp) {
                console.log(resp)
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.href = './?page=inventory/order_config';
                } else {
                    alert_toast("An error occured", 'error');
                    console.log(resp)
                }
            }
        })
    }
</script>