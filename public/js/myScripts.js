$( document ).ready(function() {

    $(".js-form-submit").on("click", function() {

        // Validating Form
        checkValidation();

        // Grabbing Selected Options (interests) from Dropdown into Array
        arr = $('.place_interests select.required').map(function(){
            return this.value;
        }).get();

        // Checking for duplicate elements in array,
        // If found one, the form will not be submitted!
        var valuesSoFar = {};
        for (var i = 0; i < arr.length; ++i) {
            var value = arr[i];
            console.log(arr[i]);
            if (Object.prototype.hasOwnProperty.call(valuesSoFar, value) && arr[i] != "") {
                $('.msg').html("Interests can't be same!!");
                return false;
            }
            valuesSoFar[value] = true;
        }

        // Setting msg field to empty
        $('.msg').html("");

        // Finally Submitting the form
        $(this).closest("form").submit();
    });

    $('.pagination_searchStudents a').on('click', function(e){
        e.preventDefault();
        var keywords = $('#search-input').val();

        if (keywords.length > 0)
        {
            var url = $(this).attr('href');
            $.post(url, {keywords: keywords}, function(markup){
                $('#search-results').html(markup);
            });
        }        
    });

    function checkValidation()
    {
      jQuery(function(){
            jQuery("#name").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#email").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#address").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#dob").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#gender").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#password").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#new-password").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#old-password").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#confirm-new-password").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
        jQuery("#confirm_password").validate({
            expression: "if (VAL) return true; else return false;",
            message: "<b style='color: #ef7c61;'>This Field is required!</b>"
        });
      });
    }


	// Setting maximum date as today's date to be selectable
  $("#dob").datepicker({
    endDate : new Date(),
		format: 'dd-mm-yyyy',
		clearBtn: true,
	  autoclose: true,
	  todayHighlight: true
	});

  $('input[type=text], input[type=password], input[type=radio]').focusout(function() {
      checkValidation();
  });


    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

    // function interests()
    // {

      //var index = 1;
      //var msg = "";
      var tag = 1;
      function clone()
      {
        console.log(index);
        if(index < max)
        {
          $(this).parents('span.select_interests')
          .clone()
          .attr("id", "interests" + tag)
          .appendTo('p.place_interests')
          .on('click', '.clone', clone)
          .on('click', '.remove', remove);

          //$(this).parents('span.select_interests select').attr("id", "interests" + tag);

          index++;
          tag++;

        }
        else
        {
          $('.msg').html("Can't add more interests!");
          if(typeof(tag) == "undefined") {
              $('.msg').html(tag);
          }
          
          //$('.msg').html($('#interests option:selected').text());
        }
      }

      function remove()
      {
        if(index > 1)
        {
          $(this).parents(".select_interests").remove();
          index--;
          $('.msg').html("");
          //tag = index;
          console.log("inside if");
        }
        console.log("inside remove()");
      }

      $(".clone").on('click', clone);
      $(".remove").on('click', remove);

});
