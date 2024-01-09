$(document).ready(function () {
    function handleFileInput(e) {
        var fileName = e.target.files[0].name;
        $(this).next('label').html(fileName);
    }

    $('input[type="file"]').each(function () {
        $(this).change(handleFileInput);
    });
});
