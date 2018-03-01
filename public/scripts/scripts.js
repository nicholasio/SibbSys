jQuery(document).ready(function($) {

    var sheepItForm = $('#sheepItForm');
    if ( sheepItForm.length > 0 ) {
        sheepItForm.sheepIt({
            separator: '',
            allowRemoveLast: true,
            allowRemoveCurrent: true,
            allowRemoveAll: true,
            allowAdd: true,
            maxFormsCount: 0,
            minFormsCount: 1,
            iniFormsCount: 1,
            afterClone: function(source, template) {
                /*newForm.find('.sibb-select2').select2();
                 source.find$(".sibb-select2").select2();*/
                //$(".sibb-select2").select2();
                //template.find('.sibb-select2').select2();

            }
        });
    }


    $(".sibb-select2").select2();

    var $selectAll = $('.select-all');

    if ( $selectAll.length > 0 ) {
        var target = $selectAll.data('select');
        var $target = $(target);

        $selectAll.on('change', function() {
            if ( this.checked ) {
                $target.attr('checked', 'checked');
            } else {
                $target.removeAttr('checked');
            }
            $target.change();
        });
    }

    var $dependentBtn = $('.dependent-btn');

    if ( $dependentBtn.length > 0 ) {
        var target = $dependentBtn.data("enabled");
        console.log(target);
        var $target = $(target);
        $target.on('change', function() {

            if ( $target.filter(':checked').length > 0 ) {
                $dependentBtn.removeAttr('disabled');
            }  else {
                $dependentBtn.attr('disabled', 'disabled');
            }
        });
    };

    $('.data-table-ajax').each(function() {
        var $this = $(this);
	    $this.DataTable({
		    'processing': true,
		    'serverSide': true,
		    'ajax': $this.data('endpoint')
	    });
    });



});