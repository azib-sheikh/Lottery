$(document).ready(function () {
    $(".razorpay_btn").click(function (e) {
        e.preventDefault();
        var deposit_amount_by_razorpay = $(".deposit_amount_by_razorpay").val();

        if (!deposit_amount_by_razorpay) {
            var deposit_amount_by_razorpay_error = "Amount is required";
            $("#deposit_amount_by_razorpay_error").html("");
            $("#deposit_amount_by_razorpay_error").html(
                deposit_amount_by_razorpay_error
            );
        } else {
            var deposit_amount_by_razorpay_error = "";
            $("#deposit_amount_by_razorpay_error").html("");
        }

        if (deposit_amount_by_razorpay_error != "") {
            return false;
        } else {
            var csrf = $("meta[name='csrf-token']").attr("content");
            var data = {
                deposit_amount_by_razorpay: deposit_amount_by_razorpay,
                _token: csrf,
            };
            $.ajax({
                method: "POST",
                url: "/user/wallet/proceed-to-pay",
                data: data,
                success: function (response) {
                    var options = {
                        key: "rzp_test_G4fe2pkpcv5Zg2", // Enter the Key ID generated from the Dashboard
                        amount: deposit_amount_by_razorpay * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        currency: "INR",
                        name: response.name, //your business name
                        description: "Thank you for choosing us.",
                        image: "https://example.com/your_logo",
                        // order_id: "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        handler: function (responseA) {
                            // alert(response.razorpay_payment_id);
                            // alert(response.razorpay_order_id);
                            // alert(response.razorpay_signature);
                            var csrf = $("meta[name='csrf-token']").attr(
                                "content"
                            );
                            $.ajax({
                                method: "POST",
                                url: "/user/wallet/deposit-amount",
                                data: {
                                    deposit_amount: deposit_amount_by_razorpay,
                                    payment_reference_number:
                                        responseA.razorpay_payment_id,
                                    mode_of_payment: "rzp",
                                    _token: csrf,
                                },
                                success: function (responseB) {
                                    alert(responseB.status);
                                    window.location.href = "/user/wallet/";
                                },
                            });
                        },
                        prefill: {
                            //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
                            name: response.name, //your customer's name
                            email: response.email,
                            contact: response.mobile, //Provide the customer's phone number for better conversion rates
                        },
                        // notes: {
                        //     address: "Razorpay Corporate Office",
                        // },
                        theme: {
                            color: "#3399cc",
                        },
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on("payment.failed", function (responseC) {
                        // alert(response.error.code);
                        // alert(response.error.description);
                        // alert(response.error.source);
                        // alert(response.error.step);
                        // alert(response.error.reason);
                        // alert(response.error.metadata.order_id);
                        // alert(response.error.metadata.payment_id);

                        $.ajax({
                            method: "POST",
                            url: "/user/wallet/deposit-amount",
                            data: {
                                deposit_amount: deposit_amount_by_razorpay,
                                payment_reference_number: responseC.payment_id,
                                mode_of_payment: "rzp",
                                rzp_payment_error_response: responseC,
                                _token: csrf,
                            },
                            success: function (responseB) {
                                alert(responseB.status);
                                window.location.href = "/user/wallet/";
                            },
                        });
                    });
                    // document.getElementById("rzp-button1").onclick = function (
                    //     e
                    // ) {
                    rzp1.open();
                    e.preventDefault();
                    //};
                },
            });
        }
    });
});
