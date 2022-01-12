<script type="text/javascript">
    $(document).on('ready', function() {
        initializeTinyMceEditor('textarea.jobDescriptionEditor');
        initializeTinyMceEditor('textarea.companyDescriptionEditor');

        $('input[name=jobLocation]').on('change', function() {
            if ($(this).is(':checked') && $(this).val() == 'office') {
                $('.jobOfficeLocationDiv').show();
                $('.jobRegionalRestrictionDiv').hide();
            } else if ($(this).is(':checked') && $(this).val() == 'remote_region') {
                $('.jobOfficeLocationDiv').hide();
                $('.jobRegionalRestrictionDiv').show();
            } else {
                $('.jobOfficeLocationDiv').hide();
                $('.jobRegionalRestrictionDiv').hide();
            }
        });

        $('input[name=jobPostType]').on('change', function() {
            var initialPrice = parseFloat($('.intialJobPrice').val());
            var finalPrice = 0;
        
            if ($(this).is(':checked') && $(this).val() == 'premium') {
                finalPrice = initialPrice + parseFloat($('.additionalJobPrice').val())
            } else {
                finalPrice = initialPrice;
            }
            
            $('.totalJobPrice').text("{{ CustomHelper::printCurrency() }}" + parseFloat(finalPrice));
        });
    });
</script>