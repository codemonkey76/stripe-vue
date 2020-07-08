<template>
    <form ref="form" id="payment-form" class="form-horizontal" method="post" action="/admin/payments">
        <input type="hidden" name="_token" :value="csrf">
        <div class="card">
            <div class="card-header">Add Payment</div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Name</label>
                    <div class="col-md-9">
                        <input type="text" id="name" name="name" class="form-control" value="" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label">Email</label>
                    <div class="col-md-9">
                        <input id="email" type="text" name="email" class="form-control" value="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-md-3 col-form-label">Date</label>
                    <div class="col-md-9">
                        <b-form-datepicker id="date" v-model="date" class="mb-2"></b-form-datepicker>
                    </div>
                </div>

                <payment-type :options="types" v-model="type"></payment-type>

                <div class="form-group row">
                    <label for="amount" class="col-md-3 col-form-label">Amount</label>
                    <div class="col-md-9">
                        <input type="text" id="amount" name="amount" class="form-control" autocomplete="off"
                               v-model="amount">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="comments" class="col-md-3 col-form-label">Comments</label>
                    <div class="col-md-9">
                        <textarea class="form-control" id="comments" name="comments"></textarea>
                    </div>
                </div>

                <card-info ref="card_info" :type="type" :stripe-token="stripeToken"></card-info>

            </div>
            <div class="card-footer text-center">
                <button class="btn btn-primary" id="payment-btn" @click.prevent="process">Save</button>
            </div>
        </div>
    </form>
</template>
<script>
    export default {
        props: ['types', 'stripeKey'],
        name: "PaymentForm",
        data() {
            return {
                csrf: document.querySelector('meta[name=csrf-token]').content,
                amount: 100,
                date: '07/07/2020',
                type: 'CC',
                cardDetails: {
                    card: '',
                    cardExpiry: '',
                    cardCvc: ''
                },
                stripe: Stripe(this.stripeKey),
                processing: false,
                stripeToken: ''
            }
        },
        mounted() {
            let elements = this.stripe.elements();
            let elementStyle = {
                base: {
                    color: '#00a4e2',
                    lineHeight: '28px',
                    fontSmoothing: 'antialiased',
                    '::placeholder': {
                        color: '#999',
                        marginLeft: '7px',
                        opacity: 1
                    },
                },
                invalid: {
                    color: '#e5424d',
                    ':focus': {
                        color: '#303238',
                    },
                },
            };

            this.cardDetails.card = elements.create('cardNumber', {
                hidePostalCode: true,
                style: elementStyle
            });
            this.cardDetails.card.mount('#card-number');

            this.cardDetails.cardExpiry = elements.create('cardExpiry', {
                hidePostalCode: true,
                style: elementStyle
            });
            this.cardDetails.cardExpiry.mount('#card-expiry');

            this.cardDetails.cardCvc = elements.create('cardCvc', {
                hidePostalCode: true,
                style: elementStyle
            });
            this.cardDetails.cardCvc.mount('#card-cvc');
        },
        methods: {
            paymentStripeResponseHandler(result) {
                let error_msg;
                if (result.error) {
                    if (result.error.type === 'invalid_request_error') {
                        error_msg = "Please give correct credit card details!!!";
                    } else {
                        error_msg = result.error.message;
                    }
                    Swal.fire('Error',error_msg, 'error');

                    return false;

                } else if (result.token) {
                    this.cardDetails.card.clear();
                    this.cardDetails.cardExpiry.clear();
                    this.cardDetails.cardCvc.clear();
                    this.stripeToken = result.token.id;
                    setTimeout(this.$refs.form.submit, 500);

                    return false;
                }
            }
            ,
            process() {
                this.processing = true;

                let _pay_amount = this.amount;
                let _errors = [];

                if (_pay_amount <= 0) {
                    _errors.push('Payment amount should not empty');
                }

                if (_errors.length) {
                    Swal.fire('Error', _errors.join('<br />'), 'warning');
                } else {
                    if (this.type === 'CC') {
                        this.stripe.createToken(this.cardDetails.card)
                            .then((result) => this.paymentStripeResponseHandler(result));
                    } else {
                        this.$refs.form.submit();
                    }
                }
                return false;
            }
        }
    }
</script>

<style scoped>

</style>
