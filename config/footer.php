            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Hak Cipta &copy; 2021 - <?=date('Y') ?> | <a href="https://puskesmasbangodua.com">UPTD Puskesmas Bangodua</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<!-- Bootstrap core JavaScript-->
<script src="<?=base_url();?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?=base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?=base_url();?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?=base_url();?>assets/js/jquery-3.5.1.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>assets/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>assets/vendor/jquery-mask/jquery-mask.min.js"></script>
<script src="<?=base_url();?>assets/vendor/sweet-alert/sweetalert2.all.min.js"></script>
<script src="<?=base_url();?>assets/vendor/select2/js/select2.min.js"></script>

<!-- Page level custom scripts -->
<!-- <script src="<?=base_url();?>assets/js/demo/datatables-demo.js"></script> -->
<script src="<?=base_url();?>assets/js/demo/sweet-alert.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        theme: "classic",
    });
    $('.uang').mask('000.000.000.000.000', {
        reverse: true
    });
})

$(document).ready(function() {
	$('#example').DataTable({
		responsive: true
	});
} );
</script>
</body>

</html>