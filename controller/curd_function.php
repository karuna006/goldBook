<?php
function curd_custom($action, $data, $files, $custom)
{
	$allowed_types = array('image/jpeg', 'image/png');
	$target_dir = "../assets/documents/";

	if ($action == 'add') {
		if ($custom == 'product') {
			$raw_data['category_id'] = $data['category_id'];
			$raw_data['seller_id'] = $data['seller_id'];
			$raw_data['name'] = $data['product_name'];
			$raw_data['description'] = $data['description'];
			$raw_data['price'] = $data['price'];
			$raw_data['s_price'] = $data['s_price'];
			$raw_data['sku_code'] = $data['sku_code'];
			$raw_data['pro_dec'] = $data['pro_dec'];
			$raw_data['pro_spe'] = $data['pro_spe'];
			$raw_data['qty'] = $data['qty'];
			$raw_data['stock'] = $data['stock'];
			$raw_data['brand'] = $data['brand'];
			$raw_data['product_type'] = 1;

			if ($files['image']['name'] != '') {
				$string = '1234567890';
				$string_shuffled = str_shuffle($string);
				$rand = substr($string_shuffled, 1, 3);

				$ext = explode(".", $files["image"]["name"]);
				$files["image"]["name"] = date('dmy') . '_' . $rand . '.' . $ext[1];

				$target_file = $target_dir . basename($files["image"]["name"]);
				if (move_uploaded_file($files["image"]["tmp_name"], $target_file)) {
					$file = $files['image']['name'];
					$raw_data['image'] = $file;
				}
			}

			$raw_data['sub_image'] = [];
			foreach ($files['sub_image']['name'] as $key => $value) {
				if ($files['sub_image']['name'][$key] != '') {
					$string = '1234567890';
					$string_shuffled = str_shuffle($string);
					$rand = substr($string_shuffled, 1, 3);

					$ext = explode(".", $files["sub_image"]["name"][$key]);
					$files["sub_image"]["name"][$key] = date('dmy') . '_' . $rand . '.' . $ext[1];

					$target_file = $target_dir . basename($files["sub_image"]["name"][$key]);
					if (move_uploaded_file($files["sub_image"]["tmp_name"][$key], $target_file)) {
						$file = $files['sub_image']['name'][$key];
						$raw_data['sub_image'][] = $file;
					}
				}
			}

			if (!empty($raw_data['sub_image'])) {
				$raw_data['sub_image'] = implode(',', $raw_data['sub_image']);
			}

			// print_r($raw_data);

			$result = insert($custom, $raw_data, db_connect());
			if ($result) {
				return $result;
			}
		}

		switch ($custom) {
			case 'admin_data':				
				$raw_data["name"] = $_POST['name'];
				$raw_data["company_name"] = $_POST['company_name'];
				$raw_data["phone_number"] = $_POST['phone_number'];
				$raw_data["whatsapp_number"] = $_POST['whatsapp_number'];
				$raw_data["email"] = $_POST['email'];
				$raw_data["address"] = $_POST['address'];
				$raw_data["gst"] = $_POST['gst'];
				$raw_data["event_name"] = $_POST['event_name'];
				$raw_data["event_location"] = $_POST['event_location'];
				$raw_data["event_start_date"] = $_POST['event_start_date'];
				$raw_data["event_end_date"] = $_POST['event_end_date'];
				$raw_data["subscription_period"] = $_POST['subscription_period'];
				$raw_data["software_remarks"] = $_POST['software_remarks'];
				$raw_data["username"] = $_POST['username'];
				$raw_data["password"] = encrypt_decrypt('encrypt',$_POST['password']);				
				// $raw_data["documents"] = file_get_contents($_FILES['documents']['tmp_name']); 
				$raw_data["project_cost"] = $_POST['project_cost'];
				$raw_data["accounts_remarks"] = $_POST['accounts_remarks'];
				$raw_data["referred_by"] = $_POST['referred_by'];				
				$raw_data['documents'] = [];				

				foreach ($files['documents']['name'] as $key => $value) {
					if ($files['documents']['name'][$key] != '') {						
						$ext = explode(".", $files["documents"]["name"][$key]);
						$files["documents"]["name"][$key] = $ext[0]."_".date('dmy_His').'.'.$ext[1];

						$target_file = $target_dir . basename($files["documents"]["name"][$key]);
						if (move_uploaded_file($files["documents"]["tmp_name"][$key], $target_file)) {
							$file = $files['documents']['name'][$key];
							$raw_data['documents'][] = $file;
						}
					}
				}

				if (!empty($raw_data['documents'])) {
					$raw_data['documents'] = implode(',', $raw_data['documents']);
				}

				$result = insert($custom, $raw_data, db_connect());
				if ($result) {
					return $result;
				}				
			;
			
			default:
			
			break;
		}
	} elseif ($action == 'update') {
		if ($custom == 'seller') {
			$raw_data['name'] = $data['name'];
			$raw_data['nickname'] = $data['nickname'];
			$raw_data['phone_no'] = $data['phone_no'];
			$raw_data['email'] = $data['email'];
			$raw_data['password'] = encrypt_decrypt('encrypt', $data['password']);
			$raw_data['reg_com_name'] = $data['reg_com_name'];
			$raw_data['gstin'] = $data['gstin'];
			$raw_data['tele'] = $data['tele'];
			$raw_data['address_1'] = $data['address_1'];
			$raw_data['address_2'] = $data['address_2'];
			$raw_data['state'] = $data['state'];
			$raw_data['city'] = $data['city'];
			$raw_data['pincode'] = $data['pincode'];
			$raw_data['country'] = $data['country'];
			$raw_data['bank_name'] = $data['bank_name'];
			$raw_data['acc_holder_name'] = $data['acc_holder_name'];
			$raw_data['acc_no'] = $data['acc_no'];
			$raw_data['ifsc_code'] = $data['ifsc_code'];
			$raw_data['comm'] = $data['comm'];
			$raw_data['category_id'] = $data['category_id'];
			$condition = "(`id` = '" . ($_GET['id']) . "')";
			$result = update($raw_data, $custom, $condition, db_connect());
			if ($result) {
				return $result;
			}
		}
	} elseif ($action == 'delete') {		
		if ($custom == 'delete_product_v') {
			
		} elseif ($custom == 'delete_product_v_seller') {
			$raw_data['status'] = '0';
			$condition = "(`id` = '" . ($data['id']) . "')";
			$result = update($raw_data, 'product', $condition, db_connect());
			if ($result) {
				header('location: ../../seller/view/view_product.php');
				exit();
			}
		}
	}
}
