function fillVisitInfo(id, client_name, phone, email, visitor, date, details) {
    $("#id").empty();
    $("#clientName").empty();
    $("#phone").empty();
    $("#email").empty();
    $("#visitor").empty();
    $("#date").empty();
    $("#details").empty();
    $("#id").append(id);
    $("#clientName").append(client_name);
    $("#phone").append(phone);
    $("#email").append(email);
    $("#visitor").append(visitor);
    $("#date").append(date);
    $("#details").append(details);

    $("#showVistInfo").modal('show');
}