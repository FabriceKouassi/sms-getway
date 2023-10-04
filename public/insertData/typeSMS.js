$(document).ready(function() {
    $('#saveData').click(function() {
        var formData = $('#saveForm').serialize();
        $.ajax({
            url: '{{ route("typesms.save") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert(response.success);
                $('#saveModal').modal('hide');
            },
            error: function(xhr) {
                // Gérer les erreurs ici
                alert('Erreur : ' + xhr.responseText);
            }
        });
    });
});
