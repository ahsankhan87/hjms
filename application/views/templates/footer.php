
  </div>
  <!-- /. container-fluid Page Content container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; <?php echo $this->session->userdata('company');?> <?php echo date('Y'); ?></p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url(); ?>asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- Data Tables-->
  <script src="<?php echo base_url(); ?>asset/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/js/select2.min.js"></script>
  
  <script>
  $(document).ready(function() {
        
        $('.select2').select2();
        
        var table = $('#table_1');

        var oTable = table.dataTable({
            
            "order": [
                [0, 'desc']
            ],
        });
        
        
    } );
  </script>
</body>

</html>
