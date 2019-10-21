<script src="public/assets/js/vendor/jquery-2.2.4.min.js"></script>

<script src="public/assets/js/popper.min.js"></script>
<script src="public/assets/js/bootstrap.min.js"></script>
<script src="public/assets/js/owl.carousel.min.js"></script>
<script src="public/assets/js/metisMenu.min.js"></script>
<script src="public/assets/js/jquery.slimscroll.min.js"></script>
<script src="public/assets/js/jquery.slicknav.min.js"></script>

<script src="public/assets/js/datatables.min.js"></script>
<script src="public/assets/js/sweetalert.min.js"></script>
<script src="public/assets/js/toastr.min.js"></script>

<script src="public/assets/js/plugins.js"></script>
<script src="public/assets/js/scripts.js"></script>

<?php
if (isset($name)) {
	echo '<script src="public/scripts/' . $name . '.js"></script>';
}
?>
</body>

</html>
