$(document).ready(function () {
    getDashboardStatisticalData()
    imageCrop()
    $('#update-profile-picture-btn').on('click',function () {
        $('#imageUpload').click()
    })
})

function getDashboardStatisticalData() {
    var totalLoan = $('#total-loan')
    var totalBorrower = $('#total-borrower')
    var collectedAmount = $('#collection-amount')
    totalLoan.html(0)
    totalBorrower.html(0)
    collectedAmount.html("TZS 0")
    // $.get('/admin/ajax/get/dashboard/statistical/data',function (response) {
    //     totalLoan.html(response.total_loan)
    //     totalBorrower.html(response.total_borrower)
    //     collectedAmount.html(response.collection_amount)
    // });
}

function imageCrop() {
    var $modal = $('.imagecrop');
    var image = document.getElementById('image');
    var cropper;
    $("body").on("change", ".imageUpload", function(e){
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });
    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });
    $("body").on("click", "#crop", function() {
        canvas = cropper.getCroppedCanvas({
            width: 200,
            height: 200,
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $('#base64image').val(base64data);
                document.getElementById('imagePreview').style.backgroundImage = "url("+base64data+")";
                $modal.modal('hide');
                $("#profile-image-form").submit()
            }
        });
    })
}
