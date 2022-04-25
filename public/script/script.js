function selectType() {
    let typeSelect = document.getElementById("productType").value;

    $.ajax({
        url: "/add-product",
        method: "POST",
        data: {
            id: typeSelect
        },
        success: function (data) {
            $(".type-input-field-container").html(data);
        }
    })
}