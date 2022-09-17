$("input").on("change", function () {
    let file = $(this).prop("files")[0];
    $("p").text(file.name);
    $("label").append("<svc />");
});
