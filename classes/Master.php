<?php
require_once('../config.php');
class Master extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	function capture_err()
	{
		if (!$this->conn->error)
			return false;
		else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function console_log($output, $with_script_tags = true)
	{
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
			');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}
	function save_category()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'description'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (isset($_POST['description'])) {
			if (!empty($data)) $data .= ",";
			$data .= " `description`='" . addslashes(htmlentities($description)) . "' ";
		}
		$check = $this->conn->query("SELECT * FROM `categories` where `category` = '{$category}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Category already exist.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `categories` set {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `categories` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "New Category successfully saved.");
			else
				$this->settings->set_flashdata('success', "Category successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_category()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `categories` set delete_flag = 1 where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Category successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_brand()
	{
		extract($_POST);
		$data = "";

		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				$v = $this->conn->real_escape_string($v);
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}

		$check = $this->conn->query("SELECT * FROM `brand_list` WHERE `name` = '{$name}' " . (!empty($id) ? "AND id != {$id}" : ""))->num_rows;

		if ($this->capture_err()) {
			return $this->capture_err();
		}

		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Brand already exists.";
			return json_encode($resp);
		}

		if (empty($id)) {
			$sql = "INSERT INTO `brand_list` SET {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `brand_list` SET {$data} WHERE id = '{$id}' ";
			$save = $this->conn->query($sql);
		}

		if ($save) {
			$resp['status'] = 'success';
			$id = empty($id) ? $this->conn->insert_id : $id;

			if (empty($id)) {
				$resp['msg'] = "New Brand successfully saved.";
			} else {
				$resp['msg'] = "Brand successfully updated.";
			}

			if (!empty($_FILES['img']['tmp_name'])) {
				$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
				$dir = base_app . "uploads/brands/";

				if (!is_dir($dir)) {
					mkdir($dir);
				}

				$name = $id . "." . $ext;

				if (is_file($dir . $name)) {
					unlink($dir . $name);
				}

				$move = move_uploaded_file($_FILES['img']['tmp_name'], $dir . $name);

				if ($move) {
					$this->conn->query("UPDATE `brand_list` SET image_path = CONCAT('uploads/brands/$name','?v=',UNIX_TIMESTAMP(CURRENT_TIMESTAMP)) WHERE id = '{$id}'");
				} else {
					$resp['msg'] .= " But logo has failed to upload.";
				}
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error . " [{$sql}]";
		}

		if (isset($resp['msg']) && $resp['status'] == 'success') {
			$this->settings->set_flashdata('success', $resp['msg']);
		} else {
			$this->settings->set_flashdata('error', 'An error occurred');
		}

		return json_encode($resp);
	}

	function delete_brand()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `brand_list` set `delete_flag` = 1  where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Brand successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_supplier()
	{
		extract($_POST);
		$data = "";

		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				$v = $this->conn->real_escape_string($v);
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}

		$check = $this->conn->query("SELECT * FROM `supplier_list` WHERE `name` = '{$name}' " . (!empty($id) ? "AND id != {$id}" : ""))->num_rows;

		if ($this->capture_err()) {
			return $this->capture_err();
		}

		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Supplier already exists.";
			return json_encode($resp);
		}

		if (empty($id)) {
			$sql = "INSERT INTO `supplier_list` SET {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `supplier_list` SET {$data} WHERE id = '{$id}' ";
			$save = $this->conn->query($sql);
		}

		if ($save) {
			$resp['status'] = 'success';
			$id = empty($id) ? $this->conn->insert_id : $id;

			if (empty($id)) {
				$resp['msg'] = "New Supplier successfully saved.";
			} else {
				$resp['msg'] = "Supplier successfully updated.";
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error . " [{$sql}]";
		}

		if (isset($resp['msg']) && $resp['status'] == 'success') {
			$this->settings->set_flashdata('success', $resp['msg']);
		} else {
			$this->settings->set_flashdata('error', 'An error occurred');
		}

		return json_encode($resp);
	}

	function delete_supplier()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `supplier_list` set `delete_flag` = 1  where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Supplier successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_product()
	{
		$_POST['description'] = htmlentities($_POST['description']);
		$_POST['price'] = (float)str_replace(',', '', $_POST['price']);
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!str_contains($k, 'variation')) {
					$v = $this->conn->real_escape_string($v);
					if (!empty($data)) $data .= ",";
					$data .= " `{$k}`='{$v}' ";
				}
			}
		}
		$check = $this->conn->query("SELECT * FROM `product_list` where `name` = '{$name}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Product already exist.";
			return json_encode($resp);
			exit;
		}
		function processVariations($conn, $product_id)
		{
			if (isset($_POST['variation_name'])) {
				$totalStocks = 0;
				foreach ($_POST['variation_name'] as $row => $value) {
					$variation_id = $_POST['variation_id'][$row];
					$variation_price = (float)str_replace(',', '', $_POST['variation_price'][$row]);
					$variation_name = $_POST['variation_name'][$row];
					$variation_stock = $_POST['variation_stock'][$row];
					$variation_delete_flag = $_POST['variation_delete_flag'][$row];
					$totalStocks += $variation_stock;
					if ($variation_id) {
						$sqlProductVariationUpdate = "UPDATE `product_variations` set `delete_flag` = '{$variation_delete_flag}', `variation_name` = '{$variation_name}', `variation_price` = '{$variation_price}', `variation_stock` = '{$variation_stock}' where `id` = '{$variation_id}' ";
						$conn->query($sqlProductVariationUpdate);
					} else {
						$sqlProductVariationInsert = "INSERT INTO `product_variations` (`product_id`, `variation_name`, `variation_price`, `variation_stock`, `delete_flag`) VALUES ('{$product_id}', '{$variation_name}', '{$variation_price}', '{$variation_stock}', '{$variation_delete_flag}') ";
						$conn->query($sqlProductVariationInsert);
					}
				}
				return $totalStocks;
			} else {
				$sqlProductVariationInsert = "INSERT INTO `product_variations` (`product_id`, `variation_name`, `variation_price`, `variation_stock`, `delete_flag`, `default_flag`) VALUES ('{$product_id}', 'default', '{$_POST['price']}', 0, 0, 1) ";
				$conn->query($sqlProductVariationInsert);
				return 0;
			}
		}
		if (empty($id)) {
			$sql = "INSERT INTO `product_list` set {$data} ";
			$save = $this->conn->query($sql);
			$product_id = $this->conn->insert_id;
		} else {
			$sql = "UPDATE `product_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			$pid = empty($id) ? $this->conn->insert_id : $id;
			$resp['id'] = $pid;
			if (empty($id)) {
				$resp['msg'] = "New Product successfully saved.";
				$totalStocks = processVariations($this->conn, $product_id);
				$this->conn->query("INSERT INTO `stock_list`  (`product_id`, `quantity`, `type`) VALUES ('{$product_id}', '{$totalStocks}', 1)");
			} else {
				$resp['msg'] = "Product successfully updated.";
				$totalStocks = processVariations($this->conn, $id);
				$this->conn->query("UPDATE `stock_list` set `quantity` = '{$totalStocks}' where product_id = '{$id}' ");
			}
			if (!empty($_FILES['img']['tmp_name'])) {
				$ext = $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
				$dir = base_app . "uploads/products/";
				if (!is_dir($dir))
					mkdir($dir);
				$name = $pid . "." . $ext;
				if (is_file($dir . $name))
					unlink($dir . $name);
				$move = move_uploaded_file($_FILES['img']['tmp_name'], $dir . $name);
				if ($move) {
					$this->conn->query("UPDATE `product_list` set image_path = CONCAT('uploads/products/$name','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$pid}'");
				} else {
					$resp['msg'] .= " But logo has failed to upload.";
				}
			}
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		if (isset($resp['msg']) && $resp['status'] == 'success') {
			$this->settings->set_flashdata('success', $resp['msg']);
		}
		return json_encode($resp);
	}
	function delete_product()
	{
		extract($_POST);
		$datenow = date("Y-m-d H:i:s");
		$del = $this->conn->query("UPDATE `product_list` set `delete_flag` = 1  where id = '{$id}'");
		$this->conn->query("UPDATE `product_variations` set `delete_flag` = 1, `date_updated` = '{$datenow}'  where product_id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Product successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_service()
	{
		extract($_POST);
		$data = "";
		$_POST['description'] = addslashes(htmlentities($description));
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `service_list` where `service` = '{$service}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Service already exist.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `service_list` set {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `service_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "New Service successfully saved.");
			else
				$this->settings->set_flashdata('success', "Service successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_service()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `service_list` set delete_flag = 1 where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Service successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_stock()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!str_contains($k, 'variation')) {
					if (!empty($data)) $data .= ",";
					$data .= " `{$k}`='{$v}' ";
				}
			}
		}
		if (empty($id)) {
			if (isset($_POST['variation_id'])) {
				$sqlInventoryUpdate = "UPDATE `product_variations` set `variation_stock` = '{$_POST['quantity']}' where id = '{$_POST['variation_id']}' ";
				$this->conn->query($sqlInventoryUpdate);
			} else {
				$sqlInventoryUpdate = "UPDATE `product_variations` set `variation_stock` = '{$_POST['quantity']}' where default_flag = 1 ";
				$this->conn->query($sqlInventoryUpdate);
			}
			$productVariationsTotalQuantity = $this->conn->query("SELECT SUM(`variation_stock`) as totalQuantity FROM `product_variations` where product_id = '{$_POST['product_id']}'");
			$sql = "INSERT INTO `stock_list` (`product_id`, `quantity`) VALUES ('{$_POST['product_id']}', '{$productVariationsTotalQuantity->fetch_assoc()['totalQuantity']}') ";
			$save = $this->conn->query($sql);
		} else {
			if (isset($_POST['variation_id'])) {
				$sqlInventoryUpdate = "UPDATE `product_variations` set `variation_stock` = '{$_POST['quantity']}' where id = '{$_POST['variation_id']}' ";
				$this->conn->query($sqlInventoryUpdate);
			} else {
				$sqlInventoryUpdate = "UPDATE `product_variations` set `variation_stock` = '{$_POST['quantity']}' where default_flag = 1 ";
				$this->conn->query($sqlInventoryUpdate);
			}
			$productVariationsTotalQuantity = $this->conn->query("SELECT SUM(`variation_stock`) as totalQuantity FROM `product_variations` where product_id = '{$_POST['product_id']}'");
			$sql = "UPDATE `stock_list` set `quantity` = '{$$productVariationsTotalQuantity->fetch_assoc()['totalQuantity']}' where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "New Stock successfully saved.");
			else
				$this->settings->set_flashdata('success', "Stock successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_stock()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `stock_list` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Stock successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_mechanic()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `mechanics_list` where `name` = '{$name}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Mechanic already exist.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `mechanics_list` set {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `mechanics_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "New Mechanic successfully saved.");
			else
				$this->settings->set_flashdata('success', "Mechanic successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_mechanic()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `mechanics_list` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Mechanic successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_request()
	{
		if (empty($_POST['id']))
			$_POST['client_id'] = $this->settings->userdata('id');
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (in_array($k, array('client_id', 'service_type', 'mechanic_id', 'status'))) {
				if (!empty($data)) {
					$data .= ", ";
				}

				$data .= " `{$k}` = '{$v}'";
			}
		}
		if (empty($id)) {
			$sql = "INSERT INTO `service_requests` set {$data} ";
		} else {
			$sql = "UPDATE `service_requests` set {$data} where id ='{$id}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$rid = empty($id) ? $this->conn->insert_id : $id;
			$data = "";
			foreach ($_POST as $k => $v) {
				if (!in_array($k, array('id', 'client_id', 'service_type', 'mechanic_id', 'status'))) {
					if (!empty($data)) {
						$data .= ", ";
					}
					if (is_array($_POST[$k]))
						$v = implode(",", $_POST[$k]);
					$v = $this->conn->real_escape_string($v);
					$data .= "('{$rid}','{$k}','{$v}')";
				}
			}
			$sql = "INSERT INTO `request_meta` (`request_id`,`meta_field`,`meta_value`) VALUES {$data} ";
			$this->conn->query("DELETE FROM `request_meta` where `request_id` = '{$rid}' ");
			$save = $this->conn->query($sql);
			if ($save) {
				$resp['status'] = 'success';
				$resp['id'] = $rid;
				if (empty($id))
					$resp['msg'] = " Service Request has been submitted successfully.";
				else
					$resp['msg'] = " Service Request details has been updated successfully.";
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['sql'] = $sql;
				if (empty($id))
					$resp['msg'] = " Service Request has failed to submit.";
				else
					$resp['msg'] = " Service Request details has failed to update.";
				$this->conn->query("DELETE FROM `service_requests` where id = '{$rid}'");
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['sql'] = $sql;
			if (empty($id))
				$resp['msg'] = " Service Request has failed to submit.";
			else
				$resp['msg'] = " Service Request details has failed to update.";
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata("success", $resp['msg']);
		return json_encode($resp);
	}
	function delete_request()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `service_requests` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Request successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_to_cart()
	{
		$_POST['client_id'] = $this->settings->userdata('id');
		extract($_POST);

		$check = $this->conn->query("SELECT * FROM `cart_list` where client_id = '{$client_id}'
		and product_id = '{$product_id}' and variation_id = '{$variation_id}'")->num_rows;
		if ($check > 0) {
			$sql = "UPDATE `cart_list` set quantity = quantity + {$quantity}  where product_id = '{$product_id}'
			and client_id = '{$client_id}' and variation_id = '{$variation_id}'";
		} else {
			$sql = "INSERT INTO `cart_list` set quantity = quantity + {$quantity}, product_id = '{$product_id}',
			client_id = '{$client_id}', variation_id = '{$variation_id}'";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$resp['status'] = 'success';
			$resp['cart_count'] = $this->conn->query("SELECT SUM(quantity) from cart_list where client_id = '{$client_id}'")->fetch_array()[0];
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = " Product has failed to add in the cart list.";
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}



	function update_cart_quantity()
	{
		extract($_POST);
		$get = $this->conn->query("SELECT * FROM `cart_list` where id = '{$cart_id}'")->fetch_array();
		$pid = $get['product_id'];
		$selectedQuantity = eval("return " . $get['quantity'] . " " . $quantity . ";");
		$getVariationQuantity = $this->conn->query("SELECT variation_stock FROM `product_variations` where product_id = '{$pid}' and id = '{$variation_id}'")->fetch_array()[0];
		// check variation first
		if ($selectedQuantity > (int)$getVariationQuantity) {
			$resp['status'] = 'failed';
			$resp['msg'] = " Product variation has only $getVariationQuantity available stock";
			return json_encode($resp);
		} else {
			$stocks = $this->conn->query("SELECT SUM(quantity) FROM stock_list where product_id = '$pid'")->fetch_array()[0];
			$out = $this->conn->query("SELECT SUM(quantity) FROM order_items where product_id = '{$pid}'and id = '{$variation_id}'
				and order_id in (SELECT id FROM order_list where `status` != 5) ")->fetch_array()[0];
			$stocks = $stocks > 0 ? $stocks : 0;
			$out = $out > 0 ? $out : 0;
			$available = $stocks - $out;
			if ($available < 1) {
				$resp['status'] = 'failed';
				$resp['msg'] = "{$stocks} - {$out} Product doesn't have stock available.";
				$save = $this->conn->query("UPDATE cart_list set quantity = '0' where id = '{$cart_id}'");
			} elseif ($selectedQuantity < 1 && $available > 0) {
				$resp['status'] = 'failed';
				$save = $this->conn->query("UPDATE cart_list set quantity = '1' where id = '{$cart_id}'");
				$resp['msg'] = " You are at the lowest quantity.";
			} elseif ($selectedQuantity > $available) {
				$resp['status'] = 'failed';
				$save = $this->conn->query("UPDATE cart_list set quantity = '{$available}' where id = '{$cart_id}'");
				$resp['msg'] = " Product has only [{$available}] available stock";
			} else {
				$resp['status'] = 'success';
				$save = $this->conn->query("UPDATE cart_list set quantity = quantity {$quantity} where id = '{$cart_id}'");
			}
			return json_encode($resp);
		}
	}
	function remove_from_cart()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `cart_list` where id = '{$cart_id}'");
		if ($del) {
			$resp['status'] = 'success';
			$resp['msg'] = " Product has been remove from cart list successfully.";
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = " Product has failed to remove from the cart list.";
			$resp['error'] = $this->conn->error;
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function place_order()
	{
		$_POST['client_id'] = $this->settings->userdata('id');
		extract($_POST);
		$pref = date("Ym-");
		$code = sprintf("%'.05d", 1);
		while (true) {
			$check = $this->conn->query("SELECT * FROM `order_list` where ref_code = '{$pref}{$code}'")->num_rows;
			if ($check > 0) {
				$code = sprintf("%'.05d", ceil($code) + 1);
			} else {
				break;
			}
		}
		$ref_code = $pref . $code;
		$other_address = '';
		$withShippingFee = false;
		switch ((int)$order_type) {
			case 1: // JRS
				$withShippingFee = true;
				$other_address = '';
				break;
			case 1: // Lalamove
				$withShippingFee = false;
				$other_address = '';
				break;
			case 3: // Pick Up
				$withShippingFee = false;
				$other_address = $pickup;
				break;
			case 4: // Meet Up
				$withShippingFee = false;
				$other_address = $othermu;
				break;
		}
		$save = '';
		if($address_type == 1){
			$sql1 = "INSERT INTO `order_list` (`ref_code`,`client_id`,`addressline1`,`addressline2`, `province`, `city`, `zipcode`, `order_type`, `other_address`)
			VALUES ('{$ref_code}','{$client_id}','{$addressline1}','{$addressline2}','{$province}','{$city}','{$zipcode}','{$order_type}', '{$other_address}')";
			$save = $this->conn->query($sql1);
		}else{
			$sql2 = "INSERT INTO `order_list` (`ref_code`,`client_id`,`addressline1`,`addressline2`, `province`, `city`, `zipcode`, `order_type`)
			VALUES ('{$ref_code}','{$client_id}','{$different_addressline1}','{$different_addressline2}','{$province2}','{$city2}','{$different_zipcode}','{$order_type}')";
			$save = $this->conn->query($sql2);
		}

		if ($save) {
			$oid = $this->conn->insert_id;
			$data = "";
			$total_amount = 0;
			if ($withShippingFee) {
				$this->conn->query("INSERT INTO `shipping_fee` (`order_id`, `amount`) VALUES ('{$oid}', '{$shipping_amount}')");
			}
			$cart = $this->conn->query(
				"SELECT 
					c.*,
					pv.variation_price as price
				FROM cart_list c 
					inner join product_list p on c.product_id = p.id
					inner join product_variations pv on pv.id = c.variation_id
				where c.client_id = '{$client_id}'");
			while ($row = $cart->fetch_assoc()) {
				if (!empty($data)) $data .= ", ";
				$data .= "('{$oid}','{$row['product_id']}','{$row['quantity']}', '{$row['variation_id']}')";
				$total_amount += ($row['price'] * $row['quantity']);
			}
			if (!empty($data)) {
				$sql2 = "INSERT INTO `order_items` (`order_id`,`product_id`,`quantity`, `variation_id`) VALUES {$data}";
				$save2 = $this->conn->query($sql2);
				if ($save2) {
					$resp['status'] = 'success';
					$this->conn->query("DELETE FROM `cart_list` where client_id = '{$client_id}'");
					$this->conn->query("UPDATE `order_list` set total_amount = '{$total_amount}' where id = '{$oid}'");
					//Notification
					$fullname = $this->settings->userdata('firstname') . ' ' . $this->settings->userdata('lastname');
					$desc = "{$fullname} ' ' has placed an order.";
					$this->conn->query("INSERT INTO `notifications` SET `client_id` = '{$client_id}', `description` = '{$desc}', `type` = 2, `order_id`='{$oid}'");
					$resp['msg'] = " Order has been place successfully.";
				} else {
					$resp['status'] = 'failed';
					$resp['msg'] = " Order has failed to place.";
					$resp['error'] = $this->conn->error;
					$this->conn->query("DELETE FROM `order_list` where id = '{$oid}'");
				}
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = " Cart is empty.";
			}
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = " Order has failed to place.";
			$resp['error'] = $this->conn->error;
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function cancel_order()
	{
		extract($_POST);
		$update = $this->conn->query("UPDATE `order_list` set status = 5 where id = '{$id}'");
		if ($update) {
			$resp['status'] = 'success';
			$resp['msg'] = " Order has been cancelled.";
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = " Order has failed to cancel.";
			$resp['error'] = $this->conn->error;
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['status']);
		return json_encode($resp);
	}
	function cancel_service()
	{
		extract($_POST);
		$update = $this->conn->query("UPDATE `service_requests` set status = 4 where id = '{$id}'");
		if ($update) {
			$resp['status'] = 'success';
			$resp['msg'] = " Service Request has been cancelled.";
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = " Service Request has failed to cancel.";
			$resp['error'] = $this->conn->error;
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['status']);
		return json_encode($resp);
	}
	function update_order_status()
	{
		extract($_POST);
		$update = $this->conn->query("UPDATE `order_list` set `status` = '{$status}' where id = '{$id}'");
		$result_product_id = $this->conn->query("SELECT `product_id` FROM `order_items` WHERE `order_id` = '{$id}'");

		if ($result_product_id) {
			$row_product_id = $result_product_id->fetch_assoc();
			$product_id = $row_product_id['product_id'];

			// Fetch product_name from product_list table using the obtained product_id
			$result_product_name = $this->conn->query("SELECT `name` FROM `product_list` WHERE `id` = '{$product_id}'");

			if ($result_product_name) {
				$row_product_name = $result_product_name->fetch_assoc();
				$product_name = $row_product_name['name'];

				if ($update) {
					$desc = "";
					if ($status == 0) {
						$desc = 'Your order ' . $product_name . ' is pending.';
					}
					if ($status == 1) {
						$desc = 'Your order ' . $product_name . ' is confirmed.';
					}
					if ($status == 2) {
						$desc = 'Your order ' . $product_name . ' is packed.';
					}
					if ($status == 3) {
						$desc = 'Your order ' . $product_name . ' is for delivery.';
					}
					if ($status == 4) {
						$desc = 'Your order ' . $product_name . ' is on the way.';
					}
					if ($status == 5) {
						$desc = 'Your order ' . $product_name . ' was delivered.';
					}
					if ($status == 6) {
						$desc = 'Your order ' . $product_name . ' was cancelled.';
					}
					$notify = $this->conn->query("INSERT INTO `notifications` SET `client_id` = '{$client_id}', `description` = '{$desc}', `order_id`='{$id}'");
					$resp['status'] = 'success';
					$resp['msg'] = " Order's status has been updated successfully.";
				} else {
					$resp['error'] = $this->conn->error;
					$resp['status'] = 'failed';
					$resp['msg'] = " Order's status has failed to update.";
				}
			} else {
				$resp['error'] = $this->conn->error;
				$resp['status'] = 'failed';
				$resp['msg'] = "Failed to fetch product_name.";
			}
		} else {
			$resp['error'] = $this->conn->error;
			$resp['status'] = 'failed';
			$resp['msg'] = "Failed to fetch product_id.";
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_order()
	{
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM `order_list` where id = '{$id}'");
		if ($delete) {
			$resp['status'] = 'success';
			$resp['msg'] = " Order's status has been deleted successfully.";
		} else {
			$resp['error'] = $this->conn->error;
			$resp['status'] = 'failed';
			$resp['msg'] = " Order's status has failed to delete.";
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_category':
		echo $Master->save_category();
		break;
	case 'delete_category':
		echo $Master->delete_category();
		break;
	case 'save_brand':
		echo $Master->save_brand();
		break;
	case 'delete_brand':
		echo $Master->delete_brand();
		break;
	case 'save_service':
		echo $Master->save_service();
		break;
	case 'delete_service':
		echo $Master->delete_service();
		break;
	case 'save_product':
		echo $Master->save_product();
		break;
	case 'delete_product':
		echo $Master->delete_product();
		break;
	case 'save_stock':
		echo $Master->save_stock();
		break;
	case 'delete_stock':
		echo $Master->delete_stock();
		break;
	case 'save_mechanic':
		echo $Master->save_mechanic();
		break;
	case 'delete_mechanic':
		echo $Master->delete_mechanic();
		break;
	case 'save_request':
		echo $Master->save_request();
		break;
	case 'delete_request':
		echo $Master->delete_request();
		break;
	case 'cancel_service':
		echo $Master->cancel_service();
		break;
	case 'save_to_cart':
		echo $Master->save_to_cart();
		break;
	case 'update_cart_quantity':
		echo $Master->update_cart_quantity();
		break;
	case 'remove_from_cart':
		echo $Master->remove_from_cart();
		break;
	case 'place_order':
		echo $Master->place_order();
		break;
	case 'cancel_order':
		echo $Master->cancel_order();
		break;
	case 'update_order_status':
		echo $Master->update_order_status();
		break;
	case 'delete_order':
		echo $Master->delete_order();
		break;
	default:
		// echo $sysset->index();
		break;
}
