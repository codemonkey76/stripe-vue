

@section('scripts')


    <script type="text/javascript">


        function paymentStripeResponseHandler(result) {
            var error_msg;
            if (result.error) {
                if (result.error.type == 'invalid_request_error') {
                    error_msg = "Please give correct credit card details!!!";
                } else {
                    error_msg = result.error.message;
                }
                swal({
                    title: 'Error',
                    html: error_msg,
                    type: 'warning',
                    confirmButtonClass: 'btn btn-warning',
                    confirmButtonText: 'Close'
                });
                $('#payment-btn').html("Complete Payment").removeClass('disabled');
                return false;

            } else if (result.token) {
                card.clear();
                cardExpiry.clear();
                cardCvc.clear();
                $_paymentForm.find('#stripe_token').val(result.token.id);
                setTimeout(function () {
                    $_paymentForm.submit();
                }, 500);
                return false;
            }
        }

        $(document).ready(function () {
            $('#payment-btn').on('click', function () {

            });


        });
    </script>
@endsection
