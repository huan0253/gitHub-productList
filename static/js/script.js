function checkValues() {
    const prodName = $("#prodName");
    const prodType = $("#prodType");
    const prodCode = $("#code");
    const prodPrice = $("#price");
    const warning = $("#warning")
    warning.innerHTML = "";
    if (!(null !== prodName.val() && prodName.val().length > 0 && null !== prodPrice.val() && prodPrice.val().length > 0 && null !== prodType.val() && prodType.val().length > 0 && null !== prodCode.val() && prodCode.val().length > 0)
    ) {
        warning.html("");
        warning.append($("<span/>", {
            "class": "danger alert-danger",
            "html": "Please fill all the fields"
        }))
        return false;
    }
}


$(document).ready(getSelectedType($("h4")[1]))

function getSelectedType(e) {
    const typeDisplay = $("#typeDisplay")
    let dataType = e.innerText
    typeDisplay.innerHTML = ""
    typeDisplay.text(dataType);
    $.ajax({
        url: 'router.php',
        type: 'get',
        dataType: 'json',
        data: {
            'action': "query",
            'type':dataType
        },
        success: (data) => renderProducts(data),
        error: function (data) {
            console.log(data)
            alert("ajax error:" + data);
            console.log(data)
        }
    })
    return false;
}

function renderProducts(arr) {
    let tableBody = $("#tableBody")
    tableBody.html("")
    arr.forEach(
        (value) => {
            tableBody.append($("<tr/>").append($("<td/>", {
                "html": value.id
            })).append($("<td/>", {
                "html": value.code
            })).append($("<td/>", {
                "html": value.name
            })).append($("<td/>", {
                "html": value.price
            })).append($("<td/>").append($("<a/>", {
                "html": "Delete",
                "href": "router.php?action=delete&id=" + value.id,
            }))).append($("<td/>").append($("<a/>", {
                "html": "Edit",
                "href": "router.php?action=toEdit&id=" + value.id
            }))))
        }
    )
}









