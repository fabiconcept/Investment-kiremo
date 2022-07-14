<?php
session_start();
if (isset($_SESSION['cry'])) {
	header("location: dashboard/");
}else {
	header("location: outside/");
}
?>