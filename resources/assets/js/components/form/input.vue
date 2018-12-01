<template>
    <div>
        <input class="form-control" :value="value" @input="updateValue($event.target.value)" :aria-describedby="id">
        <small :id="id" class="form-text text-muted">{{ description }}</small>
    </div>
</template>

<script>
    module.exports = {
        props: ['value', 'name', 'description'],
        data: function() {
            return {}
        },
        computed: {
            id: function() {
                return 'd-' + this.name;
            }
        },
        methods: {
            updateValue: function (value) {
                var formattedValue = value.trim();
                if (formattedValue !== value) {
                    this.$refs.input.value = formattedValue
                }
                // Emit the number value through the input event
                this.$emit('input', formattedValue)
            }
        }
    }
</script>

<style scoped>

</style>
