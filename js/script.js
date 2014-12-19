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

    $(function () {
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
            success: function( data, textStatus, jQxhr ){
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
