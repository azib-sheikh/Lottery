$(document).ready(function ($) {
    // picking number of Five
    var singleNum = $(".number-box.common");
    var singleNum2 = $(".number-box.special").find(".single-number");

    /**
     * Code added by Ashutosh
     */
    var lotteryNumbers = "";
    var checkedWinningNumber = "";
    $(singleNum).on("click", function () {
        var checkedVals = $(".lotteryNumbers:checked")
            .map(function () {
                return this.value;
            })
            .get();
        var this_btn_number = checkedVals.join(",");
        // var singleNumLength = $(".number-box.common").find(
        //     ".single-number.selected"
        // ).length;
        var singleNumLength = $(".number-box.common").find(
            ".lotteryNumbers:checked"
        ).length;
        // var this_btn_number = parseInt($(this).text());
        lotteryNumbers.length = 0;
        lotteryNumbers = this_btn_number;
        console.log(lotteryNumbers);
    });

    $("#lotteryWinningAmountArray").on("click", function () {
        checkedWinningNumber = $(".winning-number:checked").val();
        console.log(checkedWinningNumber);
    });

    $("#continueToCart").click(function (e) {
        e.preventDefault();
        var csrf = $("meta[name='csrf-token']").attr("content");
        var lotteryId = $("#set_lottery_id").val();
        if (lotteryNumbers.length <= 0) {
            alert("Please choose numbers");
            location.reload();
            return false;
        }
        if (checkedWinningNumber.length <= 0) {
            alert("Please choose winning numbers");
            location.reload();
            return false;
        }
        // AJAX request to save lotteryNumbers to session
        $.ajax({
            url: "cart/add",
            method: "POST",
            data: {
                _token: csrf,
                lotteryNumbers: lotteryNumbers,
                lotteryId: lotteryId,
                checkedWinningNumber: checkedWinningNumber,
            },
            success: function (response) {
                cartStatus = response.cartStatus;
                console.log("response=" + response);
                if (cartStatus == "success") {
                    alert("Lottery numbers Added to cart");
                    location.reload();
                    // Redirect or do other actions as needed
                }
                if (cartStatus == "error") {
                    alert("login first");
                    location.reload();
                    // Redirect or do other actions as needed
                }
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error(error);
            },
        });
    });
});

function confirmDelete(itemId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            var url = "remove-cart-item";
            var csrf = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                type: "POST",
                url: url,

                data: {
                    _token: csrf,
                    id: itemId,
                },
                success: function (data) {
                    // alert("Remove from cart.");
                    location.reload();
                },
            });
        }
    });
}

function confirmUpdate(status) {
    var transactions_id = $("#transactions_id").val();
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!",
    }).then((result) => {
        if (result.isConfirmed) {
            var url = "transaction/update-status";
            var csrf = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                type: "POST",
                url: url,

                data: {
                    _token: csrf,
                    transactions_id: transactions_id,
                    status: status,
                },
                success: function (data) {
                    // alert("Remove from cart.");
                    location.reload();
                },
            });
        }
    });
}
