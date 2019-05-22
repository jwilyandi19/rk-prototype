$(document).on("click", ".open-uploadTugas", function () {
    var idTugas = $(this).data('id');
    $(".modal-body #idTugas").val( idTugas );
    
    // As pointed out in comments, 
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});
