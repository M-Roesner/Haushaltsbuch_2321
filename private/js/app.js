$(document).ready(function() {
   $('#cat').on('change', function() {
      var cat = this.value;
      $.ajax({
            url: "fetch-subcategory-by-category.php",
            type: "POST",
            data: {
               cat: cat
            },
            cache: false,
            success: function(result) {
               $("#subCat").html(result);
            }
      });
   });
});