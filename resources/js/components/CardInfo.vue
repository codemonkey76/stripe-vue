<template>
    <div v-show="type==='CC'" class="form-group row hide" id="card-info">
        <label class="col-md-3 col-form-label">Card info</label>
        <div class="col-md-9">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="cardnumber">Card Number</label>
                    <div class="card-field stripe-input" id="card-number"></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="exp-date">Expiry</label>
                    <div class="card-field stripe-input" id="card-expiry"></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="cvc">CVC</label>
                    <div class="card-field stripe-input" id="card-cvc"></div>
                </div>
                <input type="hidden" id="stripe_token" name="stripe_token" ref="stripe_token" :value="stripeToken">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['type', 'stripeToken'],
        name: "CardInfo"
    }
</script>

<style scoped>

</style>
