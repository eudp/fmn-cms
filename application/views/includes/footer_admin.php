    <!-- Banner de footer -->
    <div class="container">
    	<div class="row">
	    	<div class="col-10">
	    		<img src="http://www.fmn.gob.ve/sites/default/files/styles/aviso_inferior/public/aviso-inferior/1896-2404.jpg?itok=WP9dE8t9" alt="">
	    	</div>
    	</div>
    </div>
    <!-- Fin de Banner de footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= site_url('assets/js/jquery-3.2.1.min.js'); ?>" ></script>
    <script src="<?= site_url('assets/js/popper.js'); ?>"></script> 
    <script src="<?= site_url('assets/js/bootstrap.min.js'); ?>"></script>

    <script src="<?= site_url('assets/js/tinymce/tinymce.min.js'); ?>" ></script>

    <script src="<?= site_url('assets/js/image-picker/image-picker.min.js'); ?>" ></script>

    <script>
        $(document).ready(function () {

            /* If it's edit page*/
            if($("#descripcion").length != 0) {

                /* Retrieve value from hidden input and set in tinymce*/
                $('#descripcion').html($('#descripcion-oculta').val());
                tinymce.init({
                    selector: '#descripcion',
                    plugins: 'preview',
                    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist ',
                    menu: {
                        view: {title: 'Edit', items: 'cut, copy, paste'}
                    }
                });
            }

            $( "#pick-image-button" ).on( "click", function() {
                $("#select-image").imagepicker();
            });
        });
    </script>
  </body>
</html>