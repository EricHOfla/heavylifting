
    
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function () {
            $('#country_name').change(function(){
                var country_name=$('#country_name').val();
                $.ajax({
                url:"ajax/country_state.php",
                type:"post",
                data:"country="+country_name,
                success:function(msg){
                    $('#state').html(msg);
                }
                });
            });

            $('#state').change(function(){
                var state=$('#state').val();
                $.ajax({
                url:"ajax/state_city.php",
                type:"post",
                data:"state="+state,
                success:function(msg){
                    $('#city').html(msg);
                }
                });
            });

            $('#upd_country_name').change(function(){
                var country_name=$('#upd_country_name').val();
                $.ajax({
                url:"ajax/country_state.php",
                type:"post",
                data:"country="+country_name,
                success:function(msg){
                    $('#upd_state').html(msg);
                }
                });
            });

            $('#upd_state').change(function(){
                var state=$('#upd_state').val();
                $.ajax({
                url:"ajax/state_city.php",
                type:"post",
                data:"state="+state,
                success:function(msg){
                    $('#upd_city').html(msg);
                }
                });
            });

            $('#warehouse').change(function(){
                var warehouse=$('#warehouse').val();
                $.ajax({
                url:"ajax/warehouse_container.php",
                type:"post",
                data:"containers="+warehouse,
                success:function(msg){
                    $('#container').html(msg);
                }
                });
            });
        });
    </script>

</body>



</html>