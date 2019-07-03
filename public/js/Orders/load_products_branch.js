
/**Javascrip to fill the list of products of the branch the user belogns to create an order*/
function activeProductBranch() {
    $.ajax({
        url: '/active_products_branch',
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            $('#product_branch').empty();
            $.each(datos, function () {
                $.each(this, function () {
                    $('#product_branch').append('<option value="' + this.id + '">' + this.id + ". " + this.name + '</option>');
                })

            })

        }, error: function () {
            alert("¡Ha habido un error cargando los productos!" +
                " Si este error persiste por favor comuníquese con el equipo técnico");
        }
    });
}


function activeProductBranchSelected(selectedProduct) {
    $.ajax({
        url: '/active_products_branch',
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            $('#product_branch_edit').empty();
            $.each(datos, function () {
                $.each(this, function () {
                    if (this.id == selectedProduct) {
                        $('#product_branch_edit').append('<option selected="true" value="' + this.id + '">' + this.id + ". " +  this.name + '</option>');
                    } else {
                        $('#product_branch_edit').append('<option value="' + this.id + '">' + this.id + ". " + this.name + '</option>');
                    }
                })

            })

        }, error: function () {
            alert("¡Ha habido un error cargando los productos!" +
                " Si este error persiste por favor comuníquese con el equipo técnico");
        }
    });
}