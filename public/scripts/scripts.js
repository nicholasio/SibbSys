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

});