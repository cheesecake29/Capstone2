<?php
$order_config = $conn->query("SELECT *, pl.id as product_id from order_config og left join product_list pl on pl.id = og.product_id order by og.product_id;");
?>
<div class="order-configuration">
    <div class="config-header">
        <h1>Update Order Configuration</h1>
    </div>
    <div class="dropdown-divider my-3"></div>
    <div class="config-body">
        <form id="order-config" action="">
            <div class="d-flex align-items-end">
                <div class="mr-2">
                    <label for="max-price" class="control-label">Product</label>
                    <select name="type" id="type" class="custom-select select2" required>
                        <!-- <option value="" disabled selected> Select product</option> -->
                        <option value="All" selected> All</option>
                        <!-- <?php
                        $result = $conn->query("SELECT * from product_list where delete_flag = 0");
                        while ($row = $result->fetch_assoc()) :
                        ?> -->
                            <!-- <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option> -->
                        <!-- <?php endwhile; ?> -->
                    </select>
                </div>
                <div class="mr-2">
                    <label for="max-price" class="control-label">Maximum order price <?= isset($type) ? $type : '' ?></label>
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
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
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
    $(document).ready(function() {
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
                        alert_toast('Order config successfully submitted', 'success');
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
</script>