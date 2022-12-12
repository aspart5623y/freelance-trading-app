function previewFile(input, id) {
    var file = $(input).get(0).files[0];
    if (file) {
        var reader = new FileReader()
        reader.onload = function() {
            $("#" + id).attr("src", reader.result);
        }
        reader.readAsDataURL(file)
    }
}