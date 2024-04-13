// saveForm.js

function saveFormData(url, formData) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        data: formData,
        type: "POST",
        contentType: false,
        processData: false,
        success: function (data) {
            switch (data.success) {
                case true:
                    swal(data.response, {
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(function () {
                        window.location.reload();
                    });
                    break;
                case false:
                    $.each(data.response, function (fieldName, errorMessage) {
                        $("#" + fieldName + "_validate").addClass("has-error");
                        var errorDiv = $(
                            '<div class="text-danger"></div>'
                        ).text(errorMessage);
                        $("#" + fieldName + "_validate").append(errorDiv);
                    });

                    $(".btnSave").prop("disabled", false);
                    $(".indicator-progress").toggle(false);
                    $(".indicator-label").show();
                case "failure":
                    swal(data.response, {
                        icon: "warning",
                    }).then((m) => {
                        $(".btnSave").prop("disabled", false);
                        $(".indicator-progress").toggle(false);
                        $(".indicator-label").show();
                    });
                    break;
            }
        },
        error: function (data) {
            // Handle AJAX error
            swal("An error Occurred, Please Contact System Support", {
                icon: "warning",
                
            }).then(function () {
                // Re-enable the save button and hide the progress indicator
                $(".btnSave").prop("disabled", false);
                $(".indicator-progress").toggle(false);
                $(".indicator-label").show();
            });
        },
    });
}

function removeError() {
    $("input, select").on("input change", function () {
        var $formGroup = $(this).closest(".form-group");
        $formGroup.removeClass("has-error");
        $formGroup.find(".text-danger").remove();
    });
}

function UpdateData(url, formData) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        data: formData,
        type: "POST",
        contentType: false,
        processData: false,
        success: function (data) {
            switch (data.success) {
                case true:
                    swal(data.response, {
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(function () {
                        window.location.reload();
                    });
                    break;
                case false:
                    $.each(data.response, function (fieldName, errorMessage) {
                        $("#edit_" + fieldName + "_validate").addClass("has-error");
                        var errorDiv = $(
                            '<div class="text-danger"></div>'
                        ).text(errorMessage);
                        $("#edit_" + fieldName + "_validate").append(errorDiv);
                    });

                    $(".btnSave").prop("disabled", false);
                    $(".indicator-progress").toggle(false);
                    $(".indicator-label").show();
                case "failure":
                    swal(data.response, {
                        icon: "warning",
                    }).then((m) => {
                        $(".btnSave").prop("disabled", false);
                        $(".indicator-progress").toggle(false);
                        $(".indicator-label").show();
                    });
                    break;
            }
        },
        error: function (data) {
            // Handle AJAX error
            swal("An error Occurred, Please Contact System Support", {
                icon: "warning",
            }).then(function () {
                // Re-enable the save button and hide the progress indicator
                $(".btnSave").prop("disabled", false);
                $(".indicator-progress").toggle(false);
                $(".indicator-label").show();
            });
        },
    });
}
function deleteData(formData, url) {
    swal({
        text: "Are you sure you want to Delete: ?",
        buttons: ["No", "Yes"],
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: url,
                data: formData,
                type: "POST",
                contentType: false,
                processData: false,

                success: function (data) {
                    switch (data.success) {
                        case true:
                            swal(data.response, {
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false,
                            }).then((m) => {
                                window.location.reload();
                            });
                            break;
                        case false:
                            swal(data.response, {
                                icon: "warning",
                                timer: 1500,
                                showConfirmButton: false,
                            });
                            break;
                    }
                },
                error: function (data) {
                    swal("An error Occurred, Please Contact System Support", {
                        icon: "warning",
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    return false;
                },
            });
        } else {
            swal("Cancelled", "Process Cancelled", {
                icon: "info",
                timer: 1500,
                showConfirmButton: false,
            });
        }
    });
}
function ApproveData(formData, url) {
    swal({
        text: "Are you sure you want to Apprrove: ?",
        buttons: ["No", "Yes"],
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: url,
                data: formData,
                type: "POST",
                contentType: false,
                processData: false,

                success: function (data) {
                    switch (data.success) {
                        case true:
                            swal(data.response, {
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false,
                            }).then((m) => {
                                window.location.reload();
                            });
                            break;
                        case false:
                            swal(data.response, {
                                icon: "warning",
                            });
                            break;
                    }
                },
                error: function (data) {
                    swal("An error Occurred, Please Contact System Support", {
                        icon: "warning",
                    });
                    return false;
                },
            });
        } else {
            swal("Cancelled", "Process Cancelled", {
                icon: "info",
                timer: 1500,
                showConfirmButton: false,
            });
        }
    });
}

function makeAjaxRequest(url,formData, successCallback) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success: successCallback
    });
}