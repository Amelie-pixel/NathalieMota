<!-- la Modal -->
<div id="myModal" class="modal">
  <!-- contenu de la modal -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close"></span>
    </div>
    <div class="modal-body">
    <?php
        echo do_shortcode('[contact-form-7 id="81cb67f" title="Contact form 1"]');
        $refPhotoValue = get_field('reference');
        if ($refPhotoValue) {
          echo '<input type="hidden" class="refPhotoValue" value="' . esc_attr($refPhotoValue) . '">';
        }
    ?>
    </div>
      <div class="modal-footer">
      </div>
  </div>
</div>

