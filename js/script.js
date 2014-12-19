jQuery(document).ready(function($) {
	
	// Init FooTable
	$(function () {
		$('.footable').footable();
	});

	$('.sort-column').click(function (e) {
        e.preventDefault();

        //get the footable sort object
        var footableSort = $('table').data('footable-sort');

        //get the index we are wanting to sort by
        var index = $(this).data('index');

        footableSort.doSort(index, 'toggle');
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
    $('.checkin').on('click', 'tbody tr', function(e) {
        e.stopImmediatePropagation(); // Försök att stoppa visning av detaljer på mobil - funkar ej?
        checkin_guest(this);
    });
});
