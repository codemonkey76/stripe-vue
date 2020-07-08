<template>
    <div class="form-group row">
        <label for="type" class="col-md-3 col-form-label">Payment type</label>
        <div class="col-md-9">
            <select @change="$emit('input', $event.target.value)" id="type" class="form-control">
                <option v-for="(option, key) in options" :value="key" v-text="option" />
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['options', 'value'],
        name: "PaymentType",
    }
</script>

<style scoped>

</style>
