<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close"></span>
    </div>
    <div class="modal-body">
    <?php
				// On insère le formulaire de demandes de renseignements
				// get_field('reference')
				$refPhoto = "";
				if (get_field('reference')) {
					$refPhoto = get_field('reference');
				}; 
				echo do_shortcode('[contact-form-7 id="81cb67f" title="Contact form 1"]');
			?>
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>