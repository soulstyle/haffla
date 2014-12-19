jQuery(document).ready(function($) {
	
	// Init FooTable
	$(function () {
		$('.dashboard-table').footable();
	});

	$('.sort-column').click(function (e) {
        e.preventDefault();

        //get the footable sort object
        var footableSort = $('table').data('footable-sort');

        //get the index we are wanting to sort by
        var index = $(this).data('index');

        footableSort.doSort(index, 'toggle');
    });

    $(function() {
        $('.checkin-table').footable({
            addRowToggle: false
        }).bind('footable_filtering', function (e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });

        $('.clear-filter').click(function (e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.checkin-table').trigger('footable_clear_filter');
        });

        $('.filter-status').change(function (e) {
            e.preventDefault();
            $('table.checkin-table').trigger('footable_filter', {filter: $('#filter').val()});
        });
    });

    /* Activate - Deactivate Forms
    ----------------------------------------------- */
    function form_active(e) {
        var form_id = $(e).data('form-id');
        var active = '0';
        if($(e).is(':checked')) {
            active = '1';
        }
        var param = {'action': 'formactive', 'formId': form_id, 'active': active}; // Build param

        //Do AJAX call
        $.ajax({
            url: '../includes/ajax.inc.php',
            method: 'post',
            data: param, 
            success: function( data ){
                if(data === '1') {
                    // Form Active!
                }
                if(data === '0') {
                    // Form Inactive
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log("Details: " + textStatus + "\nError:" + errorThrown);
            }
        });
    }
    // Bind CheckInOut till click på tabell rad.
    $('.dashboard-table').on('change', '.form-active', function() {
        form_active(this);
    });


    /* CheckInOut function
    ----------------------------------------------- */
    function checkin_guest(e) {
        var uid = $(e).data('uid');
        var status = '1';
        if($(e).hasClass('checkedin')) {
            status = '0';
        }
        var param = {'action': 'checkinout', 'userId': uid, 'status': status}; // Build param

        //Do AJAX call
        $.ajax({
            url: '../includes/ajax.inc.php',
            method: 'post',
            data: param, 
            success: function( data ){
                if(data === 'checkedin') {
                    $(e).toggleClass('checkedin');
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log("Details: " + textStatus + "\nError:" + errorThrown);
            }
        });
        
    }
    // Bind CheckInOut till click på tabell rad.
    $('.checkin-table').on('click', 'tbody tr', function(e) {
        e.stopImmediatePropagation(); // Försök att stoppa visning av detaljer på mobil - funkar ej?
        checkin_guest(this);
    });
});
