<?php
session_start();
include_once '../../model/db.php';
include_once 'common_function.php';
include_once 'curd_function.php';

$table = encrypt_decrypt('decrypt', $_GET['table']);
$page = encrypt_decrypt('decrypt', $_GET['page']);
if (isset($_REQUEST) && !empty($_REQUEST) && $table != '' && $page != '') {
	if ($_GET['action'] == 'add') {
		if (!isset($_GET['custom'])) {
			$result = insert($table, $_POST, db_connect());
		} else {
			$custom = encrypt_decrypt('decrypt', $_GET['custom']);
			if ($custom != '') {
				$result = curd_custom('add', $_REQUEST, $_FILES, $custom);
			}
		}

		if ($result) {
			$_SESSION['response'] = 'success';
		} else {
			$_SESSION['response'] = 'error';
		}

		if (!isset($_GET['path'])) {
			header('location: ../view/' . $page);
		} else {
		}
	} elseif ($_GET['action'] == 'update') {		
		if (!isset($_GET['custom'])) {
			$condition = "(`id` = '" . ($_GET['id']) . "')";
			$result = update($_POST, $table, $condition, db_connect());
		} else {
			$custom = encrypt_decrypt('decrypt', $_GET['custom']);
			if ($custom != '') {
				$result = curd_custom('update', $_REQUEST, $_FILES, $custom);
			} else {
			}
		}

		if ($result) {
			$_SESSION['response'] = 'updated';
		} else {
			$_SESSION['response'] = 'error';
		}

		if (!isset($_GET['path'])) {
			header('location: ../view/' . $page);
		} else {
		}
	} elseif ($_GET['action'] == 'delete') {
		// echo "asd";

		if (!isset($_GET['custom'])) {
			$raw_data['status'] = '0';
			$condition = "(`id` = '" . ($_GET['id']) . "')";
			$result = update($raw_data, $table, $condition, db_connect());
		} else {
			$custom = encrypt_decrypt('decrypt', $_GET['custom']);
			if ($custom != '') {
				$result = curd_custom('delete', $_REQUEST, $_FILES, $custom);
			} else {
			}
		}

		if ($result) {
			$_SESSION['response'] = 'deleted';
		} else {
			$_SESSION['response'] = 'error';
		}

		if (!isset($_GET['path'])) {
			header('location: ../view/' . $page);
		} else {
		}
	}
} else {
	echo "string";
	if ($_GET['action'] == 'delete') {
		// echo "asd";

		if (!isset($_GET['custom'])) {
			$raw_data['status'] = '0';
			$condition = "(`id` = '" . ($_GET['id']) . "')";
			$result = update($raw_data, $table, $condition, db_connect());
		} else {
			$custom = encrypt_decrypt('decrypt', $_GET['custom']);
			if ($custom != '') {
				$result = curd_custom('delete', $_REQUEST, $_FILES, $custom);
			} else {
			}
		}

		if ($result) {
			$_SESSION['response'] = 'deleted';
		} else {
			$_SESSION['response'] = 'error';
		}

		if (!isset($_GET['path'])) {
			header('location: ../view/' . $page);
		} else {
		}
	}
}
