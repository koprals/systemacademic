<?php echo $this->start("script");?>
<script>
$(document).ready(function(){
  var jqxhr = $.ajax( "<?php echo $this->webroot ?>Web/ajaxDiningPromo/1" ) // 1 tuh ajax nya
  .done(function(result) {
    $("#diningPromos").html(result);
  })
  .fail(function() {
    alert( "error" );
  })
  .always(function() {
    
  });
});

function changeTab(category_id) {
  var jqxhr = $.ajax( "<?php echo $this->webroot ?>Web/ajaxDiningPromo/" + category_id ) // 1 tuh ajax nya
  .done(function(result) {
    $("#diningPromos").html(result);
  })
  .fail(function() {
    alert( "error" );
  })
  .always(function() {

  });
}

</script>
<?php echo $this->end(); ?>
<!-- Navigation -->
<?php
echo $this->element('navbar_multiple_page', array(
    "diningPromoActive" => "active"
));
?>
<!-- Portfolio Grid Section -->
<div id="diningPromos">
</div>
